<?php 
class class_campania_hooks extends cclass_maint_hooks
{	
	/**
	 * Carga los valores de los parametros
	 *
	 * @return array
	 */	
	public function afterLoadDB() 
	{
		global $primary_db,$sess;
		$res = array();
		$obj = $this->m_data;
		
		//Cargo los dos parametros
		$cgpc = $sess->getParameter($primary_db,"cgpc");
		$barrio = $sess->getParameter($primary_db,"barrio");
		$tipo = $sess->getParameter($primary_db,"tipo_contacto");
		$estado = $sess->getParameter($primary_db,"estado_contacto");
		$desde = $sess->getParameter($primary_db,"desde_contacto");
		$hasta = $sess->getParameter($primary_db,"hasta_contacto");
		
		//Actualizo el estado...
		$obj->getField("tmp_cgpc")->setValue($cgpc);
		$obj->getField("tmp_barrio")->setValue($barrio);
		$obj->getField("tmp_tipo")->setValue($tipo);
		$obj->getField("tmp_estado")->setValue($estado);
		$obj->getField("tmp_fecha")->setValue($desde."H".$hasta);
		
		return $res; 
	}
	
	/**
	 * Salva el nuevo valor de los parametros
	 *
	 * @return array
	 */
	public function beforeSaveDB() 
	{ 
		//Paso la llamada a COMPLETADA
		global $primary_db,$sess;
		$res = array();
		$obj = $this->m_data;

		//Recupero el estado...
		$cgpc = $obj->getField("tmp_cgpc")->getValue();
		$barrio = $obj->getField("tmp_barrio")->getValue();
		$tipo = $obj->getField("tmp_tipo")->getValue();
		$estado = $obj->getField("tmp_estado")->getValue();
		
		$objfecha = $obj->getField("tmp_fecha");
		$fecha = $objfecha->m_DataHandler->getValue2();
		list($desde,$hasta) = explode("H",$fecha);
		
		$desde_arr = explode(" ",$desde);
		$hasta_arr = explode(" ",$hasta);

	
		//Persisto el estado en la base	
		$sess->setParameter($primary_db,"cgpc",$cgpc);
		$sess->setParameter($primary_db,"barrio",$barrio);
		$sess->setParameter($primary_db,"tipo_contacto",$tipo);
		$sess->setParameter($primary_db,"estado_contacto",$estado);
		$sess->setParameter($primary_db,"desde_contacto",$desde_arr[0]);
		$sess->setParameter($primary_db,"hasta_contacto",$hasta_arr[0]);
		
		return $res; 
	}
	
		
	/**
	 * Evita salvar el registro
	 */
	public function canSaveDB() 
	{ 
		return false; 
	}
}


?>
