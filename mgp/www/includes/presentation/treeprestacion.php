<?php 
include_once "presentation/tree.php";

class CDH_TREEPRESTACION extends CDH_TREE 
{	
	function __construct($parent) 
	{
		parent::__construct($parent);
		$this->m_js_main_search="chg_prestacion";
		$this->m_js_helper_search="chg_prestacion_h";
		$this->m_helper_sql="SELECT '(' + tpr_code + ') ' + tpr_detalle FROM tic_prestaciones WHERE tpr_code='<val>'";
		$this->m_fill_root_sql = "SELECT tpr_code,tpr_detalle FROM tic_prestaciones WHERE tpr_estado='ACTIVO' and (tpr_padre='' OR tpr_padre is null) order by tpr_detalle";
		$this->m_fill_branch_sql = "SELECT tpr_code,tpr_detalle FROM tic_prestaciones WHERE estado='ACTIVO' and tpr_padre='<val>' order by tpr_detalle";
	}
			
}
?>