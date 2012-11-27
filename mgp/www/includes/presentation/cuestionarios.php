<?php 
include_once "presentation/select.php";

class CDH_CUESTIONARIOS extends CDH_SELECT 
{
	function __construct($parent) 
	{
		parent::__construct($parent);		
		//$parent->m_js_click = "chg_agenda(this)";
		$this->m_fill_sql = "select scu_nombre,scu_codigo from sig_cuestionarios order by scu_nombre ";
	} 
		
	
	
}
?>