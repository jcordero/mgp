<?php 
include_once "presentation/tree.php";

/** 	Tipo de dato: Codigo de empresa cliente*/
class CDH_ARBOL extends CDH_TREE
{
	function __construct($parent) 
	{
		parent::__construct($parent);
		$fld = $this->m_parent;
		$this->m_ajax_call = "ARBOL";
		$this->m_fill_root_sql 		= "select tpr_detalle,tpr_code from tic_prestaciones where CHAR_LENGTH(tpr_code)=2 order by tpr_detalle";
		$this->m_fill_branch_sql	= "select tpr_detalle,tpr_code from tic_prestaciones where CHAR_LENGTH(tpr_code)=CHAR_LENGTH('<val>')+2 and tpr_code like '<val>%' order by tpr_detalle";
	}
}
?>