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
		$mostrar = "";
		
		if($fld->m_IsVisible)
		{
            $obj = json_decode($val);

            if($obj) {
            	$mostrar .= ($obj->calle_nombre!='' ? 'Calle: '.$obj->calle_nombre.' '.$obj->callenro.'<br/>' : '');
            	$mostrar .= ($obj->piso!='' ? 'Piso: '.$obj->piso : ''); 
            	$mostrar .= ($obj->dpto!='' ? 'Departamento:'.$obj->dpto.'<br/>' : '');
            	$mostrar .= ($obj->barrio!='' ? 'Barrio: '.$obj->barrio : '');
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