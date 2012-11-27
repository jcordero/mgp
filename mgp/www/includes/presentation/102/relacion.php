<?php 
include_once "presentation/selectarray.php";

class CDH_RELACION extends CDH_SELECTARRAY
{
	function __construct($parent) 
	{
		parent::__construct($parent);
		$fld = $this->m_parent;
		$this->m_array = array(
            "DIRECTA"		=>"DIRECTA",
            "TUTOR"			=>"TUTOR",
			"FAMILIAR"		=>"FAMILIAR",
            "SIN RELACION"	=>"SIN RELACION"
        );
	}
}
?>