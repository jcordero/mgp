<?php
if(session_id() == "") 
{
	session_start();
}
include_once "common/cdatatypes.php";
include_once "homepage/callsession.php";
include_once "common/csession.php";

class CDH_HOME extends CDataHandler
{
    private $m_session;
    
    function __construct($parent)
    {
		parent::__construct($parent);
		$fld = $this->m_parent;
        $this->m_session = new callsession();
	}

	function setAnonimo($user_session)
	{
		session_id($user_session);
        $this->m_session->person_status = 'ANONIMO';
        $this->m_session->person_doc = '';
        $this->m_session->person_nombres = '';
        $this->m_session->person_apellido = '';
        $this->m_session->person_id = 0;
        $this->m_session->person_sexo = 'N';
        $this->m_session->person_edad = 0;
        $this->m_session->person_pais = "Argentina";
        
        $this->m_session->saveSession("person");
	}
	
    /** Buscar un ciudadano en la base
     * Enviar en el parametro de entrada, separado por pipes, Documento + Apellido + Nombres + ANI + IDSesion
     * @param $params
     * @return unknown_type
     */
    function doBuscar($params)
    {
        global $primary_db;
        $conjunto = array();
        $url="";
        $apellido="";
        $nombres="";
        $doc="";
        $ani="";
        $user_session = "";
		$obj_cops = null;
		$res = array();
		
        list($doc,$apellido,$nombres,$ani,$user_session,$pais) = explode('|',$params);
        
        //si no hay parametro sesion no se puede avanzar
        if($user_session=="")
        {
            error_log("doBuscar No se indica sesion");
            return json_encode(array( "ciudadanos"=>$conjunto, "url"=>$url));
        }

        //No hay datos para buscar...
        session_id($user_session);
        if(strlen($doc)<=6 && $apellido=='' && $ani=="")
        {
        	$this->setAnonimo($user_session);
            return json_encode(array( "ciudadanos"=>$conjunto, "url"=>$url));
        }

        //Esta declarado el doc?, lo busco por ahi
        if(strlen($doc)>6)
        {
            $sql = "SELECT ciu_code,ciu_nombres,ciu_apellido,ciu_doc_nro,ciu_sexo,ciu_nacimiento,ciu_nacionalidad FROM ciu_ciudadanos 
            			WHERE ciu_doc_nro='$doc' AND (ciu_nacionalidad is null OR ciu_nacionalidad='$pais' OR ciu_nacionalidad='')";
        }
        else
        {
            if($apellido!='' && $nombres=="")
            {
                $sql = "SELECT ciu_code,ciu_nombres,ciu_apellido,ciu_doc_nro,ciu_sexo,ciu_nacimiento,ciu_nacionalidad FROM ciu_ciudadanos 
	                		WHERE ciu_apellido like '$apellido%'  AND (ciu_nacionalidad is null OR ciu_nacionalidad='$pais' OR ciu_nacionalidad='')";
            }
            else
        	{
                $sql = "SELECT ciu_code,ciu_nombres,ciu_apellido,ciu_doc_nro,ciu_sexo,ciu_nacimiento,ciu_nacionalidad FROM ciu_ciudadanos 
                			WHERE ciu_apellido like '$apellido%' and ciu_nombres like '$nombres%'  AND (ciu_nacionalidad is null OR ciu_nacionalidad='$pais' OR ciu_nacionalidad='')";
            }
        }

        $re = $primary_db->do_execute($sql);
        while( $row=$primary_db->_fetch_row($re) )
        {
            $conjunto[] = array(
            	"ciu_code" 		=> 	$row[0],
            	"ciu_nombres"	=>	$row[1],
           		"ciu_apellido"	=>	$row[2],
            	"ciu_doc_nro"	=> 	$row[3],
            	"sexo"			=>	$row[4],
            	"edad"			=>	$this->calcularEdad($row[5]),
            	"cops_id"		=> 	0,
            	"pais"			=> 	$row['ciu_nacionalidad']
            );
        }
		$primary_db->_free_result($re);

    	//Esta inscripto en COPS?
		$this->m_session->person_cops_id = 0;
			
        //Tengo el documento declarado?? Si en el DOC no puedo llamar a COPS
        if( $doc!="" && defined("URL_SIGEHOS_COPS") )
        {
        	list($tipo_doc,$nro_doc) = explode(" ",$doc);
        	$nro_doc = intval($nro_doc,10);

        	//FIX PARA LOS EXTRANJEROS
        	$tipo_doc = $this->PAIStoDOC($pais, $tipo_doc);
        	        
        	$cops_url = URL_SIGEHOS_COPS."/sigehos/cops/api/afiliado/?tipo_doc=$tipo_doc&nro_doc=$nro_doc";
			$obj_cops = $this->askSigehos($cops_url);
			if($obj_cops)
			{
				if( isset($obj_cops->id) )	
				{
					$this->m_session->person_cops_id = $obj_cops->id;
				}
				else
				{
					error_log("HOME::doBuscar() ERROR: No existe en la respuesta de COPS el ID de afiliado");
				}
			}
        }
        
        //Retorno conjunto vacio? o sea no hay datos en la base local
        if(count($conjunto)==0)
        {
        	//No esta en la base del call, pero esta en la base de COPS?
			if($obj_cops)
			{
				//Creo el CIUDADANO en la base local
				list($tipo_doc,$nro_doc) = explode(" ",$doc);
				$params = array(
					"ciu_code"			=> $primary_db->Sequence("ciu_ciudadanos"),
					"ciu_nombres"		=> $obj_cops->persona->nombres,
					"ciu_apellido"		=> $obj_cops->persona->apellido,
					"ciu_sexo"			=> $this->convertToSexo($obj_cops->persona->sexo), //F o M o N
					"ciu_nacimiento"	=> $obj_cops->persona->fecha_nac, //AAAA-MM-DD
					"ciu_doc_nro"		=> $doc,
					"use_code"			=> $_SESSION['user_id'],
					"pais"				=> $this->DOCtoPAIS($tipo_doc)
				);
				
				$sql = "insert into ciu_ciudadanos(ciu_code,ciu_nombres,ciu_apellido,ciu_sexo,ciu_nacimiento,ciu_doc_nro,ciu_no_llamar,ciu_no_email,ciu_localidad,ciu_provincia,ciu_pais,ciu_ultimo_acceso,ciu_canal_ingreso,use_code,ciu_estado,ciu_tstamp,ciu_tipo_persona,ciu_nacionalidad) 
					values(:ciu_code:,':ciu_nombres:',':ciu_apellido:',':ciu_sexo:',':ciu_nacimiento:',':ciu_doc_nro:','NO','NO','CABA','CABA','ARGENTINA',NOW(),'CALL',':use_code:','ACTIVO',NOW(),'FISICA',':pais:')";
				$primary_db->do_execute($sql,$res,$params);
				error_log("INSERTO CIUDADANO ".print_r($params,true));
				
				//Respuesta ciu_code,ciu_nombres,ciu_apellido,ciu_doc_nro
				$edad = $this->calcularEdad($params['ciu_nacimiento']);
				$conjunto[] = array(
					"ciu_code"		=> $params['ciu_code'],
					"ciu_nombres"	=> $params['ciu_nombres'],
					"ciu_apellido"	=> $params['ciu_apellido'],
					"ciu_doc_nro"	=> $params['ciu_doc_nro'],
				    "sexo"			=> $params['ciu_sexo'],
            		"edad"			=> $edad,
            		"cops_id"		=> $obj_cops->id,
					"pais"			=> $params['pais']
				); 
				
				//Salvo en la session
				$this->m_session->person_status = 'IDENTIFICADO';
            	$this->m_session->person_apellido = $params["ciu_apellido"];
            	$this->m_session->person_nombres = $params['ciu_nombres'] ;
            	$this->m_session->person_doc = $params['ciu_doc_nro'];
            	$this->m_session->person_id = $params['ciu_code'];
            	$this->m_session->person_cops_id = $obj_cops->id;
            	$this->m_session->person_edad = $edad;
            	$this->m_session->person_sexo = $params['ciu_sexo'];
            	$this->m_session->person_pais = $params['pais'];	
			}
			else 
			{
				//No puedo encontrar  a la persona en ningun lado... pido carga manual
        		$this->setAnonimo($user_session);        
			}
        }
        elseif(count($conjunto)>1)
        {
        	//Hay mas de una persona que coincide
        	$this->setAnonimo($user_session);        
		}
        else //count($conjunto) == 1 Hay una sola persona que se encontró en la base local
        {
            $this->m_session->person_status = 'IDENTIFICADO';
            $this->m_session->person_apellido = $conjunto[0]['ciu_apellido'];
            $this->m_session->person_nombres = $conjunto[0]['ciu_nombres'] ;
            $this->m_session->person_doc = $conjunto[0]['ciu_doc_nro'];
            $this->m_session->person_id = $conjunto[0]['ciu_code'];
            $this->m_session->person_edad = $conjunto[0]['edad'];
            $this->m_session->person_sexo = $conjunto[0]['sexo'];
            $this->m_session->person_pais = $conjunto[0]['pais'];
            
            //Agrego al conjunto el dato de COPS que falta
            $conjunto[0]['cops_id'] = $this->m_session->person_cops_id;
            
            //Actualizo el registro local con la data que viene de COPS
            if($obj_cops)
            {	
            	$sexo = $this->convertToSexo($obj_cops->persona->sexo);
            	$this->m_session->person_sexo = $sexo; 
            	$conjunto[0]['sexo'] = $sexo;
   	         	$this->m_session->person_apellido = $obj_cops->persona->apellido;
   	         	$conjunto[0]['ciu_apellido'] = $obj_cops->persona->apellido;
            	$this->m_session->person_nombres = $obj_cops->persona->nombres;
            	$conjunto[0]['ciu_nombres'] = $obj_cops->persona->nombres;
            
            	$sql = "UPDATE ciu_ciudadanos SET ciu_nombres='{$obj_cops->persona->nombres}',ciu_apellido='{$obj_cops->persona->apellido}',ciu_sexo='{$sexo}',ciu_nacimiento='{$obj_cops->persona->fecha_nac}' WHERE ciu_code='{$this->m_session->person_id}'";
	            $primary_db->do_execute($sql,$res);
            }        
            
            //Marco el ultimo acceso
            $sql = "UPDATE ciu_ciudadanos SET ciu_ultimo_acceso=NOW() WHERE ciu_code='{$this->m_session->person_id}'";
            $primary_db->do_execute($sql,$res);
            
            //Actualizo la sesion si esta abierta
            if($this->m_session->talk_session!=0)
            {
                $sql = "UPDATE ciu_sesiones SET ciu_code='{$this->m_session->person_id}' WHERE cse_code='{$this->m_session->talk_session}'";
                $primary_db->do_execute($sql,$res);
            }            
        }
        
        //Salvo el resultado en la sesion
        $this->m_session->saveSession("person");

        //No hay datos locales... Pido que se carguen los datos a mano. (Ver como hacer que ser carguen desde el SIGEHOS)
        if(count($conjunto)==0)
        {
        	$sess = new CSession();
        	$host = $_SERVER["HTTP_HOST"];
        	$url = $sess->encodeURL(WEB_PATH."/lmodules/ciudadanos/ciudadanos_maint_n.php?OP=N&ciu_doc_nro=$doc&ciu_tel_fijo=$ani&ciu_tel_movil=$ani&ciu_nacionalidad=$pais");
        }
                
        $resp = array("ciudadanos"=>$conjunto, "url"=>$url);
        error_log("HOME::doBuscar() RESPONDE: ".print_r($resp,true));
        return json_encode($resp);
    }

