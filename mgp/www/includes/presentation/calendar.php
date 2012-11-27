<?php 
include_once "common/cdatatypes.php";

class CDH_CALENDAR extends CDataHandler 
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
			$html.="<div class=\"desc\">$fld->m_Label</div>";
			$html.="<div class=\"$mandatory\">";
			$html.="<div id=\"{$id}_cal\"></div>";
			$html.="<input type=\"hidden\" id=\"$id\" value=\"$val\" name=\"$name\"/>"."\n";
			$html.="<script	type=\"text/javascript\">"."\n";
			$html.="	var obj_{$id} = createCalendar(\"{$id}_cal\",\"$id\");"."\n";
			
			if($fld->m_js_click!="")
			{
				$html.="	function  calendar_onclick(obj) {";
				$html.="		{$fld->m_js_click}(obj);";
				$html.="	}"."\n";
			}			
			$html.="</script>"."\n";
			$html.="<div class='calendar_height'></div>";
			$html.="</div>"."\n";
			$html.="</div>"."\n";
		} 
	
		return $html;
	}
	
	
	function getJsIncludes()
	{	
		return array(
			'<link rel="stylesheet" type="text/css" href="'.WEB_PATH.'/common/yui/build/calendar/assets/skins/sam/calendar.css">',
			'<script type="text/javascript" src="'.WEB_PATH.'/common/yui/build/yahoo-dom-event/yahoo-dom-event.js"></script>',
			'<script type="text/javascript" src="'.WEB_PATH.'/common/yui/build/calendar/calendar-min.js"></script>',
			'<script type="text/javascript" src="'.WEB_PATH.'/includes/presentation/calendar.js"></script>'
		);
	}
}
?>