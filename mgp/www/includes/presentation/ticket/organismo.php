<?php 
include_once "presentation/select.php";

class CDH_ORGANISMO extends CDH_SELECT 
{
	function __construct($parent) 
	{
            parent::__construct($parent);
            $fld = $this->m_parent;
            $this->m_fill_sql = "SELECT tor_nombre,tor_code FROM tic_organismos ORDER BY 1";
            $this->m_helper_sql = "SELECT tor_nombre FROM tic_organismos WHERE tor_code='<val>'";
            
	}
}