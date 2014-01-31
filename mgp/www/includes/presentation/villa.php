<?php 
include_once "presentation/selectarray.php";

class CDH_VILLA extends CDH_SELECTARRAY 
{
	function __construct($parent) 
	{
		global $primary_db;
		parent::__construct($parent);
		
		$parent->m_js_click = "chg_villa(this)";

        //Completo el array con la lista de la villas 
		$sql="SELECT tge_nombre,tge_otra_denominacion FROM tic_georef WHERE tge_tipo='VILLA'";
		$re = $primary_db->do_execute($sql);
		$j=0;
		while( $row=$primary_db->_fetch_array($re,$j++) )
		{
			//Hay valores alternativos?
			if($row[1]!="")
			{
				$this->m_array[$row[0]] = $row[0]." (".$row[1].")";
			}
			else
			{
				$this->m_array[$row[0]] = $row[0];
			}
		}
		$primary_db->_free_result($re);
	} 
		
	function getJsIncludes()
	{	
		return '<script type="text/javascript" src="'.WEB_PATH.'/includes/presentation/villa.js"></script>';
	}
	
	function getVillaDetails($villa)
    {
        global $primary_db;

        //Datos de la prestacion
        $sql = "SELECT tge_coordx,tge_coordy,tge_cgpc,tge_barrio,tge_calle,tge_calle_nombre,tge_altura FROM tic_georef WHERE tge_tipo='VILLA' AND tge_nombre='$villa'";
        $re = $primary_db->do_execute($sql);
        $conjunto = array();
        while( $row=$primary_db->_fetch_row($re) )
        {
            $conjunto[] =  $row;
        }

        return json_encode($conjunto,JSON_UNESCAPED_UNICODE);
    }
	
}
?>