    private function DOCtoPAIS($tipo_doc) {
    	if($tipo_doc="CIBO") $pais=="Bolivia";
        elseif($tipo_doc="CIBR") $pais=="Brasil";
        elseif($tipo_doc="CICH") $pais=="Chile";
        elseif($tipo_doc="CIPA") $pais=="Paraguay";
        elseif($tipo_doc="CIPE") $pais=="Perú";
        elseif($tipo_doc="CIUR") $pais=="Uruguay";
        elseif($tipo_doc="CI" || $tipo_doc="LE" || $tipo_doc="DNI" ) $pais=="Argentina";
		else $pais = ""; //$tipo_doc = "PAS";
  		
		return $pais;
    }
    
    private function PAIStoDOC($pais, $tipo_doc) {
    	if($pais=="Bolivia") $tipo_doc = "CIBO";
        elseif($pais=="Brasil") $tipo_doc = "CIBR";
        elseif($pais=="Chile") $tipo_doc = "CICH";
        elseif($pais=="Paraguay") $tipo_doc = "CIPA";
        elseif($pais=="Perú") $tipo_doc = "CIPE";
        elseif($pais=="Uruguay") $tipo_doc = "CIUR";
        elseif($pais=="Argentina") { /* Acepto cualquier tipo de documento */}
		else $tipo_doc = "PAS";
		
		return $tipo_doc;
    }
    
