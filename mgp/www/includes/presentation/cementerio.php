<?php 
include_once "presentation/selectarray.php";

class CDH_CEMENTERIO extends CDH_SELECTARRAY 
{
	function __construct($parent) 
	{
		global $primary_db;
		parent::__construct($parent);
		
		$parent->m_js_click = "chg_cementerio(this)";

        //Completo el array con la lista de los cementerios 
		$sql="SELECT tge_nombre,tge_otra_denominacion FROM tic_georef WHERE tge_tipo='CEMENTERIO'";
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
		return '<script type="text/javascript" src="'.WEB_PATH.'/includes/presentation/cementerio.js"></script>';
	}
	
	function getCementerioDetails($cementerio)
    {
        global $primary_db;

        //Datos de la prestacion
        $sql = "SELECT tge_coordx,tge_coordy,tge_cgpc,tge_barrio,tge_calle,tge_calle_nombre,tge_altura FROM tic_georef WHERE tge_tipo='CEMENTERIO' AND tge_nombre='$cementerio'";
        $re = $primary_db->do_execute($sql);
        $conjunto = array();
        while( $row=$primary_db->_fetch_row($re) )
        {
            $conjunto[] =  $row;
        }

        return json_encode($conjunto);
    }
	
}
?>