<?php 
include_once "common/cdatatypes.php";

class CDH_CALLE extends CDataHandler 
{
	function __construct($parent) 
	{
		parent::__construct($parent);
		$this->m_parent->m_search="fix";
		$this->m_js_main_search="chg_calle";
		$this->m_js_helper_search="chg_calle_h";
//		$this->m_use_helper=true;
//		$this->m_hide_helper=true;
	}
	
	function setValue($newValue) 
	{
		error_log("CDH_CALLE => Cambio Calle a $newValue");
		$this->m_parent->writeValue($newValue);
	}
		
	function getJsIncludes()
	{	
		return '<script type="text/javascript" src="'.WEB_PATH.'/includes/presentation/calle.js"></script>';
	}
}
?>