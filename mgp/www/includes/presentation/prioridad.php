<?php 
include_once "presentation/selectarray.php";

/** 	Tipo de dato: Codigo de empresa cliente*/
class CDH_PRIORIDAD extends CDH_SELECTARRAY
{
	function __construct($parent) 
	{
		parent::__construct($parent);
		$fld = $this->m_parent;
		$this->m_array = array(
            "1"=>"1",
			"1.1"=>"1.1",
            "1.2"=>"1.2",
            "1.3"=>"1.3",
			"2"=>"2",
            "2.1"=>"2.1",
            "2.2"=>"2.2",
            "2.3"=>"2.3",
			"3"=>"3",
            "3.1"=>"3.1",
            "3.2"=>"3.2",
            "3.3"=>"3.3"
        );
	}
}
?>