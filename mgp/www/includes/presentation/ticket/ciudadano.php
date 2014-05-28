<?php

include_once "common/cdatatypes.php";
include_once "beans/functions.php";

class CDH_CIUDADANO extends CDataHandler {

    function __construct($parent) {
        parent::__construct($parent);
    }

    function RenderReadOnly($cn, $showlabel = false) {
        global $primary_db;
        $fld = $this->m_parent;
        $val = $fld->getValue();
        $fld->setValue( str_replace("\n", "<br>", $this->getHelperValue($primary_db, $val)) );

        $html = parent::RenderReadOnly($cn, $showlabel);
        $fld->setValue( $val );
                
        return $html;
    }

    function RenderTableEdit($cn, $frmname, $table = "", $row = 0, $ro = false, $name = "", $suffix = "") {
        return parent::RenderTableEdit($cn, $frmname, $table, $row, $ro, $name, $suffix);
    }

    function RenderFilterForm($cn, $name = "", $id = "", $suffix = "") {
        global $primary_db;
        $fld = $this->m_parent;
        $val = $fld->getValue();
        $fld->setValue( str_replace("\n", "<br>", $this->getHelperValue($primary_db, $val)) );

        $html = parent::RenderReadOnly($cn, $showlabel);
        $fld->setValue( $val );
    
        return $html;
    }

    function getHelperValue($cn, $val) {
        $ciu_code = intval($val, 10);
        $fld = $this->getCField();
        
        //Traigo los datos del primer ciudadano
        $sql = "select ciu_nombres,ciu_apellido,ciu_tel_movil,ciu_tel_fijo,ciu_email ".
                "from ciu_ciudadanos where ciu_code='{$ciu_code}' limit 1";
        $row = $cn->QueryArray($sql);
        if ($row) {
            $alt = "{$row['ciu_nombres']} {$row['ciu_apellido']}\n{$row['ciu_tel_movil']} {$row['ciu_tel_fijo']}\n{$row['ciu_email']}";
            $fld->writeAltValue($alt);
            return $alt;
        } else {
            $fld->writeAltValue("");
            return "";
        }
    }

}
