<?php
include_once "presentation/selectarray.php";

class CDH_CANAL extends CDH_SELECTARRAY 
{
	function __construct($parent) 
	{
            parent::__construct($parent);
            $this->m_array = array(
                "call"          =>  "call",
                "internet"      =>  "internet",
                "movil"         =>  "movil",
                "presencial"    =>  "presencial"
            );
        }
}