<?php 
include_once "presentation/selectarray.php";

/** 	Tipo de dato: Codigo de empresa cliente*/
class CDH_CALL_RESULTADO extends CDH_SELECTARRAY
{
	function __construct($parent) 
	{
		parent::__construct($parent);
		$fld = $this->m_parent;
		$this->m_array = array(
			"CONFORME"=>"CONFORME",
			"NO CONFORME"=>"NO CONFORME",
            "NO SABE"=>"NO SABE"           
		);
		$fld->m_js_click = "call_resultado_change(this)";
	}	
}
?>