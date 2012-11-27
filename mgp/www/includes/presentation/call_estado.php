<?php 
include_once "presentation/selectarray.php";

/** 	Tipo de dato: Codigo de empresa cliente*/
class CDH_CALL_ESTADO extends CDH_SELECTARRAY
{
	function __construct($parent) 
	{
		parent::__construct($parent);
		$fld = $this->m_parent;
		$this->m_array = array(
			"PENDIENTE"		=>"PENDIENTE",
			"COMPLETADA"	=>"COMPLETADA",
			"REINTENTAR"	=>"REINTENTAR",
			"EN CURSO"		=>"EN CURSO",
			"CANCELADA" 	=>"CANCELADA",
			"BLOQUEADA" 	=>"BLOQUEADA"            
		);
	}
		
}
?>