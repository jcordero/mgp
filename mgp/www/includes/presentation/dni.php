<?php 
include_once "common/cdatatypes.php";


class CDH_DNI extends CDataHandler {
	function __construct($parent) {
		parent::__construct($parent);
		$fld = $this->m_parent;
		$fld->m_allow_blank=true;
		$fld->m_js_validate = "valDNI";
		if($fld->m_ClassParams!="")
		{
			$this->m_js_main_search="chg_dni";
		}
		$fld->m_cols = 20;
	}
	
	function getJsIncludes()
	{	
		return '<script type="text/javascript" src="'.WEB_PATH.'/includes/presentation/dni.js"></script>';
	}
}
?>