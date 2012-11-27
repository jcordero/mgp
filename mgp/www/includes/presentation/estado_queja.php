<?php 
include_once "presentation/selectarray.php";

/** 	Tipo de dato: Codigo de empresa cliente*/
class CDH_ESTADO_QUEJA extends CDH_SELECTARRAY
{
	function __construct($parent) 
	{
		parent::__construct($parent);
		$fld = $this->m_parent;
		
		$this->m_array = array(
			"INICIADO"=>"INICIADA",
			"NOTIFICADA"=>"NOTIFICADA",
            "CUMPLIDA"=>"CUMPLIDA",
			"RECHAZADA"=>"RECHAZADA",
			"ABIERTAS"=>"ABIERTAS",
			"CERRADAS"=>"CERRADAS"
		);
		
		if( $fld->m_ClassParams=="operaciones")
		{
			$this->m_array = array(
				"NOTIFICADA"=>"NOTIFICADA",
	            "CUMPLIDA"=>"CUMPLIDA",
				"RECHAZADA"=>"RECHAZADA"
			);
		}
	}
	
	
	//Filtro el campo, tomando en cuenta los seuestados ABIERTAS y CERRADAS
	function objectFactoryQuery($relax) 
	{
		$fld = $this->m_parent;
		$val = $fld->getValue();
		$name = strtolower($fld->m_Name);
		
		//El tipo de dato, requiere el valor entre comillas?
		if($val=="ABIERTAS") 
		{
			$sql=$name." IN('INICIADO','NOTIFICADA')";
		} 
		elseif($val=="CERRADAS") 
		{
			$sql=$name." IN('CUMPLIDA','RECHAZADA')";
		} 
		else
		{
			$sql=$name."='".$val."'";
		}
		
		$fld = null;
		return $sql;
	}
		
}
?>