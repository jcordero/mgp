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

    public function afterLoadForm() {
   		$ps = new person_status();
   		if( $ps->person_status=='ANONIMO' ) {
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
        $nota 	= $this->nosql($obj->getField("tic_nota_in")->getValue());
        
        //GeoRef 
        $tipo_georef = $this->nosql($obj->getField("tipo_georef")->getValue());
        
        //DIRECCION
        $barrio = $this->nosql($obj->getField("tic_barrio")->getValue());
        $cgpc 	= $this->nosql($obj->getField("tic_cgpc")->getValue());
        $coordx = $this->nosql($obj->getField("tic_coordx")->getValue());
        $coordy = $this->nosql($obj->getField("tic_coordy")->getValue());
        $callenro = $this->nosql($obj->getField("callenro")->getValue());
        $calle_nombre = $this->nosql($obj->getField("calle_nombre")->getValue());
		$nombre_fantasia = $this->nosql($obj->getField("nombre_fantasia")->getValue());
        
        //Caso VILLA
        $villa = $this->nosql($obj->getField("villa")->getValue());
        $vilmanzana = $this->nosql($obj->getField("vilmanzana")->getValue());
        $vilcasa = $this->nosql($obj->getField("vilcasa")->getValue());
        
        //Caso PLAZA
        $plaza = $this->nosql($obj->getField("plaza")->getValue());
        
        //Caso CEMENTERIO
        $cementerio = $this->nosql($obj->getField("cementerio")->getValue());
        $sepultura = $this->nosql($obj->getField("sepultura")->getValue());
        $sepsector = $this->nosql($obj->getField("sepsector")->getValue());
        $sepcalle = $this->nosql($obj->getField("sepcalle")->getValue());
        $sepnumero = $this->nosql($obj->getField("sepnumero")->getValue());
        $sepfila = $this->nosql($obj->getField("sepfila")->getValue());
        

        //Tipo de prestacion y descripción
        $prestacion = $this->nosql($obj->getField("prestacion")->getValue());
        $sql = "select tpr_tipo,tpr_detalle,tpr_plazo from tic_prestaciones where tpr_code='$prestacion'";
        $re = $primary_db->do_execute($sql);
        if( $row=$primary_db->_fetch_array($re,0) )
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
        $id_cuadra = $this->nosql($obj->getField("tic_id_cuadra")->getValue());
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
            $rubro = $this->nosql($obj->getField("rubro")->getValue());
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
        $lugar = $this->generaXMLLugar($obj);
        
        //Usuario que esta creando el ticket
        $use_code = $this->nosql($obj->getField("use_code")->getValue());
        
        //Canal de ingreso del ticket
        $canal = $this->determinarCanal();
        
        //Proceso georeferencias y destinatarios, salvo que sea una denuncia y el destinatario sea indicado por el rubro
        //if(count($organismos)==0)
        //{
        	$organismos = array_merge($organismos, $this->procesarGeoRef($prestacion,$coordx,$coordy));
        //}
        
        //Ticket asociado a un Reclamante o es Anonimo
        $ciu_code = $this->nosql($_SESSION['person_id']);
        
        //Proceso Reclamos: mando al SUR viejo
        if($this->m_tipo=='RECLAMO' && defined("SUR_ACTIVO"))
        {
        	$calleNom = $this->nosql($obj->getField("calle_nombre")->getValue());
        	$calleNro = $this->nosql($obj->getField("callenro")->getValue());
        	$grcalle = $this->nosql($obj->getField("calle")->getValue());
        	$grzona = $this->ComunaToOrganismo($cgpc);
        	$georef = array(
        		"Calle" => ($grcalle!="" ? $grcalle : 0),
        		"CalleNom" => $calleNom,
        		"CalleNro" => ($calleNro!="" ? $calleNro : 0),
        		"Zona" => ($grzona!="" ? $grzona : 0),
        		"Barrio" => $barrio,
        		"PtoX" => ($coordx!="" ? $coordx : 0),
        		"PtoY" => ($coordy!="" ? $coordy : 0),
        		"IDCuadra" =>($id_cuadra!="" ? $id_cuadra : 0)
        	);
        	
      		//Verifico que exista un prestador y responsable. Si no estan... Estamos en el horno.
      		if($this->m_org_prestador==0 && $this->m_org_responsable==0)
      		{
      			//Llamar a 0800-cagaste no hay prestador ni responsable. La prestacion esta mal definida seguramente
      			error_log("Prestacion: $prestacion no puede definir Responsable/Prestador en $calleNom $calleNro");
	      	    $res[] = "MENSAJE: La prestación no esta correctamente configurada. Avise al supervisor. Intente volver a cargar el reclamo con otra prestación parecida.";
	            return $res;		
      		}
      		
      		//Si solo falta uno de los organismos, puedo salvar la plata igualandolos
      		if($this->m_org_prestador==0 && $this->m_org_responsable!=0)
      		{
      			$this->m_org_prestador = $this->m_org_responsable;
      			error_log("Prestacion: $prestacion no puede definir Prestador en $calleNom $calleNro");
      		}
      		if($this->m_org_prestador!=0 && $this->m_org_responsable==0)
      		{
      			$this->m_org_responsable = $this->m_org_prestador;
      			error_log("Prestacion: $prestacion no puede definir Responsable en $calleNom $calleNro");
      		}
      		
        	$prest = array(
        		"Prestacion" => $prestacion,
        		"Prestador" => ($this->m_org_prestador!="" ? $this->m_org_prestador : 0),
        		"OrgResponsable" => ($this->m_org_responsable!="" ? $this->m_org_responsable : 0),
        		"Plazo" => $this->PlazoADias($plazo),
        		"Obs" => $nota
        	);
        	
        	//CIUDADANO ANONIMO
        	$ciud = array(
        		"Quien" => "Anonimo",
        		"QuienTipoDoc" => "DNI",
        		"QuienNroDoc" => 0,
        		"QuienTelFax" => "",
        		"QuienDomCod" => 0,
        		"QuienDomNro" => 0,
        		"QuienDomPiso" => 0,
        		"QuienDomDpto" => "",
        		"QuienCodPostal" => "",
        		"QuienEmail" => ""
        	);
	        	
        	if(isset($_SESSION['person_status']) && $_SESSION['person_status']=="IDENTIFICADO" )
        	{
        		//Saco de la base los datos del ciudadano
        		$sql = "SELECT * FROM ciu_ciudadanos WHERE ciu_code='$ciu_code'";
        		$re = $primary_db->do_execute($sql);
        		if( $row = $primary_db->_fetch_array($re,0) )
	        	{
	        		list($tipo_doc,$nro_doc) = explode(" ",$row['ciu_doc_nro']);
	        		$ciud = array(
		        		"Quien" => $row['ciu_apellido'].", ".$row['ciu_nombres'],
		        		"QuienTipoDoc" => $tipo_doc,
		        		"QuienNroDoc" => ($nro_doc!="" ? $nro_doc : 0),
		        		"QuienTelFax" => $row['ciu_tel_fijo'],
		        		"QuienDomCod" => ($row['ciu_dir_cod_calle']!="" ? $row['ciu_dir_cod_calle'] : 0),
		        		"QuienDomNro" => ($row['ciu_dir_nro']!="" ? $row['ciu_dir_nro'] : 0),
		        		"QuienDomPiso" => ($row['ciu_dir_piso']!="" ? $row['ciu_dir_piso'] : 0),
		        		"QuienDomDpto" => $row['ciu_dir_dpto'],
		        		"QuienCodPostal" => $row['ciu_cod_postal'],
		        		"QuienEmail" => $row['ciu_email'],
		        	);
	        	}
	        	$primary_db->_free_result($re);
        	}
        	
        	//login del operador
        	$userid = $this->nosql($_SESSION['login']);
        	
        	//Canal de ingreso
        	if($canal=="CALL")
        	{
        		$formaIngreso = 0; //telefono
        		$org_receptor = 174; //Call
        	}
        	elseif($canal=="ENTE")
        	{
        		$formaIngreso = 0; //telefono
        		$org_receptor = 469; //Ente
        	}
        	elseif($canal=="CGPC")
        	{
        		$formaIngreso = 2; //mostrador
        		$org_receptor = 472; //CGPC (aqui habria que tomar el organismo del usuario logeado)
        	}
        	else
        	{
        		$formaIngreso = 4; //internet
        		$org_receptor = 177; //Internet
        	}
        	
            //Registro de por donde ingreso el ticket    	
        	$recl = array(
        		"UserId" => $userid,
        		"FormaIngreso" => $formaIngreso,
        		"OrgReceptor" => $org_receptor
        	);
        	
        	//Ejecuto el STORE que da el alta del reclamo en el SUR. Retorna el numero/año del reclamo creado.
        	$values = array_map("utf8_decode",array_merge($georef,$prest,$ciud,$recl));
			$sql = "EXECUTE [dbo].[sp_InsertReclamo] null,null,:Calle:,':CalleNom:',:CalleNro:,:Zona:,':Prestacion:',:Prestador:,:OrgResponsable:,0,:Plazo:,':Obs:'";
			$sql.= ",null,null,null,null,null,null,':Quien:',':QuienTipoDoc:',:QuienNroDoc:,':QuienTelFax:',:QuienDomCod:,:QuienDomNro:";
			$sql.= ",:QuienDomPiso:,':QuienDomDpto:',':QuienCodPostal:',':QuienEmail:',:OrgReceptor:,':UserId:',':FormaIngreso:',0,'NO'";
			$sql.= ",null,':Barrio:',null,:PtoX:,:PtoY:,:IDCuadra:,null,null";
        	$re = $reclamos_db->do_execute($sql,$res,$values);
        	if(!$re)
        	{
        		$err[] = "MENSAJE:ERROR No se puede salvar el reclamo en este momento. Contactese con mesa de ayuda.";
        		return $err;
        	}
        	if( $row = $reclamos_db->_fetch_array($re,0) )
	        {
	            $this->m_numero = $row['numero'];
	            $this->m_anio = $row['anio'];
	        }
        	$reclamos_db->_free_result($re);        	
        }
		else //Denuncias Quejas y Solicitudes al SUACI
        {
            //Determino el código de reclamo
            $this->m_numero = $this->generaCodigoTicket($this->m_tipo);
            $this->m_anio = date("Y"); //Año actual
        }

        //Comando SQL para calcular el plazo
        $plazo_sql = "NOW() + INTERVAL ".$this->PlazoADias($plazo)." DAY";
        
        //Creo ticket
        $sql = "INSERT INTO tic_ticket(tic_nro,tic_anio,tic_tipo,tic_tstamp_in,use_code,tic_nota_in,tic_estado,tic_lugar,tic_barrio,tic_cgpc,tic_coordx,tic_coordy,tic_id_cuadra,tic_forms,tic_canal,tic_calle_nombre,tic_nro_puerta,tic_tstamp_plazo) ";
        $sql.= "VALUES (:TIC_NRO:,:TIC_ANIO:,:TIC_TIPO:,NOW(),:USE_CODE:,:TIC_NOTA_IN:,'ABIERTO',:TIC_LUGAR:,:TIC_BARRIO:,:TIC_CGPC:,:TIC_COORDX:,:TIC_COORDY:,:TIC_ID_CUADRA:,:TIC_FORMS:,:TIC_CANAL:,:TIC_CALLE_NOMBRE:,:TIC_NRO_PUERTA:,:TIC_TSTAMP_PLAZO:)";
        $values = array(
                "TIC_NRO"       	=>  $this->m_numero,
                "TIC_ANIO"      	=>  $this->m_anio,
                "TIC_TIPO"      	=>  "'$this->m_tipo'",
                "USE_CODE"      	=>  "'$use_code'",
                "TIC_NOTA_IN"   	=>  "'$nota'",
                "TIC_LUGAR"     	=>  "'$lugar'",
                "TIC_BARRIO"    	=>  "'$barrio'",
                "TIC_CGPC"      	=>  "'$cgpc'",
                "TIC_COORDX"    	=>  $coordx,
                "TIC_COORDY"    	=>  $coordy,
                "TIC_ID_CUADRA" 	=>  $id_cuadra,
                "TIC_FORMS"     	=>  $this->m_form,
                "TIC_CANAL"     	=>  "'$canal'",
                "TIC_CALLE_NOMBRE"	=>  "'$calle_nombre'",
                "TIC_NRO_PUERTA"	=>  $callenro,
        		"TIC_TSTAMP_PLAZO"	=>	$plazo_sql
        );
        $primary_db->do_execute($sql,$res,$values);

        //XML del cuestionario
        $cuestionario = $obj->getField("cuestionario")->getValue();
        
        //Inserto la prestacion inicial
        $sql = "INSERT INTO tic_ticket_prestaciones(tic_nro,tic_anio,tic_tipo,tpr_code,ttp_tstamp,tru_code,ttp_cuestionario,ttp_estado,ttp_prioridad) ";
        $sql.= "VALUES(:TIC_NRO:,:TIC_ANIO:,:TIC_TIPO:,:TPR_CODE:,NOW(),:TRU_CODE:,:TTP_CUESTIONARIO:,'INICIADO',:TTP_PRIORIDAD:)";
        $values = array(
                "TIC_NRO"           =>   $this->m_numero,
                "TIC_ANIO"          =>   $this->m_anio,
                "TIC_TIPO"          =>   "'$this->m_tipo'",
                "TPR_CODE"          =>  "'$prestacion'",
                "TRU_CODE"          =>   "'$rubro'",
                "TTP_CUESTIONARIO"  =>   "'$cuestionario'",
                "TTP_PRIORIDAD"     =>   "'$prioridad'");
        $primary_db->do_execute($sql,$res,$values);

        //Creo paso inicial de la prestacion
        $sql = "INSERT INTO tic_avance(tic_nro,tic_anio,tic_tipo,tpr_code,tav_tstamp,use_code,tic_estado_in,tic_estado_out,tav_nota,tic_motivo) ";
        $sql.= "VALUES(:TIC_NRO:,:TIC_ANIO:,:TIC_TIPO:,:TPR_CODE:,NOW(),:USE_CODE:,'INICIADO','INICIADO',:TAV_NOTA:,'')";
        $values = array(
                "TIC_NRO"   =>   $this->m_numero,
                "TIC_ANIO"  =>   $this->m_anio,
                "TIC_TIPO"  =>   "'$this->m_tipo'",
                "TPR_CODE"  =>   "'$prestacion'",
                "USE_CODE"  =>   "'$use_code'",
                "TAV_NOTA"  =>   "'$nota'");
        $primary_db->do_execute($sql,$res,$values);

        //Creo la relacion Organismo->Ticket para el RESPONSABLE, PRESTADOR y OBSERVADOR
        foreach($organismos as $organismo)
        {
                $sql = "INSERT INTO tic_ticket_organismos(tic_nro,tic_anio,tic_tipo,tor_code,tto_figura,tpr_code,tto_alerta) ";
                $sql.= "VALUES(:TIC_NRO:,:TIC_ANIO:,:TIC_TIPO:,:TOR_CODE:,:TTO_FIGURA:,:TPR_CODE:,1)";
                $values = array(
                    "TIC_NRO"       =>   $this->m_numero,
                    "TIC_ANIO"      =>   $this->m_anio,
                    "TIC_TIPO"      =>   "'$this->m_tipo'",
                    "TOR_CODE"      =>   $organismo['tor_code'],
                    "TTO_FIGURA"    =>   "'".$organismo['tto_figura']."'",
	                "TPR_CODE"    	=>   "'$prestacion'"
                );
                $primary_db->do_execute($sql,$res,$values);
        }

        //La sesion NO ES anonima? Entonces salvo los datos del ciudadano
        if(isset($_SESSION['person_status']) && $_SESSION['person_status']=="IDENTIFICADO" )
        {
                //Creo relacion Ciudadano-Ticket (salvo que sea anonimo)
                $sql = "INSERT INTO tic_ticket_ciudadano(tic_nro,tic_anio,tic_tipo,ciu_code,ttc_tstamp,ttc_nota) ";
                $sql.="VALUES(:TIC_NRO:,:TIC_ANIO:,:TIC_TIPO:,:CIU_CODE:,NOW(),:TTC_NOTA:)";

                $values = array(
                "TIC_NRO"   =>   $this->m_numero,
                "TIC_ANIO"  =>   $this->m_anio,
                "TIC_TIPO"  =>   "'$this->m_tipo'",
                "CIU_CODE"  =>   $ciu_code,
                "TTC_NOTA"  =>   "'$nota'");
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
        $codigo=0;
        $anio = date("Y"); //Año actual
        $sql = "call getnext( '$tipo-$anio')";
        $re = $primary_db->do_execute($sql);
        if( $row = $primary_db->_fetch_array($re,0) )
        {
            $codigo = $row[0];
        }
        $primary_db->_free_result($re);
        return $codigo;
    }


    //Genera un XML con la direccion 
    private function generaXMLLugar($obj)
    {
    	$tipo_georef = $this->nosql($obj->getField("tipo_georef")->getValue());
        
    	if($tipo_georef=="DOMICILIO")
    	{
	        $calle_nombre = $obj->getField("calle_nombre")->getValue();
	        $calle = $obj->getField("calle")->getValue();
	        $callenro = $obj->getField("callenro")->getValue();
	        $piso = $obj->getField("piso")->getValue();
	        $dpto = $obj->getField("dpto")->getValue();
	        $nombre_fantasia = $obj->getField("nombre_fantasia")->getValue();
	        
		    $ret = '<?xml version="1.0" encoding="utf-8"?>';
	        $ret.= '<direccion><domicilio>';
	        $ret.= '<calle>'.$calle_nombre.'</calle>';
	        $ret.= '<nro>'.$callenro.'</nro>';
	        $ret.= '<piso>'.$piso.'</piso>';
	        $ret.= '<dpto>'.$dpto.'</dpto>';
	        $ret.= '<nombre_fantasia>'.$nombre_fantasia.'</nombre_fantasia>';
	        $ret.= '</domicilio></direccion>';       
    	}
    	
        if($tipo_georef=="VILLA")
    	{    	
        	$villa = $this->nosql($obj->getField("villa")->readAltValue());
        	$vilmanzana = $this->nosql($obj->getField("vilmanzana")->getValue());
        	$vilcasa = $this->nosql($obj->getField("vilcasa")->getValue());

        	$ret = '<?xml version="1.0" encoding="utf-8"?>';
	        $ret.= '<direccion><villa>';
	        $ret.= '<nombre>'.$villa.'</nombre>';
	        $ret.= '<manzana>'.$vilmanzana.'</manzana>';
	        $ret.= '<casa>'.$vilcasa.'</casa>';
	        $ret.= '</villa></direccion>';
    	}
    	
        if($tipo_georef=="PLAZA")
    	{    	
        	$plaza = $this->nosql($obj->getField("plaza")->getValue());
        	$ret = '<?xml version="1.0" encoding="utf-8"?>';
	        $ret.= '<direccion><plaza>';
	        $ret.= '<nombre>'.$plaza.'</nombre>';
	        $ret.= '</plaza></direccion>';
    	}
    	
        if($tipo_georef=="CEMENTERIO")
    	{    	
	        $cementerio = $this->nosql($obj->getField("cementerio")->getValue());
    	    $sepultura = $this->nosql($obj->getField("sepultura")->getValue());
        	$sepsector = $this->nosql($obj->getField("sepsector")->getValue());
        	$sepcalle = $this->nosql($obj->getField("sepcalle")->getValue());
        	$sepnumero = $this->nosql($obj->getField("sepnumero")->getValue());
        	$sepfila = $this->nosql($obj->getField("sepfila")->getValue());
        	
        	$ret = '<?xml version="1.0" encoding="utf-8"?>';
	        $ret.= '<direccion><cementerio>';
	        $ret.= '<nombre>'.$cementerio.'</nombre>';
	        $ret.= '<sepultura>'.$sepultura.'</sepultura>';
	        $ret.= '<sector>'.$sepsector.'</sector>';
	        $ret.= '<calle>'.$sepcalle.'</calle>';
	        $ret.= '<numeror>'.$sepnumero.'</numero>';
	        $ret.= '<fila>'.$sepfila.'</fila>';
	        $ret.= '</cementerio></direccion>';
    	}

	    if($tipo_georef=="ORGAN.PUBLICO")
    	{    	
        	$organismo = $this->nosql($obj->getField("orgpublico")->getValue());
        	$sector = $this->nosql($obj->getField("orgsector")->getValue());
        	
        	$ret = '<?xml version="1.0" encoding="utf-8"?>';
	        $ret.= '<direccion><orgpublico>';
	        $ret.= '<nombre>'.$organismo.'</nombre>';
	        $ret.= '<sector>'.$sector.'</sector>';
	        $ret.= '</orgpublico></direccion>';
    	}
    	
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
    
    /** La usig expresa el CGPC como "Comuna X"
     * hay que convertir ese string al codigo de organismo
     * @param $cgpc
     * @return int
     */
    private function ComunaToOrganismo($cgpc)
    {
    	$org_cgps = array(
    		"Comuna 1" => 1,
	    	"Comuna 2" => 2,
	    	"Comuna 3" => 3,
	    	"Comuna 4" => 6,
	    	"Comuna 5" => 5,
	    	"Comuna 6" => 7,
	    	"Comuna 7" => 8,
	    	"Comuna 8" => 9,
	    	"Comuna 9" => 10,
	    	"Comuna 10" => 11,
	    	"Comuna 11" => 12,
	    	"Comuna 12" => 13,
	    	"Comuna 13" => 14,
	    	"Comuna 14" => 15,
	    	"Comuna 15" => 16,
    	);
    	if(array_key_exists($cgpc,$org_cgps))
    	{
    		return $org_cgps[$cgpc];	
    	}
 		return 0;   	
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
    
    private function nosql($campo)
    {
    	$search = array("'" ,"-");
    	$replace= array("''","_" );
		return str_replace($search,$replace,$campo);    	
    }
}
?>