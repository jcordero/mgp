<?php 
include_once "common/cdatatypes.php";

/** 	Tipo de dato: Codigo de empresa cliente*/
class CDH_DURACION extends CDataHandler
{
	function __construct($parent) 
	{
		parent::__construct($parent);
		$this->m_parent->m_search="fix";
	}
		
	public function RenderFilterForm($cn,$name="",$id="")
	{
		if($name=="")
		{
			$name=$this->getName();
		}
		if($id=="")
		{
			$id=$name;
		}
		$fld = $this->m_parent;
		$val = $this->getValue();


        if(!$fld->m_IsVisible)
		{
			$html.="<INPUT TYPE=\"HIDDEN\" NAME=\"$name\" id=\"$id\" VALUE=\"$val\"/>";
		}
		else
		{
			$html ="<div id=\"$fld->m_Name\" class=\"itm\"><div class=\"desc\">$fld->m_Label</div><div class=\"fld\">";

			if($fld->m_IsReadOnly)
			{
                //Convierto los segundos a minutos:segundos
                $minutos = intval(intval($val)/60);
                $segundos = intval($val) - $minutos*60;

				$html.="<INPUT TYPE=\"HIDDEN\" NAME=\"$name\" id=\"$id\" VALUE=\"$val\"/> $minutos:$segundos";
			}
			else
			{
				$html.=" <INPUT TYPE=\"TEXT\" NAME=\"$name\" id=\"$id\" VALUE=\"$val\" maxlength=\"15\" SIZE=\"15\" />";
            }
			$html.="</div></div>"."\n";
		}
		return $html;
	}
}
?>