<?php 
include_once "presentation/selectarray.php";

/** 	Tipo de dato: Codigo de empresa cliente*/
class CDH_CGPC_COMUNA extends CDH_SELECTARRAY 
{
	function __construct($parent) 
	{
		parent::__construct($parent);
		$fld = $this->m_parent;
		$this->m_array = array(
			"Comuna 1" => "CGPC 1",
			"Comuna 2" => "CGPC 2",
			"Comuna 3" => "CGPC 3",
			"Comuna 4" => "CGPC 4",
			"Comuna 5" => "CGPC 5",
			"Comuna 6" => "CGPC 6",
			"Comuna 7" => "CGPC 7",
			"Comuna 8" => "CGPC 8",
			"Comuna 9" => "CGPC 9",
			"Comuna 10" => "CGPC 10",
			"Comuna 11" => "CGPC 11",
			"Comuna 12" => "CGPC 12",
			"Comuna 13" => "CGPC 13",
			"Comuna 14" => "CGPC 14",
			"Comuna 15" => "CGPC 15"	);
	}
		
}
?>