<?php 
include_once "common/cdatatypes.php";

// PAIS TIPO NUMERO

class CDH_DNI extends CDataHandler {
	function __construct($parent) {
		parent::__construct($parent);
		$fld = $this->m_parent;
		$fld->m_allow_blank=true;
		$fld->m_js_validate = "valDNI";
		$fld->m_js_totext = "toTextDNI";
		$fld->m_js_tovalue = "toTextDNI";
		$fld->m_js_edit = "editDNI";
		$this->m_js_main_search="chg_dni";
	}
	
	public function RenderFilterForm($cn,$name="",$id="",$pre="")
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
			$html.="<input type=\"hidden\" name=\"$name\" id=\"$id\" value=\"$val\"/>";
		}
		else
		{
			//val = campo compuesto
			//val1 = tipo de documento
			//val2 = numero de documento
			$lista = explode(' ', $val);
			$val1 = (isset($lista[0]) ? $lista[0] : "");
			$val2 = (isset($lista[1]) ? $lista[1] : "");
			$val3 = (isset($lista[2]) ? $lista[2] : "");
			
			$html ="<div id=\"$fld->m_Name\" class=\"itm\">
			<div class=\"desc\">$fld->m_Label</div>
			<div class=\"fld\">
				<input type=\"hidden\" name=\"$name\" id=\"$id\" value=\"$val\"/>";
	
			if($fld->m_IsReadOnly)
			{
				$html.=" $val";
			}
			else
			{
				//Pais
				$html.="<select name=\"p{$name}\" id=\"p{$id}\">";	
				$rs = $cn->do_execute("SELECT cpa_code, cpa_descripcion FROM ciu_paises ORDER BY 2");
				while($row=$cn->_fetch_row($rs)) {
					$html.="<option value=\"{$row['cpa_code']}\" ".($val1==$row['cpa_code'] ? "selected" : "").">".$row['cpa_descripcion'];
				}	
				$html.="</select> ";
				
				//Tipo de documento
				$html.="<select name=\"t{$name}\" id=\"t{$id}\">";
				$html.="<option value=\"DNI\" ".($val2=="DNI" ? "selected" : "").">DNI";
				$html.="<option value=\"LE\"  ".($val2=="LE"  ? "selected" : "").">LE";
				$html.="<option value=\"LC\"  ".($val2=="LC"  ? "selected" : "").">LC";
				$html.="<option value=\"PAS\" ".($val2=="PAS" ? "selected" : "").">PAS";
				$html.="<option value=\"CI\"  ".($val2=="CI"  ? "selected" : "").">CI";
				$html.="<option value=\"PRE\" ".($val2=="PRE" ? "selected" : "").">PRE";
				$html.="</select> ";
				
				//Nro de documento
				$html.=" <input type=\"text\" name=\"n{$name}\" id=\"n{$id}\" value=\"{$val3}\" maxlength=\"15\" size=\"12\" />";
	
				if($fld->m_ClassParams!="no_search")
				{
					$html.=" <img src=\"".WEB_PATH."/images/default/bt_go.gif\" onclick=\"chg_docid('$id')\" border=\"0\"> ";
				}
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
		if($fld->m_no_form==false)
		{
			$val = (isset($_REQUEST["m_".$fld->m_Name]) ? $_REQUEST["m_".$fld->m_Name] : "");
			$val1 = (isset($_REQUEST["pm_".$fld->m_Name]) ? $_REQUEST["pm_".$fld->m_Name] : "");
			$val2 = (isset($_REQUEST["tm_".$fld->m_Name]) ? $_REQUEST["tm_".$fld->m_Name] : "");
			$val3 = (isset($_REQUEST["nm_".$fld->m_Name]) ? $_REQUEST["nm_".$fld->m_Name] : "");
			
			//Combino los dos campos, el tipo y el nro de documento
			if($val1!="" && $val2!="" && $val3!="")
			{
				$fld->setValue($val1." ".$val2." ".$val3);
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
	
	function getJsIncludes()
	{
		return '<script type="text/javascript" src="'.WEB_PATH.'/includes/presentation/ciudadano/dni.js"></script>';
	}
}
?>