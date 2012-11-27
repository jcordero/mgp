<?php 
include_once "presentation/selectarray.php";

class CDH_PRESTACION_TICKET extends CDH_SELECTARRAY 
{
	function __construct($parent) 
	{
		global $primary_db;
		parent::__construct($parent);
		$this->m_parent->m_search="fix";
		
		//Completo el array con todas las prestaciones que contiene el ticket
		$this->m_array = array();
		
		$this->m_helper_sql="SELECT CONCAT('(',tpr_code,') ',tpr_detalle) as detalle FROM tic_prestaciones WHERE tpr_code='<val>'";
	}
				
	
	function getHelperValue($cn,$val)
	{
		global $primary_db;
		
		if(count($this->m_array)==0)
		{
			$fld = $this->m_parent;
			if($fld->m_ClassParams!="")
			{
				$partes = explode("|",$fld->m_ClassParams);
				$data_obj = $fld->m_parent;
				if(count($partes)==3)
				{
					$nro = $data_obj->getField($partes[0])->getValue();
					$anio = $data_obj->getField($partes[1])->getValue();
					$tipo = $data_obj->getField($partes[2])->getValue();
					
					$sql = "select pr.tpr_code, pr.tpr_detalle from tic_ticket_prestaciones tp join tic_prestaciones pr on tp.tpr_code=pr.tpr_code where tic_nro=$nro and tic_anio=$anio and tic_tipo='$tipo'";
					$j=0;
					$re = $primary_db->do_execute($sql);
					while( $row = $primary_db->_fetch_array($re,$j++) )
					{
						$this->m_array[$row[0]] = $row[1];
					}
					$primary_db->_free_result($re);
				}	
			}	
		}	
		return parent::getHelperValue($cn,$val);
	}
}
?>