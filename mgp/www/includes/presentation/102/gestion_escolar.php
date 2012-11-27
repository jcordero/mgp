<?php 
include_once "presentation/selectarray.php";

class CDH_GESTION_ESCOLAR extends CDH_SELECTARRAY
{
	function __construct($parent) 
	{
		parent::__construct($parent);
		$fld = $this->m_parent;
		$this->m_array = array(
            "NACIONAL"	=>"NACIONAL",
            "MUNICIPAL"	=>"MUNICIPAL",
            "PRIVADA"	=>"PRIVADA"
        );
	}
}
?>