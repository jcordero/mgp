<?php
/** PROCESO DE ALTA DE UN NUEVO TICKET 
 * 
 * @author jcordero
 *
 */
include_once 'beans/person_status.php';

class class_tic_ticket_hooks extends cclass_maint_hooks
{
    private $m_prestacion_detalle;
    private $m_form;
    private $m_tipo;
    private $m_numero;
    private $m_anio;
    private $m_org_responsable;
    private $m_org_prestador;
	private $m_ps;
	
    public function afterLoadForm() {
   		$this->m_ps = new person_status();
   		if( $this->m_ps->person_status=='ANONIMO' ) {
   			return array('MENSAJE:ERROR: No se pueden emitir tickets anonimos');
   		} 	
   		return array();
    }
    
   
    //
    // Se ejecuta antes de salvar el objeto a la base de datos
    // Hay que completar el nro y el año del ticket
    // Si es un reclamo, salvar al SUR viejo, caso contrario en base local
    //
    // Retorna una lista de errores o un array vacio si todo esta OK
    public function beforeSaveDB()
	{
		global $primary_db,$reclamos_db;
		$obj = $this->m_data;
        $this->m_can_save = false;
		$res = array();
		$this->m_org_prestador = 0;
		$this->m_org_responsable = 0;
		
		//Ya esta procesado este ticket?
        $cant = 0;
		$this->m_form = $obj->getField("forms")->getValue();
		$sql = "select count(*) as cant from tic_ticket where tic_forms= '$this->m_form'";
        $re = $primary_db->do_execute($sql);
        if( $row=$primary_db->_fetch_array($re,0) )
        {
            $cant = $row[0];
        }
        else
        {
            $res[] = "MENSAJE: ERROR al aceder a la base de datos";
            return $res;
        }

        //Ya fue salvado?
        if($cant>0)
        {
            $res[] = "MENSAJE: ERROR este ticket ya fue salvado anteriormente.";
            return $res;
        }

        //Recupero los campos del form
        $nota 	= $primary_db->Filtrado($obj->getField("tic_nota_in")->getValue());
        
        //GeoRef 
        $tipo_georef = $primary_db->Filtrado($obj->getField("tipo_georef")->getValue());
        
        //DIRECCION
        $barrio = $primary_db->Filtrado($obj->getField("tic_barrio")->getValue());
        $cgpc 	= $primary_db->Filtrado($obj->getField("tic_cgpc")->getValue());
        $coordx = $primary_db->Filtrado($obj->getField("tic_coordx")->getValue());
        $coordy = $primary_db->Filtrado($obj->getField("tic_coordy")->getValue());
        $callenro = $primary_db->Filtrado($obj->getField("callenro")->getValue());
        $calle_nombre = $primary_db->Filtrado($obj->getField("calle_nombre")->getValue());
		$nombre_fantasia = $primary_db->Filtrado($obj->getField("nombre_fantasia")->getValue());
        
        //Caso VILLA
        $villa = $primary_db->Filtrado($obj->getField("villa")->getValue());
        $vilmanzana = $primary_db->Filtrado($obj->getField("vilmanzana")->getValue());
        $vilcasa = $primary_db->Filtrado($obj->getField("vilcasa")->getValue());
        
        //Caso PLAZA
        $plaza = $primary_db->Filtrado($obj->getField("plaza")->getValue());
        
        //Caso CEMENTERIO
        $cementerio = $primary_db->Filtrado($obj->getField("cementerio")->getValue());
        $sepultura = $primary_db->Filtrado($obj->getField("sepultura")->getValue());
        $sepsector = $primary_db->Filtrado($obj->getField("sepsector")->getValue());
        $sepcalle = $primary_db->Filtrado($obj->getField("sepcalle")->getValue());
        $sepnumero = $primary_db->Filtrado($obj->getField("sepnumero")->getValue());
        $sepfila = $primary_db->Filtrado($obj->getField("sepfila")->getValue());
        

        //Tipo de prestacion y descripción
        $prestacion = $primary_db->Filtrado($obj->getField("prestacion")->getValue());
        $row = $primary_db->QueryArray("select tpr_tipo,tpr_detalle,tpr_plazo from tic_prestaciones where tpr_code='{$prestacion}'");
        if( $row )
        {
            $this->m_tipo = $row['tpr_tipo'];
            $this->m_prestacion_detalle = $row['tpr_detalle'];
            $plazo = $row['tpr_plazo'];
        }
        
        
        //Amplio la nota.
        if($tipo_georef=="VILLA")
        {
        	$nota = trim($nota)." En villa: $villa manzana: $vilmanzana casa: $vilcasa";
        }
        elseif($tipo_georef=="PLAZA")
        {
        	$nota = trim($nota)." En plaza: $plaza";
        }
        elseif($tipo_georef=="CEMENTERIO")
        {
        	$nota = trim($nota)." En cementerio: $cementerio sep: $sepultura sect: $sepsector calle: $sepcalle número: $sepnumero fila: $sepfila";
        }
        elseif($tipo_georef=="DOMICILIO" && $nombre_fantasia!="" && $this->m_tipo=="RECLAMO")
        {
        	$nota = trim($nota)." Nombre fantasía: $nombre_fantasia";
        }
        
        
        //Valido la altura de la calle
        $callenro = ($callenro=="" ? 1 : $callenro);
        
        //La altura de la calle no puede ser blanco, si no esta definido debe ser 0
        $id_cuadra = $primary_db->Filtrado($obj->getField("tic_id_cuadra")->getValue());
        $id_cuadra = ($id_cuadra=="" ? 0 : $id_cuadra);
        
        //Las coordeanadas no pueden estar en blanco
        $coordx = ($coordx=="" ? 0 : $coordx);
        $coordy = ($coordy=="" ? 0 : $coordy);
        

        //Si es una denuncia entonces el rubro esta definido,
        //busco la prioridad ahi. Caso contrario se inician todos los tickets
        //con la misma prioridad.
        //Si esta declarada la georeferencia ahi, entonces le doy precedencia sobre la declarada en la prestación
        $prioridad="";
        $organismos = array();
        if($this->m_tipo=="DENUNCIA")
        {
            $rubro = $primary_db->Filtrado($obj->getField("rubro")->getValue());
            $sql = "select tpr_prioridad,tor_code,tto_figura from tic_prestaciones_rubros where tpr_code='$prestacion' and tru_code='$rubro'";
            $re = $primary_db->do_execute($sql);
            if( $row=$primary_db->_fetch_array($re,0) )
            {
                $prioridad = $row['tpr_prioridad'];
                $tor_code = $row['tor_code'];
                $tto_figura= $row['tto_figura'];
            } 
            
            //Esta declarada la prioridad?
            if($prioridad=="")
            {
                $prioridad = "1.1";
            }
            
            //Hay un destinatario indicado?
            //Si lo hay la determinacion de los responsables/prestadores se hace con la información del rubro
            //Si no hay, entonces se hace usando el GIS
            if($tor_code!="" && $tto_figura!="")
            {
            	$organismos[] = array('tor_code'=>$tor_code, 'tto_figura'=>$tto_figura);
            }
        }
        else
        {
            //Queja, Reclamo, Solicitud
            $rubro = 0;
            $prioridad = "1.1";
        }

        //Creo la descripcion del lugar
        $lugar = $this->generaJSONLugar($obj);
        
        //Usuario que esta creando el ticket
        $use_code = $primary_db->Filtrado($obj->getField("use_code")->getValue());
        
        //Canal de ingreso del ticket
        $canal = $this->determinarCanal();
        
        //Proceso georeferencias y destinatarios, salvo que sea una denuncia y el destinatario sea indicado por el rubro
        $organismos = array_merge($organismos, $this->procesarGeoRef($prestacion,$coordx,$coordy));
        
        //Ticket asociado a un Reclamante o es Anonimo
        $ciu_code = $primary_db->Filtrado( $this->m_ps->person_id );
        
		//Determino el código de reclamo
        $this->m_numero = $this->generaCodigoTicket($this->m_tipo);
        $this->m_anio = date("Y"); //Año actual
        
        //Comando SQL para calcular el plazo
        $plazo_sql = "NOW() + INTERVAL ".$this->PlazoADias($plazo)." DAY";
        
        //Creo ticket
        $identificador = $this->m_tipo.' '.$this->m_numero.'/'.$this->m_anio;
        $nro = $primary_db->Sequence('tic_tickets');
        $sql = "INSERT INTO tic_ticket(tic_nro  , tic_numero , tic_anio , tic_tipo   , tic_tstamp_in, use_code   , tic_nota_in   , tic_estado, tic_lugar   , tic_barrio   , tic_cgpc   , tic_coordx , tic_coordy , tic_id_cuadra , tic_forms , tic_canal   , tic_tstamp_plazo, tic_tstamp_cierre, tic_calle_nombre   , tic_nro_puerta, tic_nro_asociado, tic_identificador   )";
        $sql.= "               VALUES (:TIC_NRO:,:TIC_NUMERO:,:TIC_ANIO:,':TIC_TIPO:',NOW()         ,':USE_CODE:',':TIC_NOTA_IN:','ABIERTO'  ,':TIC_LUGAR:',':TIC_BARRIO:',':TIC_CGPC:',:TIC_COORDX:,:TIC_COORDY:,:TIC_ID_CUADRA:,:TIC_FORMS:,':TIC_CANAL:',:TIC_TSTAMP_PLAZO:,NULL             ,':TIC_CALLE_NOMBRE:',:TIC_NRO_PUERTA:,NULL            ,':TIC_IDENTIFICADOR:')";
        $values = array(
                "TIC_NRO"       	=>  $nro,
                "TIC_NUMERO"       	=>  $this->m_numero,
        		"TIC_ANIO"      	=>  $this->m_anio,
                "TIC_TIPO"      	=>  $this->m_tipo,
                "USE_CODE"      	=>  $use_code,
                "TIC_NOTA_IN"   	=>  $nota,
                "TIC_LUGAR"     	=>  $lugar,
                "TIC_BARRIO"    	=>  $barrio,
                "TIC_CGPC"      	=>  $cgpc,
                "TIC_COORDX"    	=>  $coordx,
                "TIC_COORDY"    	=>  $coordy,
                "TIC_ID_CUADRA" 	=>  $id_cuadra,
                "TIC_FORMS"     	=>  $this->m_form,
                "TIC_CANAL"     	=>  $canal,
                "TIC_CALLE_NOMBRE"	=>  $calle_nombre,
                "TIC_NRO_PUERTA"	=>  $callenro,
        		"TIC_TSTAMP_PLAZO"	=>	$plazo_sql,
        		"TIC_IDENTIFICADOR" => 	$identificador
        );
        $primary_db->do_execute($sql,$res,$values);

        //XML del cuestionario
        $cuestionario = $obj->getField("cuestionario")->getValue();
        
        //Inserto la prestacion inicial
        $sql = "INSERT INTO tic_ticket_prestaciones(tic_nro  ,tpr_code    , tru_code   , ttp_cuestionario   , ttp_estado, ttp_prioridad   , ttp_tstamp_plazo, ttp_alerta) ";
        $sql.=                              "VALUES(:TIC_NRO:,':TPR_CODE:',':TRU_CODE:',':TTP_CUESTIONARIO:','INICIADO' ,':TTP_PRIORIDAD:',NULL             , NULL      )";
        $values = array(
                "TIC_NRO"           =>   $nro,
                "TPR_CODE"          =>   $prestacion,
                "TRU_CODE"          =>   $rubro,
                "TTP_CUESTIONARIO"  =>   $cuestionario,
                "TTP_PRIORIDAD"     =>   $prioridad);
        $primary_db->do_execute($sql,$res,$values);

        //Creo paso inicial de la prestacion
        $sql = "INSERT INTO tic_avance(tic_nro  , tpr_code   , tav_code ,tav_tstamp_in, use_code_in   , tic_estado_in,tav_nota    , tic_motivo,tic_estado_out,tav_tstamp_out,use_code_out)";
        $sql.= "				VALUES(:TIC_NRO:,':TPR_CODE:',:TAV_CODE:,NOW()        ,':USE_CODE_IN:','INICIADO'    ,':TAV_NOTA:','INICIADO' ,NULL          ,NULL          ,NULL        )";
        $values = array(
                "TIC_NRO"   	=>   $nro,
                "TPR_CODE"  	=>   $prestacion,
        		"TAV_CODE"		=> 	 $primary_db->Sequence('tic_avances'),
                "USE_CODE_IN"  	=>   $use_code,
                "TAV_NOTA"  	=>   $nota);
        $primary_db->do_execute($sql,$res,$values);

        //Creo la relacion Organismo->Ticket para el RESPONSABLE, PRESTADOR y OBSERVADOR
        foreach($organismos as $organismo)
        {
                $sql = "INSERT INTO tic_ticket_organismos(tic_nro  , tpr_code   ,tor_code  , tto_figura   )";
                $sql.= "						   VALUES(:TIC_NRO:,':TPR_CODE:',:TOR_CODE:,':TTO_FIGURA:')";
                $values = array(
                    "TIC_NRO"       =>   $nro,
                    "TOR_CODE"      =>   $organismo['tor_code'],
                    "TTO_FIGURA"    =>   $organismo['tto_figura'],
	                "TPR_CODE"    	=>   $prestacion
                );
                $primary_db->do_execute($sql,$res,$values);
        }

        //La sesion NO ES anonima? Entonces salvo los datos del ciudadano
        if( $this->m_ps->person_status=="IDENTIFICADO" )
        {
                //Creo relacion Ciudadano-Ticket (salvo que sea anonimo)
                $sql = "INSERT INTO tic_ticket_ciudadano(tic_nro  , ciu_code, ttc_tstamp, ttc_nota   ) ";
                $sql.="							  VALUES(:TIC_NRO:,:CIU_CODE:,NOW()     ,':TTC_NOTA:')";

                $values = array(
                "TIC_NRO"   =>   $nro,
                "CIU_CODE"  =>   $ciu_code,
                "TTC_NOTA"  =>   $nota);
                $primary_db->do_execute($sql,$res,$values);
        }
        
        return $res;
	}

