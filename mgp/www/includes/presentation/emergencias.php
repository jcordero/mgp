<?php 
include_once "presentation/selectarray.php";

/** 	Tipo de dato: Codigo de empresa cliente*/
class CDH_EMERGENCIAS extends CDH_SELECTARRAY
{
	function __construct($parent) 
	{
		parent::__construct($parent);
		$fld = $this->m_parent;
		$this->m_array = array(
            "911"=>"911 Policia y Bomberos",
            "103"=>"103 Guardia de auxilio",
            "107"=>"107 SAME Ambulancias",
            "108"=>"108 Atención Social"
        );
	}
}
?>