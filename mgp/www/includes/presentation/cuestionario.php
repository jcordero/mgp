<?php 
include_once "common/cdatatypes.php";

//El cuestionario es armado dinamicamente por el objeto de prestaciones al seleccionar una prestacion

class CDH_CUESTIONARIO extends CDataHandler
{
	function __construct($parent)
    {
		parent::__construct($parent);
		$fld = $this->m_parent;

	}
	
    // Dibujo el cuestionario 
	function RenderFilterForm($cn,$name="",$id="",$prefix="") 
	{
		$html = "";
		$fld = $this->m_parent;
		$xml = trim($fld->getValue());
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
			$html.="<input type=\"hidden\" NAME=\"$name\" id=\"$id\" VALUE=\"$xml\"/>"."\n";

            //DIV para insertar el Cuestionario
            $html.='<div id="'.$id.'_placeholder"></div>'."\n"; 
		} 
	
		return $html;
	}
    
    
	//Creo el cuestionario XML a partir del formulario recibido
    function loadForm()
	{
        global $primary_db;
		$fld = $this->m_parent;

        if(!isset($_REQUEST["m_".$fld->m_ClassParams]))
        {
            //Al cargar el formulario por primera vez, este campo esta en blanco
            $fld->setValue("");
            return;
        }

        $prestacion = $_REQUEST["m_".$fld->m_ClassParams];
        if($prestacion=="")
        {
            $fld->setValue("");
            return;
        }

        //Proceso cuestionario
        $sql = "SELECT tpr_preg,tpr_tipo_preg,tpr_opciones FROM tic_prestaciones_cuest WHERE tpr_code='$prestacion'";
        $re = $primary_db->do_execute($sql);
        $q = 1;
        $result = '<?xml version="1.0" encoding="UTF-8"?>';
        $result.= '<cuestionarioresultado>';
        while( $myrow=$primary_db->_fetch_row($re) )
        {
            $result.= '<cuestion>';
            $result.= '<orden>'.$q.'</orden>';
            $result.= '<tipo>'.$myrow['tpr_tipo_preg'].'</tipo>';
            $result.= '<pregunta>'.$myrow['tpr_preg'].'</pregunta>';

            //Proceso la(s) respuesta(s) a la pregunta
            $res = "";
            if( isset($_REQUEST['cuest_'.$q]) )
            {
                if( is_array($_REQUEST['cuest_'.$q]) )
                {
                    foreach($_REQUEST['cuest_'.$q] as $rsp)
                    {
                        $res.= $rsp.'|';
                    }
                }
                else
                {
                    $res = $_REQUEST['cuest_'.$q];
                }
            }
            $result.= '<respuesta>'.$res.'</respuesta>';
            $result.= '</cuestion>';

            $q++;
        }
        $result.= '</cuestionarioresultado>';
        $fld->setValue($result);
	}

    
	//Caso que el cuestionario este en una vista solo lectura
    function RenderReadOnly($cn,$showlabel=false)
	{
		$fld = $this->m_parent;
		$html="";
		$val = $fld->getValue();
		$name = "m_".$fld->m_Name;

		if($fld->m_IsVisible)
		{
            $mostrar = $this->convertToHtml($val);

			if($showlabel)
			{
				$html="<div class=\"itm\"><div class=\"desc\">$fld->m_Label</div><div class=\"fldro\">$mostrar</div></div>"."\n";
			}
			else
			{
				$html=$mostrar;
			}
		}
		else
		{
            //Campo oculto
			$id = $name;
			$html="<input type=\"hidden\" name=\"$name\" id=\"$id\" value=\"$val\"/>"."\n";
		}

		return $html;
	}


	//Caso de que el campo este en el area de edicion de una tabla
    function RenderTableEdit($cn,$frmname,$table="",$row=0,$ro=false,$name="",$suffix="")
	{
		$fld = $this->m_parent;

		if($name=="")
		{
			$name = $this->getName($table,$row);
		}

		if($frmname=="")
		{
			$id = $name;
		}
		else
		{
			$id = $frmname."_".$name;
		}

		//Compongo el valor del campo
		$xml = $fld->getValue();
        $mostrar = $this->convertToHtml($xml);

		//Si es read only, pongo el valor del campo dentro un HIDDEN, si no muestro el campo editable
		if($ro)
		{
			$html="<input type=\"hidden\" name=\"$name\" id=\"$id\" value=\"".htmlentities($xml,ENT_COMPAT,"UTF-8")."\"/>";

			//Si es read-only y visible, muestro un texto (si es invisible no muestro nada)
			if($fld->m_IsVisible)
			{
				$html.="<div id=\"t$name\">$mostrar</div>";
			}
			$html.="\n";
		}
		else
		{
			//El campo es editable, se usa para editar un registro
			//Anulo la funcion de busqueda flexible asi no sale el indicador
			$fld->m_search="fix";
			$html = $this->RenderFilterForm($cn,$name,$id,$id);
		}
		
		return $html;
	}


    //Convierto el cuestionario en HTLM para poder mostrarlo en el formulario de consulta
	private function convertToHtml($xml_string)
    {
		if($xml_string=="")
		{
			return "";
		}
    	
    	$xmldoc = new DOMDocument();
        $xsldoc = new DOMDocument();
        $xslproc = new XSLTProcessor();
        $xmldoc->loadXML($xml_string);
        $xsl = HOME_PATH."www/includes/presentation/cuestionario.xsl";

        //Cargo el template
        $xsldoc->load($xsl);
        $xslproc->importStyleSheet($xsldoc);

        //Hago la transformacion
        $html = $xslproc->transformToXML($xmldoc);
        
        return $html;

    }


}
?>