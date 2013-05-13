<?php

include_once "common/cdatatypes.php";
include_once "beans/call_status.php";
include_once "beans/person_status.php";
include_once "common/csession.php";
include_once "beans/ticket.php";

class CDH_HOME extends CDataHandler
{
    private $m_session;
    private $m_person;

    /** Construyo un presentation
     * 
     * @param cfield $parent
     */
    function __construct($parent)
    {
	parent::__construct($parent);
        $this->m_session = new call_status();
        $this->m_person = new person_status();
    }

    /** Borrar los datos de la persona con la que se estaba hablando
     * 
     */
    function setAnonimo()
    {
        $this->m_person->reset();
        $this->m_person->saveSession();        
    }
	
    /** Buscar un ciudadano en la base
     * Enviar en el parametro de entrada, separado por pipes, Documento + Apellido + Nombres + ANI + IDSesion
     * @param string $params
     * @return json
     */
    function doBuscar($params)
    {
        global $primary_db, $sess;
        $conjunto = array();
        $res = array();
		
        //doc + '|' + nombres + '|' + apellido + '|' + talk.talk_ani + '|' + pais
        list($doc,$nombres,$apellido,$ani,$pais) = explode('|',$params);
        
        //No hay datos para buscar...
        if(strlen($doc)<=8 && $apellido=='' && $ani=="")
        {
            $this->setAnonimo();
            return json_encode(array( "ciudadanos"=>$conjunto, "url"=>''));
        }

        //Esta declarado el doc?, lo busco por ahi
        if(strlen($doc)>8)
        {
            $sql = "SELECT ciu.ciu_code,ciu.ciu_nombres,ciu.ciu_apellido,ide.ciu_nro_doc,ciu.ciu_sexo,ciu.ciu_nacimiento,ciu.ciu_nacionalidad 
            		FROM ciu_ciudadanos ciu JOIN ciu_identificacion ide ON ciu.ciu_code=ide.ciu_code 
            		WHERE ide.ciu_nro_doc='{$doc}'";
        }
        else
        {
            if($apellido!='' && $nombres=="")
            {
                $sql = "SELECT ciu.ciu_code,ciu.ciu_nombres,ciu.ciu_apellido,ide.ciu_nro_doc,ciu.ciu_sexo,ciu.ciu_nacimiento,ciu.ciu_nacionalidad 
                		FROM ciu_ciudadanos ciu JOIN ciu_identificacion ide ON ciu.ciu_code=ide.ciu_code
	                	WHERE ciu.ciu_apellido like '$apellido%'";
            }
            else
        	{
                $sql = "SELECT ciu.ciu_code,ciu.ciu_nombres,ciu.ciu_apellido,ide.ciu_nro_doc,ciu.ciu_sexo,ciu.ciu_nacimiento,ciu.ciu_nacionalidad 
                		FROM ciu_ciudadanos ciu JOIN ciu_identificacion ide ON ciu.ciu_code=ide.ciu_code
	                	WHERE ciu.ciu_apellido like '$apellido%' and ciu.ciu_nombres like '$nombres%'";
            }
        }

        //Busco el ciudadano en la base de datos
        $re = $primary_db->do_execute($sql);
        while( $row=$primary_db->_fetch_row($re) )
        {
            $conjunto[] = array(
            	"ciu_code" 	=> 	$row['ciu_code'],
            	"ciu_nombres"	=>	$row['ciu_nombres'],
           	"ciu_apellido"	=>	$row['ciu_apellido'],
            	"ciu_doc_nro"	=> 	$row['ciu_nro_doc'],
            	"sexo"		=>	$row['ciu_sexo'],
            	"edad"		=>	$this->calcularEdad($row['ciu_nacimiento']),
            	"cops_id"	=> 	0,
            	"pais"		=> 	$row['ciu_nacionalidad']
            );
        }
        
	//Retorno conjunto vacio? o sea no hay datos en la base local
        if(count($conjunto)==0)
        {
            //No puedo encontrar  a la persona en ningun lado... pido carga manual
            $this->setAnonimo();        
        }
        elseif(count($conjunto)>1)
        {
            //Hay mas de una persona que coincide
            $this->setAnonimo();        
	}
        else //count($conjunto) == 1 Hay una sola persona que se encontró en la base local
        {
            $this->m_person->person_status = 'IDENTIFICADO';
            $this->m_person->person_apellido = $conjunto[0]['ciu_apellido'];
            $this->m_person->person_nombres = $conjunto[0]['ciu_nombres'] ;
            $this->m_person->person_doc = $conjunto[0]['ciu_doc_nro'];
            $this->m_person->person_id = $conjunto[0]['ciu_code'];
            $this->m_person->person_edad = $conjunto[0]['edad'];
            $this->m_person->person_sexo = $conjunto[0]['sexo'];
            $this->m_person->person_pais = $conjunto[0]['pais'];
                        
            //Marco el ultimo acceso
            $sql = "UPDATE ciu_ciudadanos SET ciu_ultimo_acceso=NOW() WHERE ciu_code='{$this->m_person->person_id}'";
            $primary_db->do_execute($sql,$res);
            
            //Actualizo la sesion si esta abierta
            if($this->m_session->talk_session!=0)
            {
                $sql = "UPDATE ciu_sesiones SET ciu_code='{$this->m_person->person_id}' WHERE cse_code='{$this->m_session->talk_session}'";
                $primary_db->do_execute($sql,$res);
            }            
        }
        
        //Salvo el resultado en la sesion
        $this->m_session->saveSession();
        $this->m_person->saveSession();

        //No hay datos locales... Pido que se carguen los datos a mano.
        if(count($conjunto)==0)
            $url = $sess->encodeURL(WEB_PATH."/lmodules/ciudadanos/ciudadanos_maint_n.php?OP=N&tmp_doc={$doc}&ciu_tel_fijo={$ani}&ciu_tel_movil={$ani}&ciu_nacionalidad={$pais}");
        else
            $url = '';
        
        $resp = array("ciudadanos"=>$conjunto, "url"=>$url);
        error_log("HOME::doBuscar($params) RESPONDE: ".print_r($resp,true));
        return json_encode($resp);
    }