    //Retorna FALSE x que ya salve el reclamo a mano
    public function canSaveDB()
	{
        return false;
    }

    //Genera informacion para el operador despues de grabar
    //Asi le puede informar al ciudadano del resultado del registro de su
    //ticket.
    //Si se produjo un error en beforeSaveDB esta funcion NO SE EJECUTA
    public function afterSaveDB()
	{
		global $primary_db;
		$res = array();
		$obj = $this->m_data;

        $prestacion = $obj->getField("prestacion")->getValue();
        $descripcion = $this->m_prestacion_detalle; 
        $tipo = $this->m_tipo;
        $numero = $this->m_numero;
        $anio = $this->m_anio;
        
        //Salvo en el documento el nro de ticket
		$obj->getField("tic_nro")->setValue($numero);
		$obj->getField("tic_anio")->setValue($anio);
        $obj->getField("tic_tipo")->setValue($tipo);
        
		//Genero contenido para el mensaje de respuesta.
        $content['nroticket'] = "$tipo $numero/$anio";
        $content['prestacion'] = "$prestacion - $descripcion";
        $content['tranid'] = $this->m_form;

		return array($content,$res);
	}


/*
 * 
 *                  FUNCIONES PRIVADAS    ===================================  
 *                  
 *                  
 *                  
 * */

