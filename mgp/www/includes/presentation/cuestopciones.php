<?php 
include_once "presentation/selectarray.php";

class CDH_CUESTOPCIONES extends CDH_SELECTARRAY
{
	function __construct($parent) 
	{
            parent::__construct($parent);
            $this->m_array = array(
                "TEXTO"     =>  "TEXTO",
                "LISTA"     =>  "LISTA",
                "MULTIPLE"  =>  "MULTIPLE",
                "CHECKBOX"  =>  "CHECKBOX"
            );
	}
}
?>