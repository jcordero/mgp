<?php 
include_once "common/cdatatypes.php";


class CDH_PLAZO extends CDataHandler
{
	function __construct($parent) 
	{
		parent::__construct($parent);
		$fld = $this->m_parent;
		$fld->m_allow_blank=true;
	}
	
	public function RenderFilterForm($cn,$name="",$id="",$prefix="") 
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
			//val = campo compuesto 
			//val1 = plazo
			//val2 = unidad
			$lista = explode(' ', $val);
			$val1 = (isset($lista[0]) ? $lista[0] : "");
			$val2 = (isset($lista[1]) ? $lista[1] : "");
			$html ="<div id=\"$fld->m_Name\" class=\"itm\"><div class=\"desc\">$fld->m_Label</div><div class=\"fld\">";
					
			if($fld->m_IsReadOnly)
			{
				$html.="<INPUT TYPE=\"HIDDEN\" NAME=\"$name\" id=\"$id\" VALUE=\"$val\"/> $val";				
			}
			else
			{
                //Cantidad
                            $html.=" <INPUT TYPE=\"TEXT\" NAME=\"a$name\" id=\"a$id\" VALUE=\"$val1\" maxlength=\"15\" SIZE=\"15\" />";

                //Unidades
                            $html.="<SELECT NAME=\"b$name\" id=\"b$id\" />";
                            $html.="<OPTION value=\"Días\" ".($val2=="Días" ? "SELECTED" : "").">Días";
                            $html.="<OPTION value=\"Horas\" ".($val2=="Horas" ? "SELECTED" : "").">Horas";
                            $html.="<OPTION value=\"Minutos\" ".($val2=="Minutos" ? "SELECTED" : "").">Minutos";
                            $html.="</SELECT> ";
                //Tipo                
                            $html.="<SELECT NAME=\"c$name\" id=\"c$id\" />";
                            $html.="<OPTION value=\"CORRIDOS\" ".($val2=="CORRIDOS" ? "SELECTED" : "").">Corridos";
                            $html.="<OPTION value=\"LABORALES\" ".($val2=="LABORALES" ? "SELECTED" : "").">Laborales";
                            $html.="</SELECT> ";
			
            }
			$html.="</div></div>"."\n";
		}
		return $html;
	}
	
	function loadForm() 
	{
            $fld = $this->m_parent;
            $val1 = "";
            $val2 = "";
            $val3 = "";
            if($fld->m_no_form==false) 
            {
                $val = (isset($_REQUEST["m_".$fld->m_Name]) ? $_REQUEST["m_".$fld->m_Name] : "");
                $val1 = (isset($_REQUEST["am_".$fld->m_Name]) ? $_REQUEST["am_".$fld->m_Name] : "");
                $val2 = (isset($_REQUEST["bm_".$fld->m_Name]) ? $_REQUEST["bm_".$fld->m_Name] : "");
                $val3 = (isset($_REQUEST["cm_".$fld->m_Name]) ? $_REQUEST["cm_".$fld->m_Name] : "");

                //Combino los campos
                if($val1!="" && $val2!="" && $val3!="")
                {
                    $fld->setValue($val1." ".$val2." ".$val3);
                }
                elseif($val1!="")
                {
                    $fld->setValue($val1);
                }
                elseif($val!="")
                {
                    $fld->setValue($val);
                }
                else
                {
                    $fld->setValue("");
                }
            }
	}
	
}
?>