<?php 
include_once "presentation/selectarray.php";

/** 	Tipo de dato: Codigo de empresa cliente*/
class CDH_UBICACION extends CDH_SELECTARRAY
{
	function __construct($parent) 
	{
		parent::__construct($parent);
		
                $this->m_array = array(
                    "DOMICILIO"     =>  "DOMICILIO",
                    "LUMINARIA"     =>  "LUMINARIA",
                    "CEMENTERIO"    =>  "CEMENTERIO",
                    "ORGAN.PUBLICO" =>  "ORGAN.PUBLICO",
                    "PLAZA"         =>  "PLAZA",
                    "VILLA"         =>  "VILLA"
        );
	}
}
?>