<?php 
include_once "presentation/selectarray.php";

/** 	Tipo de dato: Codigo de empresa cliente*/
class CDH_ORGANISMOTIPO extends CDH_SELECTARRAY
{
	function __construct($parent) 
	{
		parent::__construct($parent);
		$fld = $this->m_parent;
		$this->m_array = array(
            "COMISARIA"=>"COMISARIA",
            "HOSPITAL"=>"HOSPITAL",
            "CGPC"=>"CGPC",
            "EMPRESA"=>"EMPRESA",
            "GOBIERNO"=>"GOBIERNO"
        );
	}
}
?>