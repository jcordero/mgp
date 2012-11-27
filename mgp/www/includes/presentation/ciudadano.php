<?php 
include_once "common/cdatatypes.php";

class CDH_CIUDADANO extends CDataHandler
{
	function __construct($parent) 
	{
		parent::__construct($parent);
		$fld = $this->m_parent;
        $this->m_parent->m_search="fix";
		$this->m_parent->m_cols = 60;
        $this->m_use_helper=true;
        $this->m_helper_sql="SELECT IFNULL( CONCAT(ciu_apellido,', ',ciu_nombres),'Anonimo') FROM ciu_ciudadanos WHERE ciu_code='<val>'";
	}
}
?>