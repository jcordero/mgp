<?php 
include_once "common/cdatatypes.php";


class CDH_LUGAR extends CDataHandler
{
    function __construct($parent) 
    {
        parent::__construct($parent);
    }

    // {"tipo":"DOMICILIO","alternativa":"NRO","calle_nombre":"DIAGONAL OMBU","calle":"00793","callenro":3886,"piso":null,"dpto":null,"nombre_fantasia":"","barrio":"SANTA MONICA","comuna":"","lat":-38.008072825648,"lng":-57.576713640079,"calle_nombre2":"","calle2":""}
    public function getValue() 
    {
        $fld = $this->m_parent;
        $val = $fld->readValue();
        $html = '';
        $obj = json_decode($val);
        
        //Parte de la calle
        if($obj->alternativa=='CALLE') {
            $html.=$obj->calle_nombre.' y '.$obj->calle_nombre2;
        }
        else
        {
            $html.=$obj->calle_nombre.' '.$obj->callenro;
        }
        
        //Parte de piso y departamento
        if(isset($obj->piso) && $obj->piso!='')
            $html.='<br><b>Piso</b> '.$obj->piso;
        
        if(isset($obj->dpto) && $obj->dpto!='')
            $html.=' <b>Dpto</b> '.$obj->dpto;
        
        //Parte de luminaria
        if(isset($obj->id_luminaria) && $obj->id_luminaria!='')
            $html.='<br><b>Luminaria</b> '.$obj->id_luminaria;
        
        return $html;
    }
	

}
?>