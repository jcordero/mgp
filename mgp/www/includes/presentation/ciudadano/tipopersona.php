<?php 
include_once "presentation/selectarray.php";

class CDH_TIPOPERSONA extends CDH_SELECTARRAY {
	function __construct($parent) {
		parent::__construct($parent);
		$fld = $this->m_parent;
		$this->m_array = array("FISICA"=>"FISICA","JURIDICA"=>"JURIDICA");
		$fld->m_js_click = "chg_tipopersona(this)";
		$fld->m_js_initial = "init_tipopersona";
	}
	
	function getJsIncludes()
	{	
		$inc = parent::getJsIncludes();
		return $inc.'<script type="text/javascript" src="'.WEB_PATH.'/includes/presentation/ciudadano/tipopersona.js"></script>';
	}
}
?>