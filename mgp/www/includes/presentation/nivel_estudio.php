<?php 
include_once "presentation/selectarray.php";

/** 	Tipo de dato: Codigo de empresa cliente*/
class CDH_NIVEL_ESTUDIO extends CDH_SELECTARRAY 
{
	function __construct($parent) 
	{
		parent::__construct($parent);
		$fld = $this->m_parent;
		$this->m_array = array(
			"PRIMARIOS"=>"PRIMARIOS",
			"SECUNDARIOS"=>"SECUNDARIOS",
			"TECIARIOS"=>"TECIARIOS",
		    "UNIVERSITARIOS"=>"UNIVERSITARIOS",
		);
	}
		
}
?>