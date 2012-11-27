<?php 
include_once "presentation/select.php";

class CDH_SERVICIO extends CDH_SELECT 
{
	function __construct($parent) 
	{
		parent::__construct($parent);		
		$parent->m_js_click = "chg_servicio(this)";
		$parent->m_js_initial = "init_servicio";
		//$this->m_helper_sql = "select sag_agenda,sag_codigo from sig_agenda where sag_codigo='<val>'";
	} 
		
	function getJsIncludes()
	{	
		return array(
			parent::getJsIncludes(),
			'<script type="text/javascript" src="'.WEB_PATH.'/includes/presentation/servicio.js"></script>');
	}
	
	
}
?>