    private function calcularEdad($nacimiento) {
    	try {
    		//Nacimiento 22/09/1968
    		list($a,$m,$d) = explode("-",$nacimiento);
    		$ahora = date("Y");
    		
    		$edad = intval($ahora) - intval($a);
			if($edad)
	    		return $edad;
    	}
    	catch(Exception $e)
    	{
    		error_log("calcularEdad($nacimiento) $e");
    	}
    	return 0;
    }
    
    private function convertToSexo($sexo) {
    	if($sexo=="M")
    		return "MASCULINO";
    	if($sexo=="F")
    		return "FEMENINO";
    		
    	return "SIN ESPECIFICAR";	
    }
    
    /** Anular los datos del ciudadano actual, para hacer la sesion anonima
     *  Enviar en el parametro el IDSesion
     * @param $params
     * @return unknown_type
     */
    function doAnonimo($params)
    {
        global $primary_db;
        $user_session = $params;
        $url = "";
        
        if($user_session !="")
        {
            $this->setAnonimo($user_session);            
            $sess = new CSession();
        	$host = $_SERVER["HTTP_HOST"];
        	$url = $sess->encodeURL("http://$host/lmodules/ciudadanos/sesion_cierre.php?OP=M");
        }
        else
        {
            error_log("doAnonimo Error no se indica sesion a modificar");
        }

        return json_encode(array("url"=>$url));
    }

	/** doNuevoTicket
	 * 
	 * @param $params
	 * @return unknown_type
	 */    
    function doNuevoTicket($params)
    {
        $user_session = $params;
        $url = "";
        
        if($user_session !="")
        {
            session_id($user_session);
            
            $sess = new CSession();
        	$host = $_SERVER["HTTP_HOST"];
        	$url = $sess->encodeURL(WEB_PATH."/lmodules/tickets/tickets_maint_n.php?OP=N");
        }
        else
        {
            error_log("doNuevoTicket Error no se indica sesion a modificar");
        }

        return json_encode(array("url"=>$url));
    }
    
	/** doNuevoTurno
	 * 
	 * @param $params
	 * @return unknown_type
	 */    
    function doNuevoTurno($params)
    {
        list($user_session,$tipo) = explode("|",$params);
        $url = "";
        
        if($user_session !="")
        {
            session_id($user_session);
            
            $sess = new CSession();
        	$host = $_SERVER["HTTP_HOST"];

        	if($tipo=="GENERAL")
        		$target = "http://$host/lmodules/sigehos/nuevoturno.php?OP=N";
        	elseif($tipo=="COPS")
        		$target = "http://$host/lmodules/sigehos/nuevoturno_cops.php?OP=N";
        	elseif($tipo=="SERVICIO")
        		$target = "http://$host/lmodules/sigehos/nuevoturno_servicio.php?OP=N";
        	elseif($tipo=="PROFESIONAL")
        		$target = "http://$host/lmodules/sigehos/nuevoturno_profesional.php?OP=N";
        	elseif($tipo=="PRIMERO")
        		$target = "http://$host/lmodules/sigehos/nuevoturno_primero.php?OP=N";
 	
        	$url = $sess->encodeURL($target);
        }
        else
        {
            error_log("doNuevoTicket Error no se indica sesion a modificar");
        }

        return json_encode(array("url"=>$url));
    }
    
