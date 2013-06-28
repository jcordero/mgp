<?php
include_once "presentation/selectarray.php";

class CDH_ESTADO_TICKET extends CDH_SELECTARRAY 
{
	function __construct($parent) 
	{
            parent::__construct($parent);
            $this->m_array = array(
                "ABIERTO" => "ABIERTO",
                "CERRADO" => "CERRADO",
            );
        }
}