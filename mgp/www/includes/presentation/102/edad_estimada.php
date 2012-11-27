<?php 
include_once "presentation/selectarray.php";

class CDH_EDAD_ESTIMADA extends CDH_SELECTARRAY
{
	function __construct($parent) 
	{
		parent::__construct($parent);
		$fld = $this->m_parent;
		$this->m_array = array(
            "CONOCIDA"	=>"CONOCIDA",
            "0 a 4"		=>"0 a 4",
            "5 a 9"		=>"5 a 9",
            "10 a 12"	=>"10 a 12",
            "13 a 15"	=>"13 a 15",
			"16 a 17"	=>"16 a 17",
			"18 y más"	=>"18 y más"	
		);
	}
}
?>