    /** 
     * doModificar datos del ciudadano logeado
     * 
     * @param $params
     * @return unknown_type
     */
    
    function doModificar($params)
    {
        $url = "";
        $par = explode("|",$params);
        if(count($par)==2)
        {
        	$user_session = $par[0];
        	$doc = $par[1];
            session_id($user_session);
            
            $sess = new CSession();
        	$host = $_SERVER["HTTP_HOST"];
        	$url = $sess->encodeURL(WEB_PATH."/lmodules/ciudadanos/ciudadanos_maint.php?OP=M&ciu_code=$doc");
       
        }
        else
        {
            error_log("doModificar requiere 2 paramaetros, sesion y documento");
        }

        return json_encode(array("url"=>$url));
    }
    
    
    /** Buscar tickets en la base.
     *  Busca en la base local los tickets de DENUNCIAS, SOLICITUDES y QUEJAS y en la base
     *  remota del SUR los reclamos.
     *  Mandar en el parametro, separado por pipes, el NUMERO +  AÑO del ticket buscado.
     * @param $params
     * @return string
     */
    function doBuscarTickets($params)
    {
        global $primary_db,$reclamos_db;
        $nro="";
        $anio="";
        $ciu_code = "";

        $partes = explode('|',$params);
        if(count($partes)==2)
        {
            $nro = $partes[0];
            $anio = $partes[1];
        
            //No hay datos para buscar... 
        	if( $nro=="" || $anio=="")
        	{
            	return json_encode(array());
        	}
        }
        elseif(count($partes)==1)
        {
            $ciu_code = $partes[0];
        
            //No hay datos para buscar... (ciu_code=0 es ciudadano ANONIMO)
        	if( $ciu_code=="" || $ciu_code==0)
        	{
            	return json_encode(array());
        	}
        }

        

        //Busco por codigo en los reclamos
        $conjunto = array();
        if($nro!="" && $anio!="")
        {
        	$conjunto1 = array();
        	$conjunto2 = array();
        	
            //Busco en los reclamos
            if(defined("SUR_ACTIVO"))
            {
	        	$sql = "SELECT * FROM v_ticket WHERE numero='$nro' AND anio='$anio'";
	        	$re = $reclamos_db->do_execute($sql);
		        while( $row=$reclamos_db->_fetch_row($re) )
		        {
		            $conjunto1[] = $row;
		        }
		        $reclamos_db->_free_result($re);
            }
            
	        //Busco en los tickets
	        $sql = "SELECT * FROM v_ticket WHERE tic_nro='$nro' AND tic_anio='$anio'";
        	$re = $primary_db->do_execute($sql);
	        while( $row=$primary_db->_fetch_row($re) )
	        {
	            //Decodifico la direccion 
        		$xml = htmlspecialchars_decode( $row["ubicacion"], ENT_QUOTES );
        		$row = array_merge($row, array("ubicacion_text" => $this->ubicacionToText($xml) ));
            	$conjunto2[] = $row;
	        }
	        $primary_db->_free_result($re);
	        
	        $conjunto = array_merge($conjunto1,$conjunto2);
        }
        else
        {
            if($ciu_code!='')
            {
                $sql = "SELECT tipo,anio,numero,prestacion,ubicacion,estado,ciudadano,ciu_code FROM v_ticket_ciu WHERE ciu_code='$ciu_code'";
            	$re = $primary_db->do_execute($sql);
        		while( $row=$primary_db->_fetch_row($re) )
        		{
        			//Decodifico la direccion 
        			$xml = htmlspecialchars_decode( $row["ubicacion"], ENT_QUOTES );
        			$row = array_merge($row, array("ubicacion_text" => $this->ubicacionToText($xml) ));
            		$conjunto[] = $row;
        		}
        		$primary_db->_free_result($re);
            }
        }

        //session_id($user_session);  
        $sess = new CSession();
        
        //Agrego los botones...
        foreach($conjunto as $key=>$elemento)
        {
        	//Ver reclamo -> Columna 100
        	if($elemento[0]=="RECLAMO")
        	{
        		if(defined("SUR_ACTIVO"))
        		{
        			$url = $sess->encodeURL(WEB_PATH."/lmodules/tickets/reclamos_maint.php?OP=V&anio=$elemento[1]&numero=$elemento[2]&derivacion=-");
        		}
        		else
        		{
        			$url = $sess->encodeURL(WEB_PATH."/lmodules/tickets/ticket_maint.php?OP=V&tic_anio=$elemento[1]&tic_nro=$elemento[2]&tic_tipo=$elemento[0]");
        		}
        		$conjunto[$key]['url_ver'] = $url;
        		$conjunto[$key]['ver_reclamo'] = "Ver Reclamo";
        		
        		//Reiterar -> Columna 101
        		//$url = $sess->encodeURL("/lmodules/tickets/reclamos_reit.php?OP=M&anio=$elemento[1]&numero=$elemento[2]&derivacion=-");
        		//$conjunto[$key]['url_reiterar'] = $url;
        		//$conjunto[$key]['reiterar'] = "Reiterar";
        		$conjunto[$key]['reiterar'] = "";
        		$conjunto[$key]['ver_ticket'] = "";
        	}
        	else 
        	{
        		//Es una denuncia / solicitud / queja -> Columna 100
        		$url = $sess->encodeURL(WEB_PATH."/lmodules/tickets/ticket_maint.php?OP=V&tic_anio=$elemento[1]&tic_nro=$elemento[2]&tic_tipo=$elemento[0]");
        		$conjunto[$key]['url_ver'] = $url;
        		
        		$conjunto[$key]['ver_reclamo'] = "";
        		$conjunto[$key]['reiterar'] = "";
        		$conjunto[$key]['ver_ticket'] = "Ver Ticket";
        	}
        }
        return json_encode($conjunto);
    }