    //Genera un nuevo codigo de ticket.
    //Inicia una nueva secuencia cada año
    private function generaCodigoTicket($tipo)
    {
        global $primary_db;
        $anio = date("Y"); //Año actual
        $codigo = $primary_db->Sequence("$tipo-$anio");
        return $codigo;
    }

    //Genera un JSON con la direccion
    private function generaJSONLugar($obj)
    {
    	global $primary_db;
    	$tipo_georef = $primary_db->Filtrado($obj->getField("tipo_georef")->getValue());
		$geo = null;
		    
    	if($tipo_georef=="DOMICILIO")
    	{
    		$geo = array(
    			'tipo'				=> $tipo_georef,
	    		'calle_nombre' 		=> $primary_db->Filtrado($obj->getField("calle_nombre")->getValue()),
	    		'calle' 			=> $primary_db->Filtrado($obj->getField("calle")->getValue()),
	    		'callenro' 			=> $primary_db->Filtrado($obj->getField("callenro")->getValue()),
	    		'piso' 				=> $primary_db->Filtrado($obj->getField("piso")->getValue()),
	    		'dpto' 				=> $primary_db->Filtrado($obj->getField("dpto")->getValue()),
	    		'nombre_fantasia' 	=> $primary_db->Filtrado($obj->getField("nombre_fantasia")->getValue()),
	    		'barrio' 			=> $primary_db->Filtrado($obj->getField("tic_barrio")->getValue()),
	    		'comuna' 			=> $primary_db->Filtrado($obj->getField("tic_cgpc")->getValue()),
    			'lat'				=> $primary_db->Filtrado($obj->getField("tic_coordx")->getValue()),
    			'lng'				=> $primary_db->Filtrado($obj->getField("tic_coordy")->getValue()),
    		);
    	}
    
    	if($tipo_georef=="VILLA")
    	{
    		$geo = array(
    			'tipo'		=> $tipo_georef,
	    		'villa' 	=> $primary_db->Filtrado($obj->getField("villa")->readAltValue()),
	    		'manzana' 	=> $primary_db->Filtrado($obj->getField("vilmanzana")->getValue()),
	    		'casa' 		=> $primary_db->Filtrado($obj->getField("vilcasa")->getValue()),
    			'lat'		=> $primary_db->Filtrado($obj->getField("tic_coordx")->getValue()),
    			'lng'		=> $primary_db->Filtrado($obj->getField("tic_coordy")->getValue()),
    		);
    	}
    
    	if($tipo_georef=="PLAZA")
    	{
    		$geo = array(
    			'tipo'	=> $tipo_georef,
    			'plaza' => $primary_db->Filtrado($obj->getField("plaza")->getValue())
    		);
    	}
    
    	if($tipo_georef=="CEMENTERIO")
    	{
    		$geo = array(
    			'tipo'			=> $tipo_georef,
	    		'cementerio' 	=> $primary_db->Filtrado($obj->getField("cementerio")->getValue()),
	    		'sepultura' 	=> $primary_db->Filtrado($obj->getField("sepultura")->getValue()),
	    		'sector' 		=> $primary_db->Filtrado($obj->getField("sepsector")->getValue()),
	    		'calle' 		=> $primary_db->Filtrado($obj->getField("sepcalle")->getValue()),
	    		'numero' 		=> $primary_db->Filtrado($obj->getField("sepnumero")->getValue()),
	    		'fila' 			=> $primary_db->Filtrado($obj->getField("sepfila")->getValue()),
    			'lat'			=> $primary_db->Filtrado($obj->getField("tic_coordx")->getValue()),
    			'lng'			=> $primary_db->Filtrado($obj->getField("tic_coordy")->getValue()),
    		);
    	}
    
    	if($tipo_georef=="ORGAN.PUBLICO")
    	{
    		$geo = array(
   				'tipo'		=> $tipo_georef,
	    		'organismo'	=> $primary_db->Filtrado($obj->getField("orgpublico")->getValue()),
	    		'sector' 	=> $primary_db->Filtrado($obj->getField("orgsector")->getValue()),
    			'lat'		=> $primary_db->Filtrado($obj->getField("tic_coordx")->getValue()),
    			'lng'		=> $primary_db->Filtrado($obj->getField("tic_coordy")->getValue()),
    		);	
       	}
       	
    	$ret = json_encode($geo);
       	error_log("generaJSONLugar() $ret");
    	return $ret;
    }
    
    
    
    
    //Determina el canal de ingreso, mirando en los atributos del usuario
    private function determinarCanal()
    {
        $canal = "CALL";

        //Reviso los grupos del usurio logeado busco uno que diga canal_
        if( isset($_SESSION['groups']) )
        {
            $partes = explode(",",$_SESSION['groups']);
            foreach($partes as $grupo)
            {
            	$grp = strtoupper(trim($grupo));
                if( substr($grp,0,6)=="CANAL_" )
                {
                    $canal = substr($grupo,7);
                    break;
                }
            }
        }
        
        return $canal;
    }

    
    //Averiguo los organismos que deben ver o procesar este ticket
    private function procesarGeoRef($prestacion,$coordx,$coordy)
    {
        global $primary_db;
        $organismos = array();
        
        //$organismo['tor_code'] $organismo['tto_figura']
        $sql = "select tpg_usa_gis,tpg_gis_campo,tpg_gis_valor,tor_code,tto_figura from tic_prestaciones_gis where tpr_code='$prestacion'";
        $re = $primary_db->do_execute($sql);
        $j=0;
        while( $row=$primary_db->_fetch_array($re,$j++) )
        {
            if( $row['tpg_usa_gis']=="NO" )
            {
                //No hace falta ir a la USIG, asigno organismo directamente
                $organismo = array( "tor_code"      =>  $row['tor_code'],
                                    "tto_figura"    =>  $row['tto_figura']);
                $organismos[] = $organismo;

                //Es el responsable?
            	if($row['tto_figura']=="RESPONSABLE")
            	{
            		$this->m_org_responsable = $row['tor_code'];
            	}
            	
            	//Es el prestador?
            	if($row['tto_figura']=="PRESTADOR")
            	{
            		$this->m_org_prestador = $row['tor_code'];
            	}
            }
            else
            {
                //Consulto la grilla en la usig
                $valor = $this->consultarUSIG($row['tpg_gis_campo'],$coordx,$coordy);
                if( strcasecmp($valor,$row['tpg_gis_valor'])==0 )
                {
                    $organismo = array( "tor_code"      =>  $row['tor_code'],
                                        "tto_figura"    =>  $row['tto_figura']);
                    $organismos[] = $organismo;
                    
                    //Es el responsable?
            		if($row['tto_figura']=="RESPONSABLE")
            		{
            			$this->m_org_responsable = $row['tor_code'];
            		}
            		
            		//Es el prestador?
            		if($row['tto_figura']=="PRESTADOR")
            		{
            			$this->m_org_prestador = $row['tor_code'];
            		}
                }
            }
        }
        
        return $organismos;
    }

