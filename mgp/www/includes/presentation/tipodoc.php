<?php 
include_once "presentation/selectarray.php";

/** 	Tipo de dato: Codigo de empresa cliente*/
class CDH_TIPODOC extends CDH_SELECTARRAY 
{
	function __construct($parent) 
	{
		parent::__construct($parent);
		$fld = $this->m_parent;
		$this->m_array = array("CI"=>"CI","DNI"=>"DNI","LC"=>"LC","LE"=>"LE","PAS"=>"PAS","PREC"=>"PREC");
	}
		
}
?>