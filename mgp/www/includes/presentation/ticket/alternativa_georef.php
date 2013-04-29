<?php 
include_once "presentation/selectarray.php";

/** 	Tipo de dato: Codigo de empresa cliente*/
class CDH_ALTERNATIVA_GEOREF extends CDH_SELECTARRAY
{
	function __construct($parent) 
	{
            parent::__construct($parent);

            $this->m_array = array(
                "NRO"   =>  "Calle y número de puerta",
                "CALLE" =>  "Calle y calle que cruza",
            );
	}
}
?>