    /** Iniciar una sesion.
     * NO SE ALTERA EL ESTADO DE IDENTIFICACION DE LA PERSONA. SOLO SE CAMBIA EL ESTADO DE LA CONEXION.
     * Enviar en el parametro, separado por pipes:
     * ANI + IDSesion + CallReferenceID + entryPoint + skill
     * @param $params
     * @return string
     */
    function doIniciar($params)
    {
        global $primary_db,$sess;
        $ani="";
        $user_session = "";
        $ret_json = "";
        $call_id = "";
		$entry_point = "";
		$skill = "";
		
		//Desarmo el parametro de entrada
        $partes = explode('|',$params);
        if(count($partes)==5)
        {
            $ani = $partes[0];
            $user_session = $partes[1];
            $call_id = $partes[2];
            $entry_point  = $partes[3];
            $skill  = $partes[4];
        }
        else
        {
        	error_log("doIniciar requiere 5 paramatros. Recibido: $params");
        	return json_encode("Error: cantidad incorrecta de parametros");
        }
        
        //Cargo la sesion
        if($user_session=="")
        {
            //sin sesion no puedo hacer nada...
            return json_encode("Error: sesion no especificada");
        }
        else
        {
            session_id($user_session);
            $this->m_session->loadSession();
        }

        //Si hay una sesion abierta, para OTRO ani, la cierro y salgo
        if($this->m_session->talk_session!=0 && $this->m_session->talk_ani!=$ani )
        {
            $this->doTerminar($user_session);
            return json_encode("Sesion cerrada");
        }

        //Si hay una sesion abierta, para el mismo ANI, salgo
        if($this->m_session->talk_session!=0 && $this->m_session->talk_ani==$ani )
        {
            return json_encode("Sesion abierta");
        }

        //Por defecto se elije al codigo 0 que es el ciudadano ANONIMO
        $ani = substr($ani,0,15);
        $ciu_code = 0; //ANONIMO
        $use_code = $_SESSION["user_id"];
        
        //Pido un nuevo codigo de sesion
        $sql = "call getnext('CIU_SESIONES')";
        $re = $primary_db->do_execute($sql);
        $conjunto = array();
        if( $row=$primary_db->_fetch_row($re,0) )
        {
            $conjunto[] = $row;
        }
        $primary_db->_free_result($re);
        $cse_code = $conjunto[0][0];
		
        //Cierro cualquier sesion abandonada por este operador
        $sql = "UPDATE ciu_sesiones SET cse_estado='ABANDONADA',cse_duracion=TIMESTAMPDIFF(SECOND,cse_tstamp,NOW())  WHERE cse_estado='ABIERTA' AND use_code='$use_code'";
        $re = $primary_db->do_execute($sql);
        
        //Registro el inicio de la sesion
        $sql = "INSERT INTO ciu_sesiones(cse_code,ciu_code,cse_ani,cse_tstamp,cse_duracion,use_code,cse_nota,cse_call_id,cse_skill,cse_estado) ";
     	$sql.= "VALUES($cse_code,$ciu_code,'$ani',NOW(),0,'$use_code','','$call_id','$entry_point','ABIERTA')";
        $re = $primary_db->do_execute($sql);
        
        //Seteo los resultados en la sesion
        $this->m_session->talk_session = $cse_code; //codigo de la nueva sesion retornado por procedure "nueva_sesion"
        $this->m_session->talk_status = "CONECTADO";
        $this->m_session->talk_ani = $ani;
        $this->m_session->talk_begin = time();
        $this->m_session->talk_end = 0;
        $this->m_session->talk_call_id = $call_id;
        $this->m_session->talk_entry_point = $entry_point;
        $this->m_session->talk_skill = $skill;
        $this->m_session->saveSession("talk");
                
        return $ret_json;
    }

    /** Cerrar la conversacion actual, pasar a interlocutor anonimo
     * 
     * @param $params
     * @return string
     */
    function doTerminar($params)
    {
		$user_session = $params;
        $url = "";
        
        if($user_session !="")
        {
            session_id($user_session);
            
            $sess = new CSession();
        	$host = $_SERVER["HTTP_HOST"];
        	$url = $sess->encodeURL("http://$host/lmodules/ciudadanos/sesion_cierre.php?OP=M");
        }
        else
        {
            error_log("doNuevoTicket Error no se indica sesion a modificar");
        }

        return json_encode(array("url"=>$url));
   }

