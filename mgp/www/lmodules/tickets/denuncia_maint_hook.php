<?php
/** OPERACIONES DE CAMBIO DE ESTADO DE UNA DENUNCIA
 * 
 * @author jcordero
 *
 */
class class_tic_ticket_upd_den_hooks extends cclass_maint_hooks
{
    private $m_prestacion_detalle;
    private $m_form;
    private $m_tipo;
    private $m_numero;
    private $m_anio;
    private $m_tpr_code;
   
    /** CAMBIO AUTOMATICO A NOTIFICADA
     * 
     */
    public function beforeLoadDB()
    {
    	global $primary_db;
		$obj = $this->m_data;
        $err = array();
    	$pasar_a_notificado = false;
    	
    	//En este punto tengo la PK declarada. Si el estado es INICIADO, paso el ticket a NOTIFICADO 
    	
    	//Identificador de ticket
        $this->m_numero = $this->nosql($obj->getField("tic_nro")->getValue());
        $this->m_anio = $this->nosql($obj->getField("tic_anio")->getValue());
        $this->m_tipo = $this->nosql($obj->getField("tic_tipo")->getValue());
        $this->m_tpr_code = $this->nosql($obj->getField("acc_tpr_code")->getValue());
        
    	$sql = "select ttp_estado from tic_ticket_prestaciones where tic_nro=$this->m_numero and tic_anio=$this->m_anio and tic_tipo='$this->m_tipo' and tpr_code='$this->m_tpr_code'";
        $re = $primary_db->do_execute($sql);
        if( $row=$primary_db->_fetch_array($re) )
        {
        	if($row["ttp_estado"]=="INICIADO")
        	{
        		$pasar_a_notificado = true;
        	}
        }
        $primary_db->_free_result($re);
        
       	if($pasar_a_notificado)
       	{
	       	$mis_organismos = $this->obtenerOrganismos($userid);
        	if($mis_organismos=="")
        	{
        		$err[] = "MENSAJE: No se puede determinar a que organismo pertenece. No se puede completa la operación";
        		return $err;
        	}
       		
       		$nuevo_estado = "NOTIFICADA";
       		$nota = "Cambio automático por visualización de denuncia";
       		$use_code = $this->nosql($_SESSION['user_id']);
        	
       		//Cambio de estado de la prestación
       		$sql = "update tic_ticket_prestaciones set ttp_estado='$nuevo_estado' where tic_nro=$this->m_numero and tic_anio=$this->m_anio and tic_tipo='$this->m_tipo' and tpr_code='$this->m_tpr_code' ";
			$primary_db->do_execute($sql);
			
			//Saco el alerta
			$sql = "update tic_ticket_organismos set tto_alerta=0 where tic_nro=$this->m_numero and tic_anio=$this->m_anio and tic_tipo='$this->m_tipo' ";
			$sql.= "and tpr_code='$this->m_tpr_code' and tor_code in ($mis_organismos)";
			$primary_db->do_execute($sql);
			
			//Registro el avance
	        $sql = "INSERT INTO tic_avance(tic_nro,tic_anio,tic_tipo,tpr_code,tav_tstamp,use_code,tic_estado_in,tic_estado_out,tav_nota,tic_motivo) ";
	        $sql.= "VALUES(:TIC_NRO:,:TIC_ANIO:,:TIC_TIPO:,:TPR_CODE:,NOW(),:USE_CODE:,'INICIADO',':ESTADO_FIN:',:TAV_NOTA:,'')";
	        $values = array(
	                "TIC_NRO"   =>   $this->m_numero,
	                "TIC_ANIO"  =>   $this->m_anio,
	                "TIC_TIPO"  =>   "'$this->m_tipo'",
	                "TPR_CODE"  =>   "'$this->m_tpr_code'",
	                "USE_CODE"  =>   "'$use_code'",
	        		"ESTADO_FIN"=>	 $nuevo_estado,
	                "TAV_NOTA"  =>   "'$nota'");
	        $primary_db->do_execute($sql,$res,$values);	
       	}
        
        return $err;
    }
	
    
    //
    // Se ejecuta antes de salvar el objeto a la base de datos
    //	Verifica si el estado cambia. De ser asi, validar que el cambio sea logico.
    //	Si INICIADA -> NOTIFICADA
    //	Si NOTIFICADA -> TRANSFERIDA,CUMPLIDA,DESESTIMADA,ASOCIADA
    //	Si TRANSFERIDA -> CUMPLIDA,DESESTIMADA,ASOCIADA
    //	Si ASOCIADA -> Nada
    //	Si CUMPLIDA -> Nada
    //	Si DESESTIMADA -> Nada
    
    // TODO: FALTA PROCESAR EL AGREGADO DE UNA NUEVA PRESTACION
    // TODO: FALTA PROCESAR LA ASOCIACION DEL TICKET A OTRO
    
    // Retorna una lista de errores o un array vacio si todo esta OK
    public function beforeSaveDB()
	{
		global $primary_db;
		$obj = $this->m_data;
        $this->m_can_save = false;
		$res = array();
		
		//Identificador de ticket
        $this->m_numero = $this->nosql($obj->getField("tic_nro")->getValue());
        $this->m_anio = $this->nosql($obj->getField("tic_anio")->getValue());
        $this->m_tipo = $this->nosql($obj->getField("tic_tipo")->getValue());
        
        //Es una denuncia?
        if($this->m_tipo!="DENUNCIA")
        {
        	$res[] = "MENSAJE: Solo puede aplicar esta operación a los tickets de DENUNCIAS";
        	return $res;
        }
        
        //login del operador
        $userid = $this->nosql($_SESSION['login']);
        $use_code = $this->nosql($_SESSION['user_id']);
        
        //Organismos a los que pertenece este usuario, en forma de lista separada por comas
        $mis_organismos = $this->obtenerOrganismos($userid);
        if($mis_organismos=="")
        {
        	$res[] = "MENSAJE: No se puede determinar a que organismo pertenece. No se puede completa la operación";
        	return $res;
        }
        
       	//Verifico que el operador tenga derecho de modificar la denuncia
    	$sql = "select count(*) as cant from tic_ticket_organismos where tic_nro=$this->m_numero and tic_anio=$this->m_anio and tic_tipo='$this->m_tipo' ";
    	$sql.= "and tto_figura='RESPONSABLE' and tor_code in ($mis_organismos)";
        $re = $primary_db->do_execute($sql);
        if( $row=$primary_db->_fetch_array($re) )
        {
        	if($row["cant"]==0)
        	{
        		$res[] = "MENSAJE: Su perfil de usuario no permite modificar a esta denuncia";
        		return $res;
        	}
        }
        $primary_db->_free_result($re);
        
        //Prestacion que se desea afectar (No definido->Todas)
		$prestacion = $this->nosql($obj->getField("acc_tpr_code")->getValue());        
		$nuevo_estado = $this->nosql($obj->getField("acc_estado")->getValue());        
		
		//Observacion
		$nota = $this->nosql($obj->getField("acc_nota")->getValue());
        
        //Canal de ingreso
        $canal = $this->determinarCanal();
		
		//Verifico que el estado de la prestacion sea compatible con el pedido
		//de cambio del operador
		$sql = "select ttp_estado,tpr_code from tic_ticket_prestaciones where tic_nro=$this->m_numero and tic_anio=$this->m_anio and tic_tipo='$this->m_tipo' ";
		if($prestacion != "")
		{
			$sql.= "and tpr_code='$prestacion'";
		}
        $re = $primary_db->do_execute($sql);
        $j=0;
        while( $row=$primary_db->_fetch_array($re,$j++) )
        {
        	$estado = $row["ttp_estado"];
        	
        	//Proceso especificamente esta prestacion
        	$prest = $row["tpr_code"];
        	
        	if($estado=="INICIADA" || $estado=="INICIADO")
        	{
        		if($nuevo_estado!="INICIADA" && $nuevo_estado!="NOTIFICADA" && $nuevo_estado!="")
        		{
        			$res[] = "MENSAJE: La denuncia,prestacion $prest solo puede cambiar a estado INICIADA o NOTIFICADA";
        			return $res;
        		}	
        	}
        	elseif($estado=="NOTIFICADA")
        	{
	        	if($nuevo_estado!="NOTIFICADA" && $nuevo_estado!="TRANSFERIDA" && $nuevo_estado!="ASOCIADA" && $nuevo_estado!="CUMPLIDA" && $nuevo_estado!="DESESTIMADA" && $nuevo_estado!="")
        		{
        			$res[] = "MENSAJE: La denuncia,prestacion $prest solo puede cambiar a estado NOTIFICADA,TRANSFERIDA,CUMPLIDA,DESESTIMADA o ASOCIADA.";
        			return $res;
        		}
        	}
        	elseif($estado=="TRANSFERIDA")
        	{
	        	if($nuevo_estado!="TRANSFERIDA" && $nuevo_estado!="ASOCIADA" && $nuevo_estado!="CUMPLIDA" && $nuevo_estado!="DESESTIMADA" && $nuevo_estado!="")
        		{
        			$res[] = "MENSAJE: La denuncia,prestacion $prest solo puede cambiar a estado TRANSFERIDA,CUMPLIDA,DESESTIMADA o ASOCIADA.";
        			return $res;
        		}
        	}
        	elseif($estado=="CUMPLIDA")
        	{
	        	if($nuevo_estado!="CUMPLIDA" && $nuevo_estado!="")
        		{
        			$res[] = "MENSAJE: La denuncia,prestacion $prest no se puede cambiar de estado. Esta CUMPLIDA.";
        			return $res;
        		}	
        	}
        	elseif($estado=="DESESTIMADA")
        	{
	        	if($nuevo_estado!="DESESTIMADA" && $nuevo_estado!="")
        		{
        			$res[] = "MENSAJE: La denuncia, prestacion $prest no se puede cambiar de estado, Esta DESESTIMADA.";
        			return $res;
        		}
        	}
        	elseif($estado=="ASOCIADA")
        	{
	        	if($nuevo_estado!="ASOCIADA" && $nuevo_estado!="")
        		{
        			$res[] = "MENSAJE: La denuncia,prestacion $prest no se puede cambiar de estado. Esta ASOCIADA.";
        			return $res;
        		}    		
        	}
        	else
        	{
        		$res[] = "MENSAJE: La denuncia,prestacion $prest esta en estado '$estado' que no es reconocido por el sistema.";
        		return $res;
        	}	

        	//Transfiero la prestacion
			if($nuevo_estado=="TRANSFERIDA")
			{
				//Cual es el organismo actual?
				$organismo = "";
				$sql = "select tor_code from tic_ticket_organismos where tic_nro=$this->m_numero and tic_anio=$this->m_anio and tic_tipo='$this->m_tipo' and tpr_code='$prest' and tto_figura='RESPONSABLE'";
				$re = $primary_db->do_execute($sql);
        		if( $row=$primary_db->_fetch_array($re) )
        		{
		        	$organismo = $row["tor_code"];
		        }
		        $primary_db->_free_result($re);

		        //organismo destino
				$nuevo_organismo = $this->nosql($obj->getField("acc_tor_code")->getValue());
				
				//Lo indicó el operador o se olvidó?
				if($nuevo_organismo!="")
				{
					//Existe este nuevo organismo?
					$sql = "select count(*) as cant from tic_ticket_organismos where tic_nro=$this->m_numero and tic_anio=$this->m_anio and tic_tipo='$this->m_tipo' and tor_code='$nuevo_organismo'";
					$re = $primary_db->do_execute($sql);
        			if( $row=$primary_db->_fetch_array($re) )
        			{
			        	$cant = $row["cant"];
			        }
			        $primary_db->_free_result($re);
        
			        if($cant==0)
			        {
			        	$sql = "insert into tic_ticket_organismos(tic_nro,tic_anio,tic_tipo,tor_code,tto_figura,tpr_code,tto_alerta) ";
				    	$sql.= "values($this->m_numero,$this->m_anio,'$this->m_tipo','$nuevo_organismo','RESPONSABLE','$prest',1)";
				    	$primary_db->do_execute($sql);
			        }
			        else
			        {
			        	$sql = "update tic_ticket_organismos set tto_figura='RESPONSABLE',tto_alerta=1 ";
				    	$sql.= "where tic_nro=$this->m_numero and tic_anio=$this->m_anio and tic_tipo='$this->m_tipo' and tpr_code='$prest' and tor_code='$nuevo_organismo'";
				    	$primary_db->do_execute($sql);
			        }
			        
			        //Finalmente paso el organismo actual a rol OBSERVADOR
			        if($organismo!="")
			        {
			        	$sql = "update tic_ticket_organismos set tto_figura='OBSERVADOR',tto_alerta=0 ";
			    		$sql.= "where tic_nro=$this->m_numero and tic_anio=$this->m_anio and tic_tipo='$this->m_tipo' and tpr_code='$prest' and tor_code='$organismo'";
			    		$primary_db->do_execute($sql);
			        }
				}
				else
				{
					//Se olvido de indicar cual es el organismo destino
					$res[] = "MENSAJE: La denuncia,prestacion $prest se ha solicitado transferencia pero no se ha indicado el organismo destino.";
        			return $res;
				}
					
			}
			else
			{
				//Levanto el alerta
				$sql = "update tic_ticket_organismos set tto_alerta=0 where tic_nro=$this->m_numero and tic_anio=$this->m_anio and tic_tipo='$this->m_tipo' and tpr_code='$prest' ";
				$primary_db->do_execute($sql);
			}
			
	        //Cambio el estado a la prestación
			if($estado!=$nuevo_estado && $nuevo_estado!="")
			{
				$sql = "update tic_ticket_prestaciones set ttp_estado='$nuevo_estado' where tic_nro=$this->m_numero and tic_anio=$this->m_anio and tic_tipo='$this->m_tipo' and tpr_code='$prest' ";
			    $primary_db->do_execute($sql);
			    
			    if($nuevo_estado=="CUMPLIDA" || $nuevo_estado=="DESESTIMADA")
			    {
			    	$sql = "update tic_ticket set tic_estado='CERRADO' where tic_nro=$this->m_numero and tic_anio=$this->m_anio and tic_tipo='$this->m_tipo'";
			    	$primary_db->do_execute($sql);
			    }
			    
				if($nuevo_estado=="ASOCIADA")
			    {
			    	//La denuncia destino debe estar abierta y ser del mismo rubro
			    	
			    	//OK, entoces paso todo el ticket a estado ASOCIADA y registro a donde la asocie
			    	$sql = "update tic_ticket set tic_estado='ASOCIADA' where tic_nro=$this->m_numero and tic_anio=$this->m_anio and tic_tipo='$this->m_tipo'";
			    	$primary_db->do_execute($sql);
			    	
			    	//Sumo esta denuncia a la lista de asociadas del destinatario (tic_ticket_asociado)
			    	
			    }
			}

			    	
			//Registro el avance
	        $sql = "INSERT INTO tic_avance(tic_nro,tic_anio,tic_tipo,tpr_code,tav_tstamp,use_code,tic_estado_in,tic_estado_out,tav_nota,tic_motivo) ";
	        $sql.= "VALUES(:TIC_NRO:,:TIC_ANIO:,:TIC_TIPO:,:TPR_CODE:,NOW(),:USE_CODE:,':ESTADO_INI:',':ESTADO_FIN:',:TAV_NOTA:,'')";
	        $values = array(
	                "TIC_NRO"   =>   $this->m_numero,
	                "TIC_ANIO"  =>   $this->m_anio,
	                "TIC_TIPO"  =>   "'$this->m_tipo'",
	                "TPR_CODE"  =>   "'$prest'",
	                "USE_CODE"  =>   "'$use_code'",
	        		"ESTADO_INI"=>	 $estado, 
	        		"ESTADO_FIN"=>	 ($nuevo_estado=="" ? $estado : $nuevo_estado), //Si no pide hacer nada,cambiando el estado entonces solo registro la nota
	                "TAV_NOTA"  =>   "'$nota'");
	        $primary_db->do_execute($sql,$res,$values);
        }
		$primary_db->_free_result($re);
              
		
		//Salvo los archivos adjuntos
		$obj->SaveDB($primary_db,0,true);
		
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

        $numero = $this->m_numero;
        $anio = $this->m_anio;

        //Genero contenido para el mensaje de respuesta.
        $content['nroticket'] = "$numero/$anio";
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
                if(stristr($grupo,"canal_")!=false)
                {
                    $canal = strtoupper(substr($grupo,7));
                    break;
                }
            }
        }
        
        return $canal;
    }
	
    private function nosql($campo)
    {
    	$search = array("'" ,"--");
    	$replace= array("''","-" );
		return str_replace($search,$replace,$campo);    	
    }
    
    private function obtenerOrganismos($userid)
    {
    	global $primary_db;
	    $org = "";
		$j=0;
		
        //Reviso los grupos del usurio logeado busco uno que diga organismo_
        if( isset($_SESSION['groups']) )
        {
            $partes = explode(",",strtolower($_SESSION['groups']));
            foreach($partes as $grupo)
            {
            	$grp = strtolower(trim($grupo));
                if(substr($grp,0,10)=="organismo_")
                {
                    $sigla = substr($grp,10);
                    
                    //Resuelvo sigla->codigo
        			$sql = "select tor_code from tic_organismos where tor_sigla='$sigla'";
                    $re = $primary_db->do_execute($sql);
                    $k=0;
			        while( $row=$primary_db->_fetch_array($re,$k++) )
        			{
			        	if($j>0)
			        	{
			        		$org.=",";
			        	}
			        	$org.=$row["tor_code"];
			        	$j++;
			        }
			        $primary_db->_free_result($re);
                }
            }
        }
        
        return $org;
    }  
}
?>