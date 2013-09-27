<?php 
include_once "presentation/select.php";

class CDH_NACIONALIDAD extends CDH_SELECT 
{
	function __construct($parent) 
	{
		parent::__construct($parent);
		$this->m_parent->m_search="fix";
		$this->m_fill_sql="SELECT val_value, val_value FROM cat_value WHERE vli_code='NACIONALIDAD' ORDER BY val_order,val_value";
	}
}

?>
