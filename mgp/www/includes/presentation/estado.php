<?php 
include_once "presentation/selectarray.php";

/** 	Tipo de dato: Codigo de empresa cliente*/
class CDH_ESTADO extends CDH_SELECTARRAY 
{
	function __construct($parent) 
	{
		parent::__construct($parent);
		$fld = $this->m_parent;
		$this->m_array = array(
			"0"=>"INICIADO",
			"50"=>"NOTIFICADO",
			"70"=>"VERIFICADO",
			"90"=>"EN TRAMITE",
			"95"=>"DERIVADO",
			"100"=>"CUMPLIDO",
			"110"=>"DENEGADO");
	}
}
?>