    //Consultar en la USIG por la georeferenciacion de un punto
    private function consultarUSIG($grilla,$coordx,$coordy)
    {
    	$resp = null;
    	if($grilla=="" || $coordx=="" || $coordy=="")
    	{
    		return $resp; //Fallo en los parametros de entrada
    	}
    	
    	//Obtengo el nombre del server usado
    	$host = $_SERVER["HTTP_HOST"];
    	$ch = curl_init("http://$host/direcciones/proxyjson.php?method=consultarDelimitaciones&p1=$coordx&p2=$coordy&p3=".rawurlencode($grilla));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_BINARYTRANSFER, true);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
		curl_setopt($ch, CURLOPT_TIMEOUT,20);
    	$output = curl_exec($ch);
		if($output=="")
		{
			return "";
		}    	
        $ans = json_decode($output);
        return $ans[0]->Resultado;
    }
    
    
    /** Plazo es un string "Cantidad Unidad"
     * Se lo convierte a una cantidad de dias
     * @param $plazo
     * @return int
     */
    private function PlazoADias($plazo)
    {
    	list($cant,$unidad) = explode(" ",$plazo);
    	$unidad = strtolower(trim($unidad));
    	if($unidad=="minutos")
    	{
    		$res = intval($cant/(60*24))+1;
    	}
    	elseif($unidad=="horas")
    	{
    		$res = intval($cant/24)+1;
    	}
    	elseif($unidad=="meses")
    	{
    		$res = intval($cant*30);	
    	}
    	else
    	{
    		$res = intval($cant); //dias
    	}
  		return $res;  	
    }
}
?>