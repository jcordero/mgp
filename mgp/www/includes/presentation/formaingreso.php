<?php 
include_once "presentation/selectarray.php";

/** 	Tipo de dato: Codigo de empresa cliente*/
class CDH_FORMAINGRESO extends CDH_SELECTARRAY 
{
	function __construct($parent) 
	{
		parent::__construct($parent);
		$fld = $this->m_parent;
		$this->m_array = array("0"=>"TELEFONO","1"=>"FAX","2"=>"MOSTRADOR","3"=>"EMAIL","4"=>"INTERNET");
	}
		
	function getJsIncludes()
	{	
		return '';
	}
}
?>