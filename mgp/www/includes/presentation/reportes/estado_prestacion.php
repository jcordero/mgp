<?php
include_once "presentation/selectarray.php";

class CDH_ESTADO_PRESTACION extends CDH_SELECTARRAY 
{
    function __construct($parent) 
    {
        parent::__construct($parent);
        $this->m_array = array(
            'pendiente'             =>  "pendiente",
            'inspección'            =>  "inspección",
            'en curso'              =>  "en curso",
            'en espera'             =>  "en espera",
            'resuelto'              =>  "resuelto",
            'rechazado'             =>  "rechazado",
            'rechazado indebido'    =>  "rechazado indebido",
            'cerrado'               =>  "cerrado",
            'finalizado'            =>  "finalizado",
            'certificación'         =>  "certificación"
        );
    }
        
        
    function RenderReadOnly($cn,$showlabel=false)
    {
        $fld = $this->m_parent;
        $html="";
        $val = $fld->getValue();
        $mostrar = "";

        if($fld->m_IsVisible)
        {   
            switch($val) {
                case 'pendiente':
                case 'inspección':
                case 'certificación':
                    $mostrar = "<span class='label label-info'>{$val}</span>";
                    break;
                case 'en curso':
                case 'en espera':
                    $mostrar = "<span class='label label-warning'>{$val}</span>";
                    break;
                case 'resuelto':
                case 'cerrado':
                case 'finalizado':
                    $mostrar = "<span class='label label-success'>{$val}</span>";
                    break;
                case 'rechazado':
                case 'rechazado indebido':
                    $mostrar = "<span class='label label-inverse'>{$val}</span>";
                    break;
                default:
                    $mostrar = $val;
            }

            if($showlabel)
            {
                $html.="<div class=\"itm\"><div class=\"desc\">$fld->m_Label</div><div class=\"fldro\">$mostrar</div></div>"."\n";
            }
            else
            {
                $html.=$mostrar;
            }
        }
		
        return $html;
    }
}