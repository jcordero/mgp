<?php 
include_once "common/cdatatypes.php";

class CDH_DIRECCION extends CDataHandler
{
	function __construct($parent) 
	{
		parent::__construct($parent);
	
	}

    //Mostrar el XML de la direccion
    function RenderReadOnly($cn,$showlabel=false)
	{
		$fld = $this->m_parent;
		$html="";
		$val = html_entity_decode( $fld->getValue() );
		$name = "m_".$fld->m_Name;

		if($fld->m_IsVisible)
		{
            //Convierto el XML de la georeferencia en algo entendible por el usuario
            $xmldoc = new DOMDocument();
            $xsldoc = new DOMDocument();
            $xslproc = new XSLTProcessor();
            if(!$xmldoc->loadXML($val))
            {
            	error_log("CDH_DIRECCION error de parseo del xml para: $val");
            }

            //Que tipo de GeoRef esta usando?
            $direcciones = $xmldoc->getElementsByTagName("direccion");
            $cant = $direcciones->length; 
            if( $cant > 0)
            {
            	$tipo = $direcciones->item(0)->firstChild->nodeName;
	            $xsl = HOME_PATH."www/includes/georef/".$tipo.".xsl";

    	        //Cargo el template
        	    $xsldoc->load($xsl);
            	$xslproc->importStyleSheet($xsldoc);

            	//Hago la transformacion
            	$mostrar = $xslproc->transformToXML($xmldoc);
            }
            else
            {
            	$mostrar = "";
            }
            
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
	
	function RenderTableEdit($cn,$frmname,$table="",$row=0,$ro=false,$name="",$suffix="") 
	{
		return parent::RenderTableEdit($cn,$frmname,$table="",$row=0,$ro=false,$name="",$suffix="");	
	}

	function RenderFilterForm($cn,$name="",$id="",$suffix="") 
	{
		return $this->RenderReadOnly($cn,true);
		//return parent::RenderFilterForm($cn,$name="",$id="",$suffix="");
	}
	
}
?>