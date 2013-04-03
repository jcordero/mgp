<?php 
include_once "presentation/autocomplete.php";

class CDH_CALLE extends CDH_AUTOCOMPLETE 
{
	function __construct($parent) 
	{
		parent::__construct($parent);
		$this->m_options_sql = "select gca_descripcion,gca_codigo from geo_calles where gca_descripcion like '%<val>%' order by 1";
	}
}
?>