<?php 
include_once "presentation/selectarray.php";

/** 	Tipo de dato: Codigo de empresa cliente*/
class CDH_FLAG extends CDH_SELECTARRAY 
{
	function __construct($parent) 
	{
		parent::__construct($parent);
		$fld = $this->m_parent;
		$this->m_array = array("0"=>"NO","1"=>"SI");
	}
		
	function getJsIncludes()
	{	
		return '';
	}
}
?>