    /** Buscar contactos previos (sesiones) del ciudadano
     * pasar en el parametro, separado por pipes: IDCiudadano + FechaInicio + FechaFin + IDSesion
     * @param $params
     * @return unknown_type
     */
    function doBuscarContactos($params)
    {
        global $primary_db,$sess;
        $id="";
        $desde="";
        $hasta="";
        $user_session = "";
		$conjunto = array();

		//Expando los parametros
        $partes = explode('|',$params);
        if(count($partes)==4)
        {
            $id = $partes[0];
            $desde = $partes[1];
            $hasta = $partes[2];
            $user_session = $partes[3];
        }
        else
        {
        	error_log("doBuscarContactos() ERROR Espero 4 parametros. Recibi: $params");
        	return json_encode($conjunto);
        }

        //Es el usuario ANONIMO?
        if($id==0)
        {
        	return json_encode($conjunto);
        }
                
        //Busco los contactos de este usuario
        $sql = "SELECT cse_code,cse_ani,cse_tstamp,cse_duracion,us.use_name as use_code,cse_nota ";
        $sql.= "FROM ciu_sesiones se LEFT OUTER JOIN sec_users us ON se.use_code=us.use_code WHERE ciu_code='$id' AND cse_duracion>0";
        if($desde!="" && $hasta!="")
        {
            $sql.= " AND cse_tstamp between '$desde' and '$hasta'";
        }
        $sql.= " ORDER BY cse_tstamp desc";

        $re = $primary_db->do_execute($sql);
        $j=0;
        while( $row=$primary_db->_fetch_row($re,$j++) )
        {
        	$url = WEB_PATH."/lmodules/ciudadanos/sesion_maint.php?OP=V&cse_code=".$row['cse_code'];
        	$ix = $sess->encodeURL($url);
        	
        	$conjunto[] = array( 
        		"cse_tstamp" => $row['cse_tstamp'],
        		"cse_duracion" => $row['cse_duracion'],
        		"use_code" => $row['use_code'],
        		"cse_ani" => $row['cse_ani'],
        		"cse_nota" => $row['cse_nota'],
        		"acciones" => "Detalle",
        		"detalle" => $ix,
        	);
        }
		$primary_db->_free_result($re);
		
        return json_encode($conjunto);
    }

    /** Buscar un ciudadano en la base dado su ANI, e iniciar la sesion si el entry_pont != 0
     * pasar en el parametro, separado por un pipe:
     * ANI + EntryPoint + IDSesion + CallReferenceID + Skill
     * @param $params
     * @return string
     */
    function doBuscarAni($params)
    {
        global $primary_db,$sess;
        $ani="";
        $entry_point = "";
        $user_session = "";
        $call_id = "";
		$skill = "";
		
		//Expando los parametros
        $partes = explode('|',$params);
        if(count($partes)==5)
        {
            $ani = $partes[0];
            $entry_point = $partes[1];
            $user_session = $partes[2];
            $call_id = $partes[3];
            $skill = $partes[4];
        }
        else
        {
            error_log("doBuscarAni() ERROR Se esperan 5 parametros. Recibi: $params");
            return json_encode(array());
        }

        //Sin sesion iniciada no se puede hacer nada
        if($user_session=="")
        {
            error_log("doBuscarAni No se indica sesion");
            return json_encode(array());
        }
        else
        {
        	session_id($user_session);
        }

        //Entre en conexion? si, entonces inicio una sesion con este ANI. No se altera la identificacion del ciudadano.
        if( $entry_point!="0" )
        {
            $this->doIniciar($ani."|".$user_session."|".$call_id."|".$entry_point."|".$skill);
        }

        //No hay ANI para buscar... Paso el estado a ANONIMO y salgo
        if( trim($ani)=="" || substr($ani,0,5)=="eolix" )
        {
            $this->m_session->person_status = 'ANONIMO';
            $this->m_session->person_doc = '';
            $this->m_session->person_nombres = '';
            $this->m_session->person_apellido = '';
            $this->m_session->person_id = 0;
            $this->m_session->saveSession("person");
            return json_encode(array());
        }

        //busco al ani en las sesiones viejas
        if(substr($ani,0,1)=="0")
        {
        	//Busqueda por ANI completo
	        $sql = "SELECT DISTINCT se.ciu_code,IFNULL(ciu_apellido,'Anonimo') as ciu_apellido,IFNULL(ciu_nombres,'') as ciu_nombres, ciu_doc_nro ";
	        $sql.= "FROM ciu_sesiones se LEFT OUTER JOIN ciu_ciudadanos ci ON ci.ciu_code=se.ciu_code ";
	        $sql.= "WHERE cse_ani='$ani' and se.ciu_code<>0 and ciu_doc_nro is not null";
        }
        else
        {
        	//Busqueda por ANI parcial
	        $sql = "SELECT DISTINCT se.ciu_code,IFNULL(ciu_apellido,'Anonimo') as ciu_apellido,IFNULL(ciu_nombres,'') as ciu_nombres, ciu_doc_nro ";
	        $sql.= "FROM ciu_sesiones se LEFT OUTER JOIN ciu_ciudadanos ci ON ci.ciu_code=se.ciu_code ";
	        $sql.= "WHERE cse_ani like '%$ani' and se.ciu_code<>0 and ciu_doc_nro is not null";
        }
	    $re = $primary_db->do_execute($sql);
        $conjunto = array();
        $j=0;
        while( $row=$primary_db->_fetch_row($re,$j++) )
        {
            $conjunto[] = $row;
        }
		$primary_db->_free_result($re);
		
        //Retorno conjunto vacio? o mas de un ciudadano?
        if(count($conjunto)==0 || count($conjunto)>1)
        {
            $this->m_session->person_status = 'ANONIMO';
            $this->m_session->person_doc = '';
            $this->m_session->person_nombres = '';
            $this->m_session->person_apellido = '';
            $this->m_session->person_id = 0;
        }
        else //if(count($conjunto)==1)
        {
        	if($conjunto[0]['ciu_code']!=0)
        	{
	            $this->m_session->person_status = 'IDENTIFICADO';
	            $this->m_session->person_apellido = $conjunto[0]['ciu_apellido'];
	            $this->m_session->person_nombres = $conjunto[0]['ciu_nombres'] ;
	            $this->m_session->person_doc = $conjunto[0]['ciu_doc_nro'];
	            $this->m_session->person_id = $conjunto[0]['ciu_code'];
	
	            //Actualizo la sesion abierta
	            if($this->m_session->talk_session!=0)
	            {
	                $sql = "UPDATE ciu_sesiones SET ciu_code='".$this->m_session->person_id."' WHERE cse_code='".$this->m_session->talk_session."'";
	                $primary_db->do_execute($sql);
	            }
        	}
        }

        //Caso que coinicida con mas de un ciudadano
        //Agrego los links a la seleccion de los otros ciudadanos que coinciden con el ANI ingresado
    	if(count($conjunto)>0)
    	{
	        foreach($conjunto as $key=>$elemento)
	        {
	        	$url =  WEB_PATH."/lmodules/ciudadanos/ciudadanos_maint.php?OP=V&ciu_code=".$elemento['ciu_code'];
	        	$ix = $sess->encodeURL($url);
	        	
	        	$conjunto[$key]['detalle'] = $ix;	        	
	        	$conjunto[$key]['sesion'] = $elemento['ciu_code'];
	        	$conjunto[$key]['btn_detalle'] = "Detalle";
	        	$conjunto[$key]['btn_sesion'] = "Sesion";
	        }
    	}
    	
    	//Salvo la identificacion en la sesion
        $this->m_session->saveSession("person");
        
        return json_encode($conjunto);
    }

