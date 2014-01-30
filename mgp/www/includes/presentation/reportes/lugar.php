<?php 
include_once "common/cdatatypes.php";
include_once "beans/functions.php";
include_once "beans/georeferencias.php";

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
        
        $geo = new georeferencias();
        $geo->load($val);
        $html = $geo->generarTextoDireccion();
        
        return $html;
    }
}