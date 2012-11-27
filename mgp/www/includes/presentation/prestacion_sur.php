<?php 
include_once "common/cdatatypes.php";

class CDH_PRESTACION_SUR extends CDataHandler 
{
	function __construct($parent) 
	{
		parent::__construct($parent);
		$this->m_parent->m_search="fix";
		$this->m_parent->m_cols = 60;
		$this->m_js_main_search="chg_prestacion";
		$this->m_js_helper_search="chg_prestacion_h";
		$this->m_use_helper=true;
		$this->m_helper_sql="SELECT '('+convert(varchar,codigo)+') '+detalle as detalle FROM prestaciones WHERE codigo='<val>'";
		
	}
		
	function objectFactoryQuery($relax) 
	{
		$fld = $this->m_parent;
		$type = strtoupper($fld->m_Type);
		$val = $fld->getValue();
		$name = strtolower($fld->m_Name);

		if(strlen($val)==2)
		{
			$sql = $name." like '".$val."%'";
		}
		else
		{
			$sql = $name."='".$val."'";
		}
		return $sql;
	}	
	
	function getJsIncludes()
	{	
		return '<script type="text/javascript" src="'.WEB_PATH.'/includes/presentation/prestacion.js"></script>';
	}
	
	function getList($description)
    {
        global $primary_db;

        $sql = "SELECT codigo as tpr_code,detalle as tpr_detalle FROM prestaciones WHERE detalle like '%".$description."%' ORDER BY 2";
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

        $sql = "SELECT codigo as tpr_code, detalle as tpr_detalle FROM prestaciones WHERE codigo='".$code."'";
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