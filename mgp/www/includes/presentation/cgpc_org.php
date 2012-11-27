<?php 
include_once "presentation/selectarray.php";

/** 	Tipo de dato: Codigo de empresa cliente*/
class CDH_CGPC_ORG extends CDH_SELECTARRAY 
{
	function __construct($parent) 
	{
		parent::__construct($parent);
		$fld = $this->m_parent;
		$this->m_array = array(
			"1"=>"CGPC 1",
			"2"=>"CGPC 2",
			"3"=>"CGPC 3",
			"6"=>"CGPC 4",
			"5"=>"CGPC 5",
			"7"=>"CGPC 6",
			"8"=>"CGPC 7",
			"9"=>"CGPC 8",
			"10"=>"CGPC 9",
			"11"=>"CGPC 10",
			"12"=>"CGPC 11",
			"13"=>"CGPC 12",
			"14"=>"CGPC 13",
			"15"=>"CGPC 14",
			"16"=>"CGPC 15"	);
	}
		
}
?>