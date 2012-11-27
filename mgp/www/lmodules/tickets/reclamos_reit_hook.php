<?php
class creclamos_hooks extends cclass_maint_hooks
{
    private $m_prestacion_detalle;
    private $m_form;
    private $m_tipo;
    private $m_numero;
    private $m_anio;
   
    //
    // Se ejecuta antes de salvar el objeto a la base de datos
    // Me fijo si el ciudadano ya existe en la lista. 
    // Si es asi, lo agrego a tic_ticket_ciudadano_reit
    // Si no existe, es un nuevo reclamante y va a tic_ticket_ciudadano
    //
    // Retorna una lista de errores o un array vacio si todo esta OK
    public function beforeSaveDB()
	{
		global $primary_db,$reclamos_db;
		$obj = $this->m_data;
        $this->m_can_save = false;
		$res = array();
		
		//Ya esta procesado este ticket? En este caso estoy jodido... ya que se considera como que reitero mas de una vez 
		//y eso es legal
        $nota = $this->nosql($obj->getField("nota")->getValue());
        
        //Tipo de prestacion y descripción
        $prestacion = $this->nosql($obj->getField("prestacion")->getValue());
        $sql = "select tpr_tipo,tpr_detalle,tpr_plazo from tic_prestaciones where tpr_code='$prestacion'";
        $re = $primary_db->do_execute($sql);
        if( $row=$primary_db->_fetch_array($re) )
        {
            $this->m_tipo = $row['tpr_tipo'];
            $this->m_prestacion_detalle = $row['tpr_detalle'];
            $plazo = $row['tpr_plazo'];
        }
        
        //Canal de ingreso
        $canal = $this->determinarCanal();
                
        //Reclamante o Anonimo
        $ciu_code = $this->nosql($_SESSION['person_id']);
        
        //Identificador de reclamo
        $this->m_numero = $this->nosql($obj->getField("numero")->getValue());
        $this->m_anio = $this->nosql($obj->getField("anio")->getValue());
	    
        //Proceso Reclamos mando reiteracion al SUR viejo
        
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
        	if( $row = $primary_db->_fetch_array($re) )
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
        
        $recl = array(
        	"UserId" => $userid,
        	"Numero" => $this->m_numero,
        	"Anio" => $this->m_anio,
        	"Obs" => $nota
        );
        
        //Ejecuto el STORE que reitera el reclamo en el SUR. Retorna el numero/año del reclamo creado.
        $values = array_map("utf8_decode",array_merge($ciud,$recl));

        $sql = "EXECUTE [dbo].[sp_ReiterarReclamo] ";
		$sql.= ":Numero:,:Anio:,':UserId:',':Obs:',':Quien:',':QuienTipoDoc:',':QuienNroDoc:',':QuienTelFax:',";
		$sql.= ":QuienDomCod:,:QuienDomNro:,':QuienDomPiso:',':QuienDomDpto:',':QuienCodPostal:',':QuienEmail:',";
		$sql.= "0,'-'";
        $reclamos_db->do_execute($sql,$res,$values);

        //El ticket ya esta dado de alta en el sistema nuevo??
        $sql = "SELECT count(*) as cant FROM tic_ticket WHERE tic_nro=:TIC_NRO: AND tic_anio=:TIC_ANIO: AND tic_tipo='RECLAMO'";
        $values = array(
                "TIC_NRO"   =>   $this->m_numero,
                "TIC_ANIO"  =>   $this->m_anio
        );
        $re = $primary_db->do_execute($sql,$res,$values);
        $cant = 0;
        if( $row=$primary_db->_fetch_array($re,0) )
        {
            $cant = $row['cant'];
        }
        $primary_db->_free_result($re);
        
        //NO -> Creo un nuevo ticket para luego meter la referencia al operador 
        if($cant==0)
        {
        	//Saco los datos originales del SUR
        	$sql = "SELECT CONVERT(varchar,FechaIngreso,103) as FechaIngreso,Calle,CalleNro,Zona,Prestacion,Prestador,OrgResponsable,Plazo,Obs,Estado,Barrio,FormaIngreso,EXT_COORDX,EXT_COORDY,EXT_CALLE_NOMBRE FROM reclamos WHERE numero=:NUMERO: and anio=:ANIO: and derivacion='-'";
        	$values = array(
	                "NUMERO"    =>  $this->m_numero,
	                "ANIO"      =>  $this->m_anio
	        );
        	$rec = $reclamos_db->do_execute($sql,$res,$values);
        	$row_rec = $reclamos_db->_fetch_array($rec,0);
        	$reclamos_db->_free_result($rec);
        	
        	//cgpc
        	$cgpc = $this->OrganismoToComuna($row_rec['zona']);
        	
        	//Compongo la direccion     
		    $lugar = '<?xml version="1.0" encoding="utf-8"?>';
	        $lugar.= '<direccion><domicilio>';
	        $lugar.= '<calle>'.$row_rec['ext_calle_nombre'].'</calle>';
	        $lugar.= '<nro>'.$row_rec['callenro'].'</nro>';
	        $lugar.= '<piso></piso>';
	        $lugar.= '<dpto></dpto>';
	        $lugar.= '<nombre_fantasia></nombre_fantasia>';
	        $lugar.= '</domicilio></direccion>';       
	        
        	//Canal
        	$canal = $this->IngresoToCanal($row_rec['formaingreso']);
	        
        	//Plazo
        	$plazo_sql = "STR_TO_DATE('".$row_rec['fechaingreso']."','%d/%m/%Y %k:%i:%s') + INTERVAL ".$row_rec['plazo']." DAY";
        	
        	//Fecha ingreso
        	$ingreso_sql = "STR_TO_DATE('".$row_rec['fechaingreso']."','%d/%m/%Y %k:%i:%s')";
        	
	        //Creo ticket
	        $sql = "INSERT INTO tic_ticket(tic_nro,tic_anio,tic_tipo,tic_tstamp_in,use_code,tic_nota_in,tic_estado,tic_lugar,tic_barrio,tic_cgpc,tic_coordx,tic_coordy,tic_id_cuadra,tic_forms,tic_canal,tic_calle_nombre,tic_nro_puerta,tic_tstamp_plazo) ";
	        $sql.= "VALUES (:TIC_NRO:,:TIC_ANIO:,'RECLAMO',:TIC_TSTAMP_IN:,':USE_CODE:',':TIC_NOTA_IN:','ABIERTO',':TIC_LUGAR:',':TIC_BARRIO:',':TIC_CGPC:',:TIC_COORDX:,:TIC_COORDY:,0,:TIC_FORMS:,':TIC_CANAL:',':TIC_CALLE_NOMBRE:',:TIC_NRO_PUERTA:,:TIC_TSTAMP_PLAZO:)";
	        $values = array(
	                "TIC_NRO"       =>  $this->m_numero,
	                "TIC_ANIO"      =>  $this->m_anio,
	                "USE_CODE"      =>  $use_code,
	                "TIC_NOTA_IN"   =>  $row_rec['obs'],
	                "TIC_LUGAR"     =>  $lugar,
	                "TIC_BARRIO"    =>  $row_rec['barrio'] ,
	                "TIC_CGPC"      =>  $cgpc,
	                "TIC_COORDX"    =>  ($row_rec['ext_coordx']=="" ? 0 : $row_rec['ext_coordx']),
	                "TIC_COORDY"    =>  ($row_rec['ext_coordy']=="" ? 0 : $row_rec['ext_coordy']),
	                "TIC_FORMS"     =>  ($this->m_form=="" ? 0 : $this->m_form),
	                "TIC_CANAL"     =>  $canal,
	                "TIC_CALLE_NOMBRE"=>  $row_rec['ext_calle_nombre'],
	                "TIC_NRO_PUERTA"=>  ($row_rec['callenro']=="" ? 0 : $row_rec['callenro']) ,
	        		"TIC_TSTAMP_PLAZO"=>$plazo_sql,
	        		"TIC_TSTAMP_IN"	=>$ingreso_sql
	        );
	        $primary_db->do_execute($sql,$res,$values);
	        
	        
	         //Inserto la prestacion inicial
        	$sql = "INSERT INTO tic_ticket_prestaciones(tic_nro,tic_anio,tic_tipo,tpr_code,ttp_tstamp,tru_code,ttp_cuestionario,ttp_estado,ttp_prioridad) ";
        	$sql.= "VALUES(:TIC_NRO:,:TIC_ANIO:,'RECLAMO',':TPR_CODE:',:TIC_TSTAMP_IN:,0,'','INICIADO','1.1')";
        	$values = array(
                "TIC_NRO"           =>   $this->m_numero,
                "TIC_ANIO"          =>   $this->m_anio,
                "TPR_CODE"          =>   $prestacion,
        		"TIC_TSTAMP_IN"		=>	 $ingreso_sql
 			);
        	$primary_db->do_execute($sql,$res,$values);

	        //Creo paso inicial de la prestacion
    	    $sql = "INSERT INTO tic_avance(tic_nro,tic_anio,tic_tipo,tpr_code,tav_tstamp,use_code,tic_estado_in,tic_estado_out,tav_nota,tic_motivo) ";
        	$sql.= "VALUES(:TIC_NRO:,:TIC_ANIO:,'RECLAMO',':TPR_CODE:',:TIC_TSTAMP_IN:,':USE_CODE:','INICIADO','INICIADO',':TAV_NOTA:','')";
        	$values = array(
                "TIC_NRO"   	=>   $this->m_numero,
                "TIC_ANIO"  	=>   $this->m_anio,
                "TPR_CODE"  	=>   $prestacion,
                "TIC_TSTAMP_IN"	=>	 $ingreso_sql,
                "USE_CODE"  	=>   $use_code,
                "TAV_NOTA"  	=>   $row_rec['obs']
        	);
        	$primary_db->do_execute($sql,$res,$values);

	        //Creo la relacion Organismo->Ticket para el RESPONSABLE, PRESTADOR y OBSERVADOR
    	    $sql = "INSERT INTO tic_ticket_organismos(tic_nro,tic_anio,tic_tipo,tor_code,tto_figura,tpr_code,tto_alerta) ";
            $sql.= "VALUES(:TIC_NRO:,:TIC_ANIO:,'RECLAMO',:TOR_CODE:,'RESPONSABLE',':TPR_CODE:',1)";
            $values = array(
                    "TIC_NRO"       =>   $this->m_numero,
                    "TIC_ANIO"      =>   $this->m_anio,
                    "TOR_CODE"      =>   $row_rec['orgresponsable'],
	                "TPR_CODE"    	=>   $prestacion
             );
            $primary_db->do_execute($sql,$res,$values);
        
	        $sql = "INSERT INTO tic_ticket_organismos(tic_nro,tic_anio,tic_tipo,tor_code,tto_figura,tpr_code,tto_alerta) ";
            $sql.= "VALUES(:TIC_NRO:,:TIC_ANIO:,'RECLAMO',:TOR_CODE:,'PRESTADOR',':TPR_CODE:',1)";
            $values = array(
                    "TIC_NRO"       =>   $this->m_numero,
                    "TIC_ANIO"      =>   $this->m_anio,
                    "TOR_CODE"      =>   $row_rec['prestador'],
	                "TPR_CODE"    	=>   $prestacion
             );
            $primary_db->do_execute($sql,$res,$values);
        
        }
        
        //Se produjo algun MOCO?
        if(count($res)==0)
        {
	        //Salvo la reiteracion del ticket (me fijo primero si existe o no el registro del reclamo con este ciudadano)
	        $sql = "SELECT count(*) as cant FROM tic_ticket_ciudadano WHERE tic_nro=:TIC_NRO: AND tic_anio=:TIC_ANIO: AND tic_tipo='RECLAMO' AND ciu_code=:CIU_CODE:";
	        $values = array(
	                "TIC_NRO"   =>   $this->m_numero,
	                "TIC_ANIO"  =>   $this->m_anio,
	                "CIU_CODE"  =>   $ciu_code
	        );
	        $re = $primary_db->do_execute($sql,$res,$values);
	        $cant = 0;
	        if( $row=$primary_db->_fetch_array($re,0) )
	        {
	            $cant = $row['cant'];
	        }
	        $primary_db->_free_result($re);
	        
	        if($cant==0)
			{
	        	//Caso que no exista el ciudadano
	            $sql = "INSERT INTO tic_ticket_ciudadano(tic_nro,tic_anio,tic_tipo,ciu_code,ttc_tstamp,ttc_nota) ";
	            $sql.= "VALUES(:TIC_NRO:,:TIC_ANIO:,'RECLAMO',:CIU_CODE:,NOW(),':TTC_NOTA:')";
	
	            $values = array(
	                "TIC_NRO"   =>   $this->m_numero,
	                "TIC_ANIO"  =>   $this->m_anio,
	                "CIU_CODE"  =>   $ciu_code,
	                "TTC_NOTA"  =>   $nota
	            );
	            $primary_db->do_execute($sql,$res,$values);
			}
			else
			{
				//Caso que ya exista el ciudadano
	            $sql = "INSERT INTO tic_ticket_ciudadano_reit(tic_nro,tic_anio,tic_tipo,ciu_code,ttc_tstamp,ttc_nota) ";
	            $sql.= "VALUES(:TIC_NRO:,:TIC_ANIO:,'RECLAMO',:CIU_CODE:,NOW(),':TTC_NOTA:')";
	
	            $values = array(
	                "TIC_NRO"   =>   $this->m_numero,
	                "TIC_ANIO"  =>   $this->m_anio,
	                "CIU_CODE"  =>   $ciu_code,
	                "TTC_NOTA"  =>   $nota
	            );
	            $primary_db->do_execute($sql,$res,$values);
			}
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
        $numero = $this->m_numero;
        $anio = $this->m_anio;

        //Genero contenido para el mensaje de respuesta.
        $content['nroticket'] = "$numero/$anio";
        $content['prestacion'] = "$descripcion";
        $content['tranid'] = $this->m_form;

		return array($content,$res);
	}


/*                 FUNCIONES PRIVADAS                       */

	    //Determina el canal de ingreso 
    private function determinarCanal()
    {
        $canal = "WEB";

        //Reviso los grupos del usurio logeado busco uno que diga canal_
        if( isset($_SESSION['groups']) )
        {
            $partes = explode(",",$_SESSION['groups']);
            foreach($partes as $grupo)
            {
                if(substr($grupo,0,6)=="canal_")
                {
                    $canal = strtoupper(substr($grupo,7));
                    break;
                }
            }
        }
        
        return $canal;
    }
    
 	private function OrganismoToComuna($cgpc)
    {
    	$comuna_cgpc = array(
    		1 => "Comuna 1",
	    	2 => "Comuna 2",
	    	3 => "Comuna 3",
	    	6 => "Comuna 4",
	    	5 => "Comuna 5",
	    	7 => "Comuna 6",
	    	8 => "Comuna 7",
	    	9 => "Comuna 8",
	    	10 => "Comuna 9",
	    	11 => "Comuna 10",
	    	12 => "Comuna 11",
	    	13 => "Comuna 12",
	    	14 => "Comuna 13",
	    	15 => "Comuna 14",
	    	16 => "Comuna 15"
    	);
    	if(array_key_exists($cgpc,$comuna_cgpc))
    	{
    		return $comuna_cgpc[$cgpc];	
    	}
 		return "";   	
    }
    
    private function IngresoToCanal($ing)
    {
    	$canal = "";
    	//Canal de ingreso
        if($ing==0)
        {
        	$canal="CALL";
        }
        elseif($ing==2)
        {
        	$canal="CGPC";
        }
        elseif($ing==4)
        {
        	$canal="WEB"; //internet
        }
        
        return $canal;
    }
	
    private function nosql($campo)
    {
    	$search = array("'" ,"--");
    	$replace= array("''","-" );
		return str_replace($search,$replace,$campo);    	
    }
}
?>