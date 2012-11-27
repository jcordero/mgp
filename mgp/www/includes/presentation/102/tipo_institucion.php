<?php 
include_once "presentation/selectarray.php";

class CDH_TIPO_INSTITUCION extends CDH_SELECTARRAY
{
	function __construct($parent) 
	{
		parent::__construct($parent);
		$fld = $this->m_parent;
		$this->m_array = array(
            "PERSONA FISICA"=>"PERSONA FISICA",
            "ONG"			=>"ONG",
            "PUBLICA"		=>"PUBLICA",
			"PARROQUIA"		=>"PARROQUIA"
        );
	}
}
?>