    /** Establecer la sesion dado un codigo de ciudadano 
     * pasara en el parametro, separado por un pipe: IDCiudadano + IDSesion
     * @param $params
     * @return unknown_type
     */
    function doSetSession($params)
    {
        global $primary_db;
        $ciu_code="";
        $user_session = "";

        $partes = explode('|',$params);
        if(count($partes)==2)
        {
            $ciu_code = $partes[0];
            $user_session = $partes[1];
        }

        if($user_session=="")
        {
            error_log("setSession No se indica sesion");
            return;
        }

        if($ciu_code=="")
        {
            error_log("setSession No se indica ciudadano");           
            session_id($user_session);
            $this->m_session->person_status = 'ANONIMO';
            $this->m_session->person_doc = '';
            $this->m_session->person_nombres = '';
            $this->m_session->person_apellido = '';
            $this->m_session->person_id = 0;
            $this->m_session->saveSession("person");

            return json_encode(array());
        }

        //busco los datos del usuario
        $sql = "SELECT ciu_apellido,ciu_nombres,ciu_doc_nro FROM ciu_ciudadanos WHERE ciu_code='$ciu_code'";
        $re = $primary_db->do_execute($sql);
        $conjunto = array();
        while( $row=$primary_db->_fetch_row($re) )
        {
            $conjunto[] = $row;
        }
		$primary_db->_free_result($re);
		
        if(count($conjunto)!=0)
        {
            $this->m_session->person_status = 'IDENTIFICADO';
            $this->m_session->person_apellido = $conjunto[0]['ciu_apellido'];
            $this->m_session->person_nombres = $conjunto[0]['ciu_nombres'] ;
            $this->m_session->person_doc = $conjunto[0]['ciu_doc_nro'];
            $this->m_session->person_id = $ciu_code;

            //Actualizo la sesion abierta
            if($this->m_session->talk_session!=0)
            {
                $sql = "UPDATE ciu_sesiones SET ciu_code='".$this->m_session->person_id."' WHERE cse_code='".$this->talk_session."'";
                $primary_db->do_execute($sql);
            }
        }
        $this->m_session->saveSession("person");
        return json_encode(array());
    }
    
