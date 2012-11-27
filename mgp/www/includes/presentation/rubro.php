<?php 
include_once "presentation/select.php";

/** 	Tipo de dato: Codigo de empresa cliente*/
class CDH_RUBRO extends CDH_SELECT
{
	function __construct($parent) 
	{
		parent::__construct($parent);
		$fld = $this->m_parent;
		
		$this->m_fill_sql = "select tru_detalle,tru_code from tic_rubros where tru_estado='ACTIVO' order by tru_detalle";
        
		$this->m_helper_sql="SELECT CONCAT('(',CAST(tru_code AS CHAR CHARACTER SET latin1 ),') ',tru_detalle) as tru_detalle FROM tic_rubros WHERE tru_code='<val>'";
	}
	
	function RenderFilterForm($cn,$name="",$id="",$prefix="") 
	{
		if($this->m_parent->m_ClassParams=="no_fill")
		{
			$this->m_fill_sql = "";
		}
		return parent::RenderFilterForm($cn,$name,$id);
	}
}
?>