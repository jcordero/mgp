<?php 
include_once "common/cdatatypes.php";

class CDH_WEEK extends CDataHandler 
{
	function __construct($parent) 
	{
		parent::__construct($parent);
		$this->m_parent->m_search="fix";
	}

	//Dibujo el calendario
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
			//Seleccion de la clase (campo normal/campo obligatorio)
			$mandatory = ($fld->m_IsMandatory==true && $fld->m_IsReadOnly==false) ? "fldm" : "fld";
			
			//El campo es visible
			$html ="<div id=\"$fld->m_Name\" class=\"itm\">";
			$html.="	<div class=\"desc\">$fld->m_Label</div>";
			
			$html.="	<div class=\"$mandatory\">";
			$html.="		<div id=\"{$id}_nav\" class=\"week_nav\">
							</div>";
			$html.="		<div id=\"{$id}_week\" class=\"week_data\" ></div>";
			$html.="		<input type=\"hidden\" id=\"$id\" value=\"$val\" name=\"$name\"/>"."\n";
			$html.="	</div>"."\n"; //mandatory
			$html.="</div>"."\n"; //cierro itm
		} 	
		return $html;
	}
	
	function getJsIncludes()
	{	
		return array(
			'<script type="text/javascript" src="'.WEB_PATH.'/includes/presentation/week.js"></script>'
		);
	}
}
?>