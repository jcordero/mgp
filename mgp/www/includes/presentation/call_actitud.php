<?php 
include_once "presentation/selectarray.php";

/** 	Tipo de dato: Codigo de empresa cliente*/
class CDH_CALL_ACTITUD extends CDH_SELECTARRAY
{
	function __construct($parent) 
	{
		parent::__construct($parent);
		$fld = $this->m_parent;
		$this->m_array = array(
			"POSITIVA"	=>"POSITIVA",
			"NEUTRAL"	=>"NEUTRAL",
            "NEGATIVA"	=>"NEGATIVA"
		);
	}
		
}
?>