	/** Crea un nuevo ID que sea unico */
	private function crearID()
	{
		$id = md5(mt_rand());
		if(!isset($_SESSION['url_id']))
		{
			$_SESSION['url_id'] = array();
		}
		while( array_key_exists($id,$_SESSION['url_id'])==true )
		{
			$id = md5(mt_rand());
		}
		return $id;	
	}
	
	
	 /** Buscar turnos del ciudadano
     * pasar en el parametro, separado por pipes: IDCiudadano + IDSesion
     * @param $params
     * @return unknown_type
     */
    function doBuscarTurnos($params)
    {
        global $primary_db, $sess;
        $id="";
        $user_session = "";
		$conjunto = array();
		
		//Expando los parametros
        $partes = explode('|',$params);
        if(count($partes)==2)
        {
            $id = $partes[0];
            $user_session = $partes[1];
        }
        else
        {
        	error_log("doBuscarTurnos() ERROR Espero 2 parametros. Recibi: $params");
        	return json_encode($conjunto);
        }
        	
        //Es el usuario ANONIMO?
        if($id==0)
        {
        	return json_encode($conjunto);
        }
        
        //Busco los turnos de este usuario (se guardan con el DOCUMENTO y la NACIONALIDAD)
        $sql = "SELECT sho_nombre,sag_agenda,DATE_FORMAT(stu_tstamp,'%d/%m/%Y %k:%i:%s') as stu_tstamp,stu_status,ci.ciu_doc_nro,sho_codigo,sag_codigo,stu_turno,ci.ciu_nacionalidad 
        	FROM sig_turno_ciudadano tu 
        	JOIN ciu_ciudadanos ci ON tu.ciu_code = ci.ciu_doc_nro AND tu.ciu_nacionalidad=ci.ciu_nacionalidad
        	WHERE ci.ciu_code='$id'";
        $sql.= " ORDER BY stu_tstamp desc";

        $re = $primary_db->do_execute($sql);
        $j=0;
        while( $row=$primary_db->_fetch_row($re,$j++) )
        {
        	$url = $sess->encodeURL(WEB_PATH."/lmodules/sigehos/cancelaturno.php?OP=N&tmp_hospital={$row["sho_codigo"]}&tmp_agenda={$row["sag_codigo"]}&tmp_dia={$row["stu_tstamp"]}&tmp_doc={$row["ciu_doc_nro"]}&tmp_turno={$row["stu_turno"]}&tmp_pais={$row["ciu_nacionalidad"]}");
        	
            $conjunto[] = array( 
            	"hospital" => $row['sho_nombre'],
            	"servicio" => $row['sag_agenda'], 
            	"fecha" => $row['stu_tstamp'],
 	            "estado" => $row['stu_status'], 
            	"acciones"=>($row['stu_status']=="OTORGADO" ? "Cancelar" : ""),
            	"cancelar" => $url 
            );
        }
		$primary_db->_free_result($re);		
				
        return json_encode( $conjunto );
    }
	
	private function askSigehos($url)
    {
    	$ret = null;
    	$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
		$json = curl_exec($ch);
		curl_close($ch);
    	
		if($json!="")
		{
			$ret =json_decode($json); 
		}
		
		if( defined("DEBUG_SIGEHOS") )
		{
			error_log("HOME::askSigehos($url) JSON: $json OBJECT: ".print_r($ret,true) );
		}
		return $ret;
    }
    
    /** doNuevaOrientacion
	 * 
	 * @param $params
	 * @return unknown_type
	 */    
    function doNuevaOrientacion($params)
    {
        $user_session = $params;
        $url = "";
        
        if($user_session !="")
        {
            session_id($user_session);
            
            $sess = new CSession();
        	$host = $_SERVER["HTTP_HOST"];
        	$url = $sess->encodeURL("http://$host/lmodules/censo/orientacion_maint.php");
        }
        else
        {
            error_log("doNuevaOrientacion Error no se indica sesion a modificar");
        }

        return json_encode(array("url"=>$url));
    }
    
    function doBuscarOrientacion($params)
    {
        global $primary_db;
        $id="";
        $user_session = "";
		$conjunto = array();
		
		//Expando los parametros
        $partes = explode('|',$params);
        if(count($partes)==2)
        {
            $id = $partes[0];
            $user_session = $partes[1];
        }
        else
        {
        	error_log("doBuscarOrientacion() ERROR Espero 2 parametros. Recibi: $params");
        	return json_encode($conjunto);
        }
        	
        //Es el usuario ANONIMO? -> No tengo nada que responder
        if($id==0)
        {
        	return json_encode($conjunto);
        }
        
        //Busco las orientaciones de este usuario
        $sql = "SELECT cor_tstamp,cor_motivo,cor_nota 
        	FROM cen_orientacion 
        	WHERE ciu_code='$id' ORDER BY cor_tstamp desc";

        $re = $primary_db->do_execute($sql);
        $j=0;
        while( $row=$primary_db->_fetch_row($re,$j++) )
        {
            $conjunto[] = array( 
            	"cor_tstamp" => $row['cor_tstamp'],
            	"cor_motivo" => $row['cor_motivo'], 
            	"cor_nota" => $row['cor_nota'],
 	        );
        }
		$primary_db->_free_result($re);		
				
        return json_encode( $conjunto );
    }
	
    private function ubicacionToText($xml)
    {
    	//Segun el nombre del nodo inicial, se elige el template XSLT
    	$xmldoc = new DOMDocument();
        $xsldoc = new DOMDocument();
        $xslproc = new XSLTProcessor();
        
        if(!$xmldoc->loadXML($xml))
        {
        	error_log("home.php::ubicacionToText() error de parseo del xml para: $xml");
        }

        //Que tipo de GeoRef esta usando?
        $direcciones = $xmldoc->getElementsByTagName("direccion");
        $cant = $direcciones->length; 
        if( $cant > 0)
        {
            	$tipo = $direcciones->item(0)->firstChild->nodeName;
	            $xsl = HOME_PATH."www/includes/georef/".$tipo.".xsl";

    	        //Cargo el template
        	    $xsldoc->load($xsl);
            	$xslproc->importStyleSheet($xsldoc);

            	//Hago la transformacion
            	$mostrar = $xslproc->transformToXML($xmldoc);
        }
        else
        {
            	$mostrar = "";
        }
            
    	return $mostrar;
    }
}
?>