    /** Calcula la edad dada la fecha de nacimiento
     * 
     * @param strDate $nacimiento
     * @return int
     */
    private function calcularEdad($nacimiento) {
    	try {
            //Nacimiento 22/09/1968
            list($a,$m,$d) = explode("-",$nacimiento);
            
            //Dato actual
            $anio = intval(date("Y"));
            $mes = intval(date("n"));
            $dia = intval(date("j"));
            
            //Años
            $edad = $anio - intval($a);
            
            //Tengo que restar 1 año porque todavia no cumplió?
            if( $mes - intval($m)<0 )
                $edad--;
            
            //Mes del cumple, llegó el día?
            if( $mes===intval($m) && ($dia-intval($d))<0 )
                $edad--;
            
            return $edad;
    	}
    	catch(Exception $e)
    	{
            error_log("CDH_HOME::calcularEdad($nacimiento) ".$e->getMessage());
    	}
    	return 0;
    }
    
    /** Convertir M o F a MASCULINO Y FEMENINO
     * 
     * @param string $sexo
     * @return string
     */
    private function convertToSexo($sexo) {
    	if($sexo=="M")
    		return "MASCULINO";
    	if($sexo=="F")
    		return "FEMENINO";
    		
    	return "SIN ESPECIFICAR";	
    }
    
    /** Anular los datos del ciudadano actual, para hacer la sesion anonima
     *  Enviar en el parametro el IDSesion
     * @return json
     */
    function doAnonimo()
    {
        global $sess;
                
        $this->setAnonimo();            
        $url = $sess->encodeURL(WEB_PATH."/lmodules/ciudadanos/sesion_cierre.php?OP=M");
        
        return json_encode(array("url"=>$url));
    }

    /** Crear un Nuevo Ticket
     * 
     * @param string $params
     * @return json
     */    
    function doNuevoTicket($params)
    {
        global $sess;
        $url = $sess->encodeURL(WEB_PATH."/lmodules/tickets/tickets_maint_n.php?OP=N");
        return json_encode(array("url"=>$url));
    }
    
    
    /** 
     * Modificar datos del ciudadano logeado
     * 
     * @param string $params
     * @return json
     */
    
    function doModificar($params)
    {
    	global $sess;
        $doc = $this->m_person->person_id;            
        $url = $sess->encodeURL(WEB_PATH."/lmodules/ciudadanos/ciudadanos_maint.php?OP=M&ciu_code={$doc}");
        return json_encode(array("url"=>$url));
    }
    
    
    /** Buscar tickets en la base.
     *  Busca en la base local los tickets de DENUNCIAS, SOLICITUDES y QUEJAS y en la base
     *  remota del SUR los reclamos.
     *  Mandar en el parametro, separado por pipes, el NUMERO +  AÑO del ticket buscado.
     * 
     * @param string $params
     * @return json
     */
    function doBuscarTickets($params)
    {
        global $primary_db,$sess;
        $nro="";
        $anio="";

        // RECLAMO|31|2013
        $partes = explode('|',$params);
        if(count($partes)==3)
        {
            $tipo = $partes[0];
            $nro = $partes[1];
            $anio = $partes[2];
        
            //No hay datos para buscar... 
            if( $nro=="" || $anio=="")
            {
            	return json_encode(array());
            }
        }

        $ciu_code = $this->m_person->person_id;
        
        //No hay datos para buscar... (ciu_code=0 es ciudadano ANONIMO)
       	if( $ciu_code=="" || $ciu_code==0)
        {
            //Hay un fulano logeado?
            return json_encode(array());
        }

        //Busco por codigo en los reclamos
        $conjunto = array();
        if($nro!=="" && $anio!=="")
        {        	            
            //Busco el ticket pedido
            $identificador = "{$tipo} {$nro}/{$anio}";
            $sql = "SELECT * FROM v_ticket_ciu WHERE tic_identificador='{$identificador}'";
            $re = $primary_db->do_execute($sql);
            while( $row1=$primary_db->_fetch_row($re) )
            {
                //Decodifico la direccion 
                $json = $primary_db->DesFiltrado( $row1["tic_lugar"] );                
                $conjunto[] = array(
                            'tipo'		=> $row1['tic_tipo'],
                            'anio'		=> $row1['tic_anio'],
                            'numero'		=> $row1['tic_numero'],
                            'prestacion'	=> $row1['tpr_detalle'],
                            'ubicacion'		=> $row1['tic_lugar'],
                            'estado'		=> $row1['tic_estado'],
                            'ciudadano'		=> $row1['ciu_nombres'].' '.$row1['ciu_apellido'],
                            'ciu_code'		=> $row1['ciu_code'],
                            'ubicacion'         => json_decode($json),
                            'tic_nro'           => $row1['tic_nro'],
                            'nota'              => $row1['tic_nota_in']
                );
            }
        }
        else
        {
            //Busco por pertenecientes a un ciudadano
            if($ciu_code!='')
            {
                $sql = "SELECT * FROM v_ticket_ciu WHERE ciu_code='{$ciu_code}' order by tic_tstamp_in desc";
            	$re = $primary_db->do_execute($sql);
                while( $row=$primary_db->_fetch_row($re) )
                {
                    //Decodifico la direccion 
                    $json = $primary_db->DesFiltrado( $row["tic_lugar"] );
                    $conjunto[] = array(
                            'tipo'		=> $row['tic_tipo'],
                            'anio'		=> $row['tic_anio'],
                            'numero'		=> $row['tic_numero'],
                            'prestacion'	=> $row['tpr_detalle'],
                            'ubicacion'		=> $row['tic_lugar'],
                            'estado'		=> $row['tic_estado'],
                            'ciudadano'		=> $row['ciu_nombres'].' '.$row['ciu_apellido'],
                            'ciu_code'		=> $row['ciu_code'],
                            'ubicacion'         => json_decode($json),
                            'tic_nro'           => $row['tic_nro'],
                            'nota'              => $row['tic_nota_in']
                    );
                }
            }
        }
 
        //Agrego los botones...
        foreach($conjunto as $key=>$elemento)
        {
            $url1 = $sess->encodeURL(WEB_PATH."/lmodules/tickets/ticket_maint.php?OP=V&tic_anio={$elemento['anio']}&tic_nro={$elemento['numero']}&tic_tipo={$elemento['tipo']}&next=/index.php");
            $conjunto[$key]['url_ver'] = $url1;
            
            //Solo los reclamos se pueden reiterar    
            if($elemento['tipo']=="RECLAMO")
            {
                $url2 = "javascript:reiterar({$elemento['tic_nro']})";
                $conjunto[$key]['url_reiterar'] = $url2;
            }
        }
        return json_encode($conjunto);
    }

    /** Iniciar una sesion.
     * NO SE ALTERA EL ESTADO DE IDENTIFICACION DE LA PERSONA. SOLO SE CAMBIA EL ESTADO DE LA CONEXION.
     * Enviar en el parametro, separado por pipes:
     * ANI + CallReferenceID + entryPoint + skill
     * @param string $params
     * @return json
     */
    function doIniciar($params)
    {
        global $primary_db,$sess;
        $ret_json = "";
        	
        //Desarmo el parametro de entrada
        $partes = explode('|',$params);
        if(count($partes)==4)
        {
            $ani = $partes[0];
            $call_id = $partes[1];
            $entry_point  = $partes[2];
            $skill  = $partes[3];
        }
        else
        {
            error_log("doIniciar requiere 4 paramatros. Recibido: $params");
            return json_encode("Error: cantidad incorrecta de parametros");
        }
        
        //Cargo la sesion
        $this->m_session->loadSession();

        //Si hay una sesion abierta, para OTRO ani, la cierro y salgo
        if($this->m_session->talk_session!=0 && $this->m_session->talk_ani!=$ani )
        {
            $this->doTerminar();
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
        $cse_code = $primary_db->Sequence('CIU_SESIONES');
		
        //Cierro cualquier sesion abandonada por este operador
        $sql1 = "UPDATE ciu_sesiones SET cse_estado='ABANDONADA',cse_duracion=TIMESTAMPDIFF(SECOND,cse_tstamp,NOW())  WHERE cse_estado='ABIERTA' AND use_code='{$use_code}'";
        $primary_db->do_execute($sql1);
        
        //Registro el inicio de la sesion
        $sql2 = "INSERT INTO ciu_sesiones(cse_code ,ciu_code ,cse_ani,cse_tstamp,cse_duracion,use_code   ,cse_nota,cse_call_id,cse_skill     ,cse_estado) 
                                   VALUES($cse_code,$ciu_code,'$ani' ,NOW()     ,0           ,'$use_code',''      ,'$call_id' ,'$entry_point','ABIERTA' )";
        $primary_db->do_execute($sql2);
        
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
     * pasar en el parametro, separado por pipes:  FechaInicio + FechaFin 
     * @param $params
     * @return json
     */
    function doBuscarContactos($params)
    {
        global $primary_db;
        $conjunto = array();
        $id = $this->m_person->person_id;
	
        //Expando los parametros
        $partes = explode('|',$params);
        if(count($partes)==2)
        {
            $desde = $partes[0];
            $hasta = $partes[1];
        }
        else
        {
            error_log("CDH_HOME::doBuscarContactos() Consulta sin parametros. Recibi: $params");
            $desde="";
            $hasta="";
        }

        //Es el usuario ANONIMO?
        if($id==0)
            return json_encode($conjunto);
                
        //Busco los contactos de este usuario
        $sql = "SELECT cse_code, chi_fecha, chi_motivo, use_code, chi_canal, chi_nota 
            FROM ciu_historial_contactos  
            WHERE ciu_code='{$id}'";
        if($desde!="" && $hasta!="")
        {
            $sql.= " AND chi_fecha between '{$desde}' and '{$hasta}'";
        }
        $sql.= " ORDER BY chi_fecha desc";

        $re = $primary_db->do_execute($sql);
       
        while( $row=$primary_db->_fetch_row($re) )
        {        	
            $conjunto[] = array( 
                "fecha"         =>  $row['chi_fecha'],
                "cse_code"      =>  ($row['cse_code']===null ? '' : $row['cse_code']),
                "use_code"      =>  $row['use_code'],
                "canal"         =>  $row['chi_canal'],
                "nota"          =>  $row['chi_nota'],
                "motivo"        =>  $row['chi_motivo']
            );
        }
        	
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
	
	
    
    /** Reitera un ticket
     * 
     * @param type $tic_nro
     */ 
    function reiterarTicket($params) {
        list($tic_nro, $nota) = explode('|',$params);
        
        $t = new ticket();
        $t->setNro($tic_nro);
        $t->load();
        $t->reiterar($nota,$this->m_person->person_doc, 'call');
        
        return '';
    }
}