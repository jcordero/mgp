<?php 
include_once "common/cdatatypes.php";


class CDH_DOCID extends CDataHandler 
{
	function __construct($parent) 
	{
		parent::__construct($parent);
		$fld = $this->m_parent;
		$fld->m_allow_blank=true;
        $fld->m_js_initial = "IniciarDocID";
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
			$html ="<div id=\"$fld->m_Name\" class=\"itm\"><div class=\"desc\">$fld->m_Label</div><div class=\"fld\">";
					
			if($fld->m_IsReadOnly)
			{
				$html.="<input type=\"hidden\" name=\"$name\" id=\"$id\" value=\"$val\"/> $val";				
			}
			else
			{
				//Tipo de documento
				$html.="<SELECT NAME=\"a$name\" id=\"a$id\">";
				$html.="<OPTION value=\"DNI\" ".($val1=="DNI" ? "SELECTED" : "").">DNI";
				$html.="<OPTION value=\"LE\" ".($val1=="LE" ? "SELECTED" : "").">LE";
				$html.="<OPTION value=\"LC\" ".($val1=="LC" ? "SELECTED" : "").">LC";
				$html.="<OPTION value=\"CIPF\" ".($val1=="CIPF" ? "SELECTED" : "").">CIPF";
				$html.="<OPTION value=\"PAS\" ".($val1=="PAS" ? "SELECTED" : "").">PAS";
				$html.="<OPTION value=\"CI\" ".($val1=="CI" ? "SELECTED" : "").">CI";
/*				$html.="<OPTION value=\"CUIT\" ".($val1=="CUIT" ? "SELECTED" : "").">CUIT";
				$html.="<OPTION value=\"CUIL\" ".($val1=="CUIL" ? "SELECTED" : "").">CUIL";*/
				$html.="</SELECT> ";
				$html.=" <input type=\"text\" name=\"b$name\" id=\"b$id\" value=\"$val2\" maxlength=\"15\" size=\"12\" />";

                if($fld->m_ClassParams!="no_search")
                {
                    $html.=" <IMG src=\"".WEB_PATH."/images/default/bt_go.gif\" onclick=\"chg_docid('$id')\" border=\"0\"> ";
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
			$val1 = (isset($_REQUEST["am_".$fld->m_Name]) ? $_REQUEST["am_".$fld->m_Name] : "");
			$val2 = (isset($_REQUEST["bm_".$fld->m_Name]) ? $_REQUEST["bm_".$fld->m_Name] : "");
			
			//Combino los dos campos, el tipo y el nro de documento
			if($val1!="" && $val2!="")
			{
				$fld->setValue($val1." ".$val2);
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
	
	function getJsIncludes()
	{	
		return '<script type="text/javascript" src="'.WEB_PATH.'/includes/presentation/docid.js"></script>';
	}

//Hago una busqueda sobre el padron
    function doBuscar($params)
    {
        global $primary_db;

        $partes = explode('|',$params);
        if(count($partes)==2)
        {
            $tipo_doc = $partes[0];
            $doc= $partes[1];
        }

        //No hay datos para buscar...
        if($doc=='')
        {
            return json_encode(array());
        }

        $sql = "SELECT tipo_doc,matricula,sexo,apellido,nombre,domicilio,profesion FROM pad_padron WHERE matricula='$doc'";
        $re = $primary_db->do_execute($sql);
        $conjunto = array();
        while( $row=$primary_db->_fetch_row($re) )
        {
            $conjunto[] = $row;
        }

        return json_encode($conjunto);
    }

}
?>