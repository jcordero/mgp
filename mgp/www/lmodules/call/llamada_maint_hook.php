<?php 
class ccal_queue_hooks extends cclass_maint_hooks
{
	public $m_save = true;
	
	/**
	 * Actualiza el registro para que otro operador no tome la misma llamada
	 *
	 * @return array
	 */	
	public function afterLoadDB() 
	{
		global $primary_db,$sess;
		
		$res = array();
		$obj = $this->m_data;
		$op = $this->m_parent->m_OP;
		$cqu_estado  	= $obj->getField("cqu_estado")->getValue();
		$use_code  		= $obj->getField("use_code")->getValue();
		$cqu_codigo 	= $obj->getField("cqu_codigo")->getValue();
		
		error_log("afterLoadDB -> Operacion: $op Estado: $cqu_estado Operador: $use_code Llamada: $cqu_codigo ");
		
		//Ya esta en curso? (El cambio de estado se aplica solo para el estado M)
		if($op=="M")
		{
			if($cqu_estado=="EN CURSO" && $use_code!=$sess->user_id && $use_code!="")
			{
				$err[] = "MENSAJE: Esta llamada ya esta siendo procesada por otro operador.";
				$this->m_save = false;	
			}
			elseif($cqu_estado=="PENDIENTE")
			{
				//Actualizo el estado...
				$obj->getField("cqu_estado")->setValue("EN CURSO");
				$sql = "update cal_queue set cqu_estado='EN CURSO', cqu_egreso_fecha=NOW(), use_code={$sess->user_id} where cqu_codigo={$cqu_codigo}";
				$primary_db->do_execute($sql);
			}
			elseif($cqu_estado=="EN CURSO") {
				$sql = "update cal_queue set cqu_egreso_fecha=NOW(), use_code={$sess->user_id} where cqu_codigo={$cqu_codigo}";
				$primary_db->do_execute($sql);
			}
		}
		return $res; 
	}
	
		
	/**
	 * Evita salvar el registro si hay problemas
	 *
	 * @return boolean
	 */
	public function canSaveDB() 
	{ 
		return $this->m_save; 
	}
	
	/**
	 * 
	 * Si completo la llamada meto el numero dentro de la lista negra.
	 */
	public function afterSaveDB()
    {
    	global $primary_db;
    	$content = array();
    	$err = array();
		$obj = $this->m_data;
		
		$cqu_estado  	= $obj->getField("cqu_estado")->getValue();
		$nro_fijo  		= $obj->getField("cqu_tel_fijo")->getValue();
		$nro_movil  	= $obj->getField("cqu_tel_movil")->getValue();
		$cqu_nombre  	= $obj->getField("cqu_nombre")->getValue();
		$use_code		= $obj->getField("use_code")->getValue();
    	if($cqu_estado=="COMPLETADA")
    	{
    		//Salvo el numero de telefono para bloquear todas las llamadas pendientes a este numero por 30 dias
    		$params = array(
    			"cll_codigo" => $primary_db->Sequence("cal_llamados"), 	
    			"cqu_tel_fijo" => $nro_fijo, 
    			"cqu_tel_movil" => $nro_movil, 
    			"use_code" => $use_code, 
    			"cqu_nombre" => $cqu_nombre);
    		$primary_db->do_execute("insert into cal_llamados(cll_codigo,cqu_tel_fijo,cqu_tel_movil,cll_fecha,use_code,cqu_nombre) values(:cll_codigo:,':cqu_tel_fijo:',':cqu_tel_movil:',NOW(),':use_code:',':cqu_nombre:')",$err,$params);
    		
    		//Bloqueo todos los contactos pendientes de esta persona, con la fecha de llamada
    		$primary_db->do_execute("update cal_queue set cqu_bloqueado=NOW(),cqu_estado='BLOQUEADA' where cqu_estado='PENDIENTE' and ( cqu_tel_movil in ('$nro_fijo','$nro_movil') or cqu_tel_fijo in ('$nro_fijo','$nro_movil')");
    	}
    	
    	return array($content,$err);
    } 
}

?>
