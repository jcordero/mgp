<?php 
include_once "presentation/selectarray.php";

/** 	Tipo de dato: Codigo de empresa cliente*/
class CDH_CGPC extends CDH_SELECTARRAY 
{
	function __construct($parent) 
	{
		parent::__construct($parent);
		$fld = $this->m_parent;
		$this->m_array = array(
			"Comuna 1"=>"Comuna 1",
			"Comuna 2"=>"Comuna 2",
			"Comuna 3"=>"Comuna 3",
			"Comuna 4"=>"Comuna 4",
			"Comuna 5"=>"Comuna 5",
			"Comuna 6"=>"Comuna 6",
			"Comuna 7"=>"Comuna 7",
			"Comuna 8"=>"Comuna 8",
			"Comuna 9"=>"Comuna 9",
			"Comuna 10"=>"Comuna 10",
			"Comuna 11"=>"Comuna 11",
			"Comuna 12"=>"Comuna 12",
			"Comuna 13"=>"Comuna 13",
			"Comuna 14"=>"Comuna 14",
			"Comuna 15"=>"Comuna 15"	);
	}
		
}
?>