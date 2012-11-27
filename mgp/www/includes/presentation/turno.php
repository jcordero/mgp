<?php 
include_once "common/cdatatypes.php";

/** 	Tipo de dato: Codigo de empresa cliente*/
class CDH_TURNO extends CDataHandler 
{
	function __construct($parent) 
	{
		parent::__construct($parent);
	}

	function RenderFilterForm($cn,$name="",$id="") 
	{
		$html = "";
		$fld = $this->m_parent;
		$val = trim($fld->getValue());
		if($name=="") 
		{
			$name=$this->getName();
		}
		
		if($id=="")	
		{
			$id=$name;
		}
		
		if($fld->m_IsVisible==false)
		{
			//El campo esta invisible...
			$html.="<input type=\"hidden\" name=\"$name\" id=\"$id\" value=\"$val\"/>"."\n"; 
		}
		else
		{			
			//El campo es visible
			$html ="
			<div id=\"$fld->m_Name\" class=\"itm\">
				<div class=\"desc\">$fld->m_Label</div>
				<div class=\"$mandatory\">
					<div id=\"tabla_turnos\"></div>
				</div>
			</div>\n";
		} 
	
		return $html;
	}
	
}
?>