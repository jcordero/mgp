<?php 
include_once "presentation/selectarray.php";

class CDH_CALL_NOCONFORME extends CDH_SELECTARRAY
{
	function __construct($parent) 
	{
		parent::__construct($parent);
		$fld = $this->m_parent;
		
		$this->m_array = array(
			"NO CUMPLIDO"							=>"NO CUMPLIDO",
			"SERVICIO INCOMPLETO O MAL REALIZADO"	=>"SERVICIO INCOMPLETO O MAL REALIZADO",
			"SERVICIO NO REALIZADO POR EL GCBA"		=>"SERVICIO NO REALIZADO POR EL GCBA",
            "DEMORA EN EL CUMPLIMIENTO"				=>"DEMORA EN EL CUMPLIMIENTO"
		);
	}
}
?>