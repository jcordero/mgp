<?php 
include_once "presentation/selectarray.php";

class CDH_CALL_ESTADO2 extends CDH_SELECTARRAY
{
	function __construct($parent) 
	{
		parent::__construct($parent);
		$fld = $this->m_parent;
		$this->m_array = array(
			"COMPLETADA"=>"COMPLETADA",
			"REINTENTAR"=>"REINTENTAR",
			"EN CURSO"	=>"EN CURSO",
			"CANCELADA" =>"CANCELADA"            
		);
	}
		
}
?>