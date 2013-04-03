<?php 
include_once "common/cdatatypes.php";

class CDH_ORGANISMO extends CDataHandler 
{
	function __construct($parent) 
	{
		parent::__construct($parent);
        $fld = $this->m_parent;
		$fld->m_search="fix";
		$this->m_js_main_search="chg_organismo";
		$this->m_js_helper_search="chg_organismo_h";
        $fld->m_js_totext = "chg_organismo_t";
		$this->m_use_helper=true;
		$this->m_hide_helper=false;
		$this->m_helper_sql="SELECT tor_nombre FROM tic_organismos WHERE tor_code='<val>'";
	}
		
	function getJsIncludes()
	{	
		return '<script type="text/javascript" src="'.WEB_PATH.'/includes/presentation/organismo.js"></script>';
	}

    function getList($description)
    {
        global $primary_db;

        $sql = "SELECT tor_code,tor_nombre FROM tic_organismos WHERE tor_nombre like '%".$description."%' or tor_sigla like '%".$description."%' ORDER BY 2";
        $re = $primary_db->do_execute($sql);
        $conjunto = array();
        while( $row=$primary_db->_fetch_row($re) )
        {
            $conjunto[] =  $row;
        }
        return json_encode($conjunto);
    }

    function getCodeDescription($code)
    {
        global $primary_db;

        $sql = "SELECT tor_code,tor_nombre FROM tic_organismos WHERE tor_code='".$code."'";
        $re = $primary_db->do_execute($sql);
        $conjunto = array();
        while( $row=$primary_db->_fetch_row($re) )
        {
            $conjunto[] = $row;
        }
        return json_encode($conjunto);
    }
}
?>