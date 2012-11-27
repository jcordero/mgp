<?php 
include_once "common/cdatatypes.php";

/** 	Tipo de dato: Codigo de empresa cliente*/
class CDH_ALTURA extends CDataHandler 
{
	function __construct($parent) 
	{
		parent::__construct($parent);
		$this->m_parent->m_search="fix";
		$this->m_js_main_search="chg_altura";
	}
		
	function getJsIncludes()
	{	
		return '<script type="text/javascript" src="'.WEB_PATH.'/includes/presentation/altura.js"></script>';
	}
}
?>