<?php 
include_once "presentation/select.php";
ini_set("default_socket_timeout",10);

class CDH_HOSPITAL extends CDH_SELECT 
{
	function __construct($parent) 
	{
		parent::__construct($parent);		
		$parent->m_js_click = "chg_hospital(this)";
		$parent->m_js_initial = "init_hospital";	
		$this->m_helper_sql = "select sho_nombre,sho_codigo from sig_hospitales where sho_codigo='<val>'";
	} 
		
	function getJsIncludes()
	{	
		return array(
			parent::getJsIncludes(),
			'<script type="text/javascript" src="'.WEB_PATH.'/includes/presentation/hospital.js"></script>'); 
	}
	
	function RenderFilterForm($cn,$name,$id=null,$nombre=null)
	{
		global $primary_db;
		$fld = $this->m_parent;
		$p = explode("|",$fld->m_ClassParams);
		
		//La persona es AFILIADA A COPS?
		if( isset($_SESSION['person_cops_id']) && $_SESSION['person_cops_id']>0 && isset($p[0]) && $p[0]=="cops")
		{	
			//Seleccionar el hospital COPS de una
			$this->m_fill_sql = "select sho_nombre,sho_codigo from sig_hospitales where sho_estado='ACTIVO' and sho_nombre='COPS'";
			
			//Fijo el codigo de COPS como el valor elegido de este campo
			$cops = $primary_db->QueryString("select sho_codigo from sig_hospitales where sho_estado='ACTIVO' and sho_nombre='COPS'");
			$fld->setValue($cops);
			
			//Dejar el campo FIJO en la opcion COPS
			$fld->m_IsReadOnly = true;
		}
		else 
		{
			//NO ES AFILIADO
			$this->m_fill_sql = "select sho_nombre,sho_codigo from sig_hospitales where sho_estado='ACTIVO' and sho_nombre<>'COPS' order by sho_nombre ";
		}		
		
		$html = parent::RenderFilterForm($cn,$name,$id,$nombre);
		return $html;
	}

	//Retorna la lista de servicios disponibles NO COPS
	function AJAXgetServicios($p)
    {
        global $primary_db;
		$conjunto = array();
		
		list($hospital,$edad,$sexo) = explode("|",$p);
		
		//Sanitizo la entrada
		if(strlen($sexo)>0)
		{
			$sexo = substr($sexo, 0, 1);
		}
		else 
		{
			$sexo = "N";
		}
		
		if($edad=="")
		{
			$edad = 0;
		}
		else 
		{
			$edad = intval($edad,10);
		}
		
		//Preguntar por los servicios telefonicos del hospital
		$re = $primary_db->do_execute("select * from sig_especialidades where sie_id='$hospital' and (sie_edad_desde<=$edad or sie_edad_desde=0) and (sie_sexo='$sexo' or sie_sexo='N') order by sie_descripcion");
		while( $row = $primary_db->_fetch_row($re) )
		{
			$conjunto[] = array( 
				"codigo" 	=> $row['sie_id_esp'],
				"servicio" 	=> $row['sie_descripcion'],
				"edad" 		=> $row['sie_edad_desde'],
				"sexo" 		=> $row['sie_sexo']
			);
		}

		if(defined("DEBUG_SIGEHOS"))
		{
			error_log("HOSPITAL::AJAXgetServicios($p) Edad:$edad Sexo:$sexo");
		}
		return json_encode($conjunto);
    }
    
    //Agendas para TODOS - RESPONDE SERVER CENTRAL
	function AJAXgetAgendas($params)
    {
        global $primary_db;
		$conjunto = array();

		list($hospital,$servicio,$modo) = explode("|",$params);
		
		//La persona es AFILIADO A COPS?
        if( $modo=="COPS" && isset($_SESSION['person_cops_id']) && $_SESSION['person_cops_id']>0 )
		{
			//Preguntar por las agendas al SIGEHOS
			$url = URL_SIGEHOS_COPS."/sigehos/turnos/api/agendas/?afiliado=".$_SESSION['person_cops_id'];
			$obj = $this->askSigehos($url);			

			//El paciente no tiene agendas asignadas...
			//  ["El afiliado con id = 67047 no tiene asignado ningún médico","WS_ERROR"]
			if( count($obj)==2 && $obj[1]=="WS_ERROR" )
			{
				//No tiene un medico asignado. Saco un POP-UP
				return json_encode( (object) array("error"=>"El paciente no tiene médico asignado") );				
			}
			else 
			{
				foreach($obj as $agenda)
				{
					$conjunto[] = array( 
						"hospital"		=> $hospital,
						"hospital_desc"	=> "COPS",
						"servicio"		=> $servicio,
						"servicio_desc"	=> "COPS",
						"codigo" 		=> $agenda->idagenda,
						"agenda" 		=> $agenda->nombre,
					);
				}
			}
			return json_encode($conjunto);
		}

		if($modo=="GENERAL")
		{				        
			$hospital_desc = $primary_db->QueryString("select sho_nombre from sig_hospitales where sho_codigo={$hospital}");
			$servicio_desc = $primary_db->QueryString("select sie_descripcion from sig_especialidades where sie_id_esp={$servicio} limit 1");
			
	        //Datos de la prestacion
	        $sql = "SELECT sia_id,sia_nombre FROM sig_agendas WHERE sie_id={$hospital} and sie_id_esp={$servicio} order by sia_nombre";
	        $re = $primary_db->do_execute($sql);
	        while( $row=$primary_db->_fetch_row($re) )
	        {
				$conjunto[] = array( 
					"hospital"		=> $hospital,
					"hospital_desc"	=> $hospital_desc,
					"servicio"		=> $servicio,
					"servicio_desc"	=> $servicio_desc,
					"codigo" 		=> $row[0],
					"agenda" 		=> $row[1]
				);
	       	}
			return json_encode($conjunto);
		}

		if($modo=="SERVICIO" || $modo=="PRIMERO")
		{				        
	        //Datos de la prestacion
	        $sql = "SELECT sie_id,sie_id_esp,sia_id,sia_nombre FROM sig_agendas WHERE sie_id_esp={$servicio} order by sia_nombre";
	        $re = $primary_db->do_execute($sql);
	        while( $row=$primary_db->_fetch_row($re) )
	        {
	        	$hospital = $row[0];
	        	$servicio = $row[1];
	        	$hospital_desc = $primary_db->QueryString("select sho_nombre from sig_hospitales where sho_codigo={$hospital}");
				$servicio_desc = $primary_db->QueryString("select sie_descripcion from sig_especialidades where sie_id_esp={$servicio} limit 1");
	        	
				$conjunto[] = array( 
					"hospital"		=> $hospital,
					"hospital_desc"	=> $hospital_desc,
					"servicio"		=> $servicio,
					"servicio_desc"	=> $servicio_desc,
					"codigo" 		=> $row[2],
					"agenda" 		=> $row[3]
				);
	       	}
			return json_encode($conjunto);
		}
		
		//No deberia pasar nunca por aca
		return json_encode(array());
    }

    /**
     * 
     * Recuperar desde el SIGEHOS del hospital la lista de turnos libres, para las agendas pedidas, en los dias pedidos.
     * @param string $params
     * 
     * Los parametros estan separados por un pipe |
     * La lista es $hospital, $sAgendas, $fecha, $dias
     */
    function AJAXgetMultiplesTurnosLibres($params)
    {
    	global $primary_db;
		list($hospital, $sAgendas, $fecha, $dias) = explode("|",$params);
        
        list($client,$usuario,$clave) = $this->conectarAHospital($hospital);
        if($client)
        {
            try {
	        	$turnos = $client->consultarListaAgendas($usuario,$clave,$sAgendas,$fecha,$dias,"LIBRES");	        
	        	
	        	if(defined("DEBUG_SIGEHOS"))
	        	{
	        		//error_log("HOSPITAL::AJAXgetMultiplesTurnosLibres SOAP()->consultarListaAgendas($usuario,$clave,$sAgendas,$fecha,$dias,LIBRES) ".print_r($turnos,true) );
	        		error_log("HOSPITAL::AJAXgetMultiplesTurnosLibres SOAP()->consultarListaAgendas($usuario,$clave,$sAgendas,$fecha,$dias,LIBRES) " );
	        	}
	        	$js = json_encode($turnos);
	        	return $js;
	        } 
	        catch(Exception $e) 
	        {
		        error_log("HOSPITAL::AJAXgetMultiplesTurnosLibres SOAP()->consultarListaAgendas($usuario,$clave,$sAgendas,$fecha,$dias,LIBRES) - ".$e );	
	        }
        }
        return "";
    }

    function conectarAHospital($hospital) 
    {
        global $primary_db;
        
    	$row = $primary_db->QueryArray("select * from sig_hospitales where sho_codigo='$hospital'");
        if($row)
        {
        	$endpoint = $row["sho_endpoint"];
        	$usuario = $row["sho_usuario"];
        	$clave = $row["sho_clave"];
        	
        	//Abro una conexion con el hospital
	        if(defined("DEBUG_SIGEHOS"))
	        {
	        	error_log("HOSPITAL::conectarAHospital SOAP($endpoint) ");
	        }
	        try {
				$client = new SoapClient($endpoint, array(
		        	'cache_wsdl' 			=> 	WSDL_CACHE_BOTH,
		        	/*'cache_wsdl' 			=> 	WSDL_CACHE_NONE,*/
					'connection_timeout'	=>	5,
		        	'exceptions'			=>	true
		        ));
	        
	        	return array($client,$usuario,$clave);
	        } 
	        catch(Exception $e) 
	        {
		        error_log("HOSPITAL::conectarAHospital SOAP($endpoint) - ".$e );	
	        }
        }
        return array(null,null,null);
    }
    
    /**
     * Turnos libres, pregunto a HOSPITAL PRESTADOR
     */
    function AJAXgetTurnosLibres($params)
    {
        global $primary_db;
		$turnos = null;
        $partes = explode("|",$params);
        $hospital = $partes[0];
        $agenda = $partes[1];
        $fecha = $partes[2];
        $dias = 5;
        
        //Como me conecto con el hospital?
        $row = $primary_db->QueryArray("select * from sig_hospitales where sho_codigo='$hospital'");
        if($row)
        {
        	$endpoint = $row["sho_endpoint"];
        	$usuario = $row["sho_usuario"];
        	$clave = $row["sho_clave"];
        	
        	//Abro una conexion con el hospital
	        if(defined("DEBUG_SIGEHOS"))
	        {
	        	error_log("HOSPITAL::AJAXgetTurnosLibres SOAP($endpoint)->consultarAgenda($usuario,$clave,$agenda,$fecha,$dias,LIBRES)");
	        }
	        $client = new SoapClient($endpoint, array(
	        	'cache_wsdl' 			=> 	WSDL_CACHE_BOTH,
	        	'connection_timeout'	=>	5,
	        	'exceptions'			=>	true
	        ));
	        try {
	        	$resultado = $client->consultarAgenda($usuario,$clave,$agenda,$fecha,$dias,"LIBRES");	        
	        	$turnos = $resultado->dias;
	        	return json_encode($turnos);
	        } catch(Exception $e) {
		        error_log("HOSPITAL::AJAXgetTurnosLibres SOAP($endpoint)->consultarAgenda($usuario,$clave,$agenda,$fecha,$dias,LIBRES) - ".$e );	
	        }
        }
   		else
   		{
   			error_log("HOSPITAL::AJAXgetTurnosLibres ERROR no existe endpoint para hospital=$hospital");
   		}     
   
        return "";
    }
    
    /**
     * Funcion para tomar un turno, si el paciente no esta dado de alta en el hospital, lo doy de alta al mismo tiempo.
     */
    function AJAXtomarTurno($params)
    {
	    global $primary_db;

        $partes = explode("|",$params);
        $hospital		=(isset($partes[0])?intval($partes[0],10):1);
        $agenda			=(isset($partes[1])?intval($partes[1],10):1);
        $fecha 			=(isset($partes[2])?$partes[2]:"");
    	$paciente		=(isset($partes[3])?$partes[3]:"");
    	$use_code		=(isset($partes[4])?intval($partes[4],10):1);
    	$str_hospital	=(isset($partes[5])?$partes[5]:"");
    	$str_agenda		=(isset($partes[6])?$partes[6]:"");
    	$pais			=(isset($partes[7])?$partes[7]:"Argentina");
    	
    	//Hago vencer los turnos que por la fecha ya fueron
    	$primary_db->do_execute("update sig_turno_ciudadano set stu_status='VENCIDO' where stu_status='OTORGADO' and ciu_code='$paciente' and stu_tstamp<(NOW() - INTERVAL 1 DAY)");
    	
        //hago una validacion local para ver si hay otro turno abierto para este paciente/hospital/servicio
    	$cant = $primary_db->QueryString("select count(*) from sig_turno_ciudadano where sho_codigo='$hospital' and sag_codigo='$agenda' and ciu_code='$paciente' and stu_status='OTORGADO'");
    	if($cant>0)
    	{
    		$resultado = "ERROR: Este ciudadano ya tiene un turno no vencido para el mismo servicio. Debe cancelar ese turno antes de tomar otro.";
    		error_log("AJAXtomarTurno($params): $resultado");
    		return json_encode($resultado);
    	}
    	
    	//Como me conecto con el hospital? En el caso de COPS se usa un hospital virtual.
    	$endpoint = "";
        $row = $primary_db->QueryArray("select * from sig_hospitales where sho_codigo='$hospital'");
        if($row)
        {
        	$endpoint = $row["sho_endpoint"];
        	$usuario = $row["sho_usuario"];
        	$clave = $row["sho_clave"];
        }
        
        //Abro una conexion con el hospital
        if($endpoint!="")
        {
			try {
	        	$client = new SoapClient($endpoint,array("trace" => 1, "exceptions" => true, "cache_wsdl" => WSDL_CACHE_BOTH));
			} 
			catch(Exception $e) {
	        	error_log("AJAXtomarTurno($params) SOAP EXCEPTION $e");
	        	return json_encode("ERROR: No se puede iniciar la conexión con el hospital");
			}

			//Ajusto el tipo de documento segun el pais (CIBO para bolivia, etc)
			list($tipo_doc,$nro_doc) = explode(" ",$paciente);
    		$tipo_doc_sigehos = $this->PAIStoDOC($pais, $tipo_doc);
    		$paciente_sigehos = $tipo_doc_sigehos." ".$nro_doc;
 
	        //Doy de alta el paciente (si es que no existe)
			$r = $this->altaPaciente($client,$usuario,$clave,$paciente_sigehos,$paciente,$pais);
	        if($r!="OK")
	        {
	        	error_log("AJAXtomarTurno($params) $r");
	        	return json_encode($r);
	        }
	        
	    	//Trato de tomar el turno
	    	try {
	        	$resultado = $client->tomarTurno($usuario,$clave,$agenda,$fecha,$paciente_sigehos);
	        	
	        	//Si el turno fue ok, creo un registro de bitacora
		 		if(isset($resultado->estado) && $resultado->estado=="OK")
		 		{
		 			error_log("AJAXtomarTurno(): OK SOAP tomarTurno('$usuario','$clave','$agenda','$fecha','$paciente_sigehos') responde: ".print_r($resultado,true));
		    		
		 			$turno = $resultado->turno->idturno;
	
		 			$primary_db->do_execute("insert into sig_turno_ciudadano(sho_codigo,sag_codigo,stu_tstamp,ciu_code,stu_status,stu_turno,stu_tstamp_in,use_code,sag_agenda,sho_nombre,ciu_nacionalidad) 
		 										values('$hospital','$agenda',STR_TO_DATE('$fecha','%d/%m/%Y %k:%i:%s'),'$paciente','OTORGADO',$turno,NOW(),'$use_code','$str_agenda','$str_hospital','$pais')");
		 		}  
		 		else
		 		{
		 			error_log("AJAXtomarTurno(): ERROR SOAP tomarTurno('$usuario','$clave','$agenda','$fecha','$paciente_sigehos') responde: ".print_r($resultado,true));
		 		} 
	    	}
	    	catch(Exception $e) {
	        	error_log("AJAXtomarTurno() SOAP SOAP tomarTurno('$usuario','$clave','$agenda','$fecha','$paciente_sigehos') EXCEPTION $e");
	        	return json_encode("ERROR: No se puede solicitar el turno al hospital");
	    	}
        }
        else 
        {
        	//No hay definicion para este hospital
        	error_log("AJAXtomarTurno($params) ERROR: No esta configurado el hospital ID=$hospital");
        	return json_encode("ERROR: No esta configurado el hospital ID=$hospital");
        }    	
    	return json_encode($resultado->estado);
    }
    
    /**
     * Convertir el tipo de documento MAGICO que usa el SIGEHOS 
     * 
     * @param String $pais
     * @param String $tipo_doc
     */
	private function PAIStoDOC($pais, $tipo_doc) {
    	if($pais=="Bolivia") 		$tipo_doc = "CIBO";
        elseif($pais=="Brasil") 	$tipo_doc = "CIBR";
        elseif($pais=="Chile") 		$tipo_doc = "CICH";
        elseif($pais=="Paraguay") 	$tipo_doc = "CIPA";
        elseif($pais=="Perú") 		$tipo_doc = "CIPE";
        elseif($pais=="Uruguay") 	$tipo_doc = "CIUR";
        elseif($pais=="Argentina") 	{ /* Acepto cualquier tipo de documento */}
		else 						$tipo_doc = "PAS";
		
		return $tipo_doc;
    }
    
    
    /**
     * Verifica que el paciente exista en la agenda del hospital. Si no existe lo da de alta.
     * Si va todo bien, retorna OK, caso contrario un mensaje de error
     * @param unknown_type $client
     * @param unknown_type $usuario
     * @param unknown_type $clave
     * @param unknown_type $paciente
     */
    function altaPaciente($client,$usuario,$clave,$paciente_sigehos,$paciente,$pais)
    {
    	global $primary_db;
    	$ret = "OK";
    	   	
    	//Existe el paciente en el hospital? (via webservice)
    	$resultado = $client->consultarCiudadano($usuario,$clave,$paciente_sigehos);
    	error_log("altaPaciente() consultarCiudadano($paciente_sigehos) = ".print_r($resultado,true));
    	if( !isset($resultado->estado) )
    	{
    		error_log("altaPaciente() ERROR No se pudo interrogar al hospital.");
    		$ret = "ERROR: No se puede interrogar al hospital sobre la existencia de datos del paciente.";
        	return $ret;
    	}

    	//Se pudo hablar con el hospital pero se produjo un error en la consulta
    	if(isset($resultado->estado) && $resultado->estado!="OK")
    	{
    		error_log("altaPaciente() ERROR la consulta del paciente ha fallado. {$resultado->estado}");
    		$ret = $resultado->estado;
        	return $ret;
    	}
    	
    	//Caso donde el hospital no conoce al paciente
        if( !isset($resultado->ciudadano) )
        {
			//Datos del ciudadano en la base local	
        	$row = $primary_db->QueryArray("select 
        		ciu_apellido,
        		ciu_nombres,
        		ciu_doc_nro,
        		ciu_email,
        		ciu_sexo,
        		DATE_FORMAT(ciu_nacimiento,'%e/%c/%Y')  as ciu_nacimiento,
        		ciu_tel_fijo,
        		ciu_tel_movil, 
				ciu_dir_calle,
				ciu_dir_nro,
				ciu_dir_piso,
				ciu_dir_dpto,
				ciu_cod_postal,
				ciu_barrio,
				ciu_cgpc,
				ciu_localidad,
				ciu_provincia,
				ciu_pais,
				ciu_nacionalidad
        		from ciu_ciudadanos where ciu_doc_nro='$paciente' and ciu_nacionalidad='$pais'");
        	
        	if($row)
        	{
	        	//Doy de alta el paciente
	        	$ciud = new ciudadano();
	        	$ciud->apellido = $row["ciu_apellido"];
	        	$ciud->nombres = $row["ciu_nombres"];
	        	$ciud->doc_id = $paciente_sigehos; //PAS 34234234 o DNI 2342424
	        	$ciud->email = $row["ciu_email"];
	        	$ciud->sexo = $row["ciu_sexo"];
	        	$ciud->nacimiento = $row["ciu_nacimiento"];
	        	$ciud->nacionalidad = $row["ciu_nacionalidad"];
	        	$ciud->tel_fijo = $row["ciu_tel_fijo"];
	        	$ciud->tel_movil = $row["ciu_tel_movil"];
	        	
	        	$dire = new direccion();
	        	$dire->calle = $row["ciu_dir_calle"];
	        	$dire->altura = $row["ciu_dir_nro"];
	        	$dire->piso = $row["ciu_dir_piso"];
	        	$dire->departamento = $row["ciu_dir_dpto"];
	        	$dire->codigo_postal = $row["ciu_cod_postal"];
	        	$dire->barrio = $row["ciu_barrio"];
	        	$dire->cgpc = $row["ciu_cgpc"];
	        	$dire->localidad = $row["ciu_localidad"];
	        	$dire->partido = "";
	        	$dire->provincia = $row["ciu_provincia"];
	        	$dire->pais = $row["ciu_pais"];
	        	
	        	$ciud->direccion = $dire;
	        	
	        	//Correcion de localidad
	        	if($dire->localidad=="CABA")
	        	{
	        		$dire->localidad = "CAPITAL FEDERAL";
	        		$dire->provincia = "CAPITAL FEDERAL";
	        	}
	        	
	        	//Agrego el paciente a la base de datos del hospital
	        	$ret = $client->agregarCiudadano($usuario,$clave,$ciud);
	        	error_log("altaPaciente() Paciente agregado a la base del hospital. Resultado: ".print_r($ret,true));
        	}
        	else
        	{
        		$ret = "ERROR: No se halla al ciudadano solicitado en la base local.";
	        	error_log("altaPaciente() ERROR - Paciente inexistente en la base del call.");
        	}
        }
        else
        {
       		error_log("altaPaciente() Paciente existente en la base de datos del hospital.");
        }
                
        return $ret;
    }
    
    /**
     * 
     * CUESTIONARIO A MOSTRAR POR CADA SERVICIO
     * @param unknown_type $params
     */  
    function AJAXgetCuestionario($params)
    {
        global $primary_db;

        //Parametros
        $partes = explode("|",$params);
        $hospital = $partes[0];
        $agenda = $partes[1];
        
        //Cual es el cuestionario a utilizar?
        $cuestionario = $primary_db->QueryString("select scu_codigo from sig_agenda where sho_codigo='$hospital' and sag_codigo='$agenda'");
        if($cuestionario=="")
        {
        	return json_encode("");
        }
        
        //Proceso cuestionario
        $sql = "SELECT spr_pregunta,spr_presentacion,spr_opciones FROM sig_preguntas WHERE scu_codigo='$cuestionario'";
        $re = $primary_db->do_execute($sql);
        $q = 1;
        $html = '<table>';
        while( $row=$primary_db->_fetch_row($re) )
        {
        	$id = "cuest_".$q;
        	$html.= '<tr><td>'.$row["spr_pregunta"].'</td>';
        	if($row["spr_presentacion"]=="TEXTO")
        	{	
        		$html.= '<td><input type="text" name="'.$id.'" id="'.$id.'"></td></tr>';
        	}
	        if($row["spr_presentacion"]=="LISTA" || $row["spr_presentacion"]=="MULTIPLE")
        	{
        		$html.= '<td><select name="'.$id.'" id="'.$id.'">';
        		$op = explode(";",$row["spr_opciones"]);
        		foreach($op as $val)
        		{
        			$html.= '<option value="'.$val.'">'.$val;
        		}
        		$html.= '</select></td></tr>';
        	}
        	$q++;
        }
		$html.= '<table>';
        return json_encode($html);
    }

    /**
     * 
     * Consultar al SIGEHOS 
     * @param unknown_type $url
     */
	private function askSigehos($url)
    {
    	$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
		$json = curl_exec($ch);
		curl_close($ch);
    	
		error_log("askSigehos($url) '$json'");
		
		if($json=="")
		{
			return null;
		}
		return json_decode($json);
    }
    
    function AJAXgetTodosLosServicios($params)
    {
        global $primary_db;
		$conjunto = array();

		list($edad,$sexo) = explode("|",$params);
		
		//Sanitizo la entrada
		if(strlen($sexo)>0)
		{
			$sexo = substr($sexo, 0, 1);
		}
		else 
		{
			$sexo = "N";
		}
		
		if($edad=="")
		{
			$edad = 0;
		}
		else 
		{
			$edad = intval($edad,10);
		}
		
        //Datos de los servicios
        $sql = "SELECT distinct sie_id_esp,sie_descripcion 
        	FROM sig_especialidades 
        	WHERE (sie_edad_desde<={$edad} or sie_edad_desde=0) and (sie_sexo='{$sexo}' or sie_sexo='N') 
        	ORDER BY 2";
        $re = $primary_db->do_execute($sql);
        while( $row=$primary_db->_fetch_row($re) )
        {
			$conjunto[] = array( 
				"codigo" => $row[0],
				"servicio" => $row[1]
			);
       	}			
        return json_encode($conjunto);
    }
    
    function AJAXgetProfesionales($params)
    {
        global $primary_db;
		$conjunto = array();
				        
        //Datos de los servicios
        $sql = "SELECT distinct sie_id,sip_id,sip_nombre,sip_apellido FROM sig_profesionales order by sip_apellido,sip_nombre";
        $re = $primary_db->do_execute($sql);
        while( $row=$primary_db->_fetch_row($re) )
        {
			$conjunto[] = array( 
				"codigo" => $row[0]."|".$row[1],
				"nombre" => $row[3]." ".$row[2]
			);
       	}			
        return json_encode($conjunto);
    }
    
    function AJAXgetProfesionalesAgendas($params)
    {
    	global $primary_db;
		$conjunto = array();
    	
		list($hospital,$profesional) = explode("|",$params);
		
        //Datos de la prestacion
        $sql = "SELECT sie_id,sie_id_esp,sia_id,sip_id FROM sig_profesionales WHERE sie_id={$hospital} and sip_id={$profesional}";
        $re = $primary_db->do_execute($sql);
        while( $row=$primary_db->_fetch_row($re) )
        {
        	$hospital = $row[0];
        	$servicio = $row[1];
        	$agenda = $row[2];
        	$profesional = $row[3];
        	
        	$hospital_desc = $primary_db->QueryString("select sho_nombre from sig_hospitales where sho_codigo={$hospital}");
			$servicio_desc = $primary_db->QueryString("select sie_descripcion from sig_especialidades where sie_id_esp={$servicio} limit 1");
        	$agenda_desc = $primary_db->QueryString("SELECT sia_nombre FROM sig_agendas WHERE sia_id={$agenda} and sie_id={$hospital} and sie_id_esp={$servicio}"); 
			
        	$conjunto[] = array( 
				"hospital"		=> $hospital,
				"hospital_desc"	=> $hospital_desc,
				"servicio"		=> $servicio,
				"servicio_desc"	=> $servicio_desc,
				"codigo" 		=> $agenda,
				"agenda" 		=> $agenda_desc
			);
       	}
		return json_encode($conjunto);	
    }
}

class ciudadano
{    
	/** @var string Tipo y numero del documento */
	public $doc_id;
	
	/** @var string Nombres de la persona */
	public $nombres;

	/** @var string Apellido de la persona */
	public $apellido;
	
	/** @var string Fecha de nacimiento d m a */
	public $nacimiento;
	
	/** @var string nacionalidad */
	public $nacionalidad;
	
	/** @var direccion direccion */
	public $direccion;
	
	/** @var string telefono fijo */
	public $tel_fijo;
	
	/** @var string telefono movil */
	public $tel_movil;

	/** @var string sexo M o F */
	public $sexo;
	
	/** @var string email */
	public $email;	
}
	

/** Datos de una direccion
 * 
 * @author jcordero
 *
 */
class direccion
{		
	/** @var string Nombre de la calle */
	public $calle;
	
	/** @var string Numero de la puerta */
	public $altura;

	/** @var string Asentamiento NHT*/
	public $asentamiento;
	
	/** @var string Piso */
	public $piso;
	
	/** @var string Departamento */
	public $departamento;
	
	/** @var string Barrio */
	public $barrio;
	
	/** @var string Localidad */
	public $localidad;

	/** @var string Partido */
	public $partido;
	
	/** @var string CGPC */
	public $cgpc;
	
	/** @var string provincia */
	public $provincia;
	
	/** @var string pais */
	public $pais;
	
	/** @var string Codigo postal */
	public $codigo_postal;
}



?>