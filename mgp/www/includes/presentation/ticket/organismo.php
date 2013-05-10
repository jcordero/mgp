<?php 
include_once "presentation/autocomplete.php";

class CDH_ORGANISMO extends CDH_AUTOCOMPLETE 
{
	function __construct($parent) 
	{
            parent::__construct($parent);
            $fld = $this->m_parent;
            $this->m_options_sql = "SELECT tor_nombre,tor_code FROM tic_organismos WHERE tor_nombre like '%<val>%'";
            $this->m_helper_sql = "SELECT tor_nombre FROM tic_organismos WHERE tor_code='<val>'";
            
	}
}
?>