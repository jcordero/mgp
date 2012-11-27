<?php 
include_once "common/cdatatypes.php";

class CDH_PRESTACIONPADRE extends CDataHandler 
{
	function __construct($parent) 
	{
		parent::__construct($parent);
		$this->m_parent->m_search="fix";
		$this->m_parent->m_cols = 5;
		$this->m_use_helper=false;
		$this->m_helper_sql="SELECT CONCAT('(',CAST(tpr_code AS CHAR CHARACTER SET latin1 ),') ',tpr_detalle) as detalle FROM tic_prestaciones WHERE tpr_code='<val>'";		
	}
		
	function objectFactoryQuery($relax) 
	{
		$fld = $this->m_parent;
		$type = strtoupper($fld->m_Type);
		$val = $fld->getValue();
		$name = strtolower($fld->m_Name);
		$classparams = strtolower($fld->m_ClassParams);
			
		$sql = ($classparms!="" ? $classparms: $name)." like(".$val."%)";
		return $sql;
	}	
}
?>