<?php 
include_once "presentation/selectarray.php";

class CDH_ORGANISMO_TICKET extends CDH_SELECTARRAY 
{
	function __construct($parent) 
	{
		global $primary_db,$sess;
		parent::__construct($parent);
		
		//Completo el array con los organismos que poseea el usuario logeado
		$this->m_array = array();
		$this->m_array[0] = "Todos";
		
		$grupos = explode(",",$sess->groups);
		foreach($grupos as $grupo)
		{
			$gr = trim(strtolower($grupo));
			if( substr($gr,0,10)=="organismo_" )
			{
				$sigla = substr($gr,10,99);
				$sql = "select tor_code from tic_organismos where tor_sigla='$sigla'";
				$re = $primary_db->do_execute($sql);
				if( $row=$primary_db->_fetch_row($re) )
				{
					$this->m_array[$row['tor_code']] = $sigla;
				}
				$primary_db->_free_result($re);
			} 
		}
		
		$this->setValue(0);
	}		
	
	function RenderFilterForm($cn,$name="",$id="") 
	{
		$fld = $this->m_parent;
		$fld->m_search="no";
		if(count($this->m_array)==1)
		{
			$keys = array_keys($this->m_array);
			$val = $keys[0];
			$this->setValue($val);
			$this->m_parent->m_IsVisible = false;   
		}
		return parent::RenderFilterForm($cn,$name="",$id="");
	}
	
	
	//Limito la consulta al grupo elegido o bien al conjunto al cual puede acceder
	function objectFactoryQuery($relax) 
	{
		$fld = $this->m_parent;
		$val = $fld->getValue();
		$name = strtolower($fld->m_Name);
		
		//Hay un valor elegido?
		if($val!="0")
		{
			$sql=$name."=".$val;
		}
		else
		{
			//limito el acceso a los grupos habilitados
			$j=0;
			$lista = "";
			foreach($this->m_array as $key=>$val)
			{
				if($j>0)
				{
					$lista.=",";
				}
				$lista.=$key;
				$j++;
			}
			$sql=$name." IN(".$lista.")";	
		}
		
		$fld = null;
		return $sql;
	}
	
	
}
?>