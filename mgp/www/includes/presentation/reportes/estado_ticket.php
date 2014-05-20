<?php

include_once "presentation/selectarray.php";

class CDH_ESTADO_TICKET extends CDH_SELECTARRAY {

    function __construct($parent) {
        parent::__construct($parent);
        $this->m_array = array(
            "ABIERTO" => "ABIERTO",
            "CERRADO" => "CERRADO",
        );
    }

    private function badge($estado) {
        $mostrar = "";
        switch ($estado) {
            case 'ABIERTO':
                $mostrar = "<span class='badge badge-info'>{$estado}</span>";
                break;
            case 'CERRADO':
                $mostrar = "<span class='badge badge-success'>{$estado}</span>";
                break;
            default:
                $mostrar = $estado;
        }
        return $mostrar;
    }

    function RenderTableEdit($cn, $frmname, $table = "", $row = 0, $ro = false, $name = "", $suffix = "") {
        $fld = $this->getCField();
        if($ro || $fld->isReadOnly()) {
            return $this->RenderReadOnly($cn,true);
        }
        
        $val = $fld->getValue();
        $fld->setValue($this->badge($val));
        $ret = parent::RenderTableEdit($cn, $frmname, $table, $row, $ro, $name, $suffix);
        $fld->setValue($val);
        return $ret;
    }

    function RenderReadOnly($cn, $showlabel = false) {
        $fld = $this->getCField();
        $val = $fld->getValue();
        $fld->setValue($this->badge($val));
        $ret = parent::RenderReadOnly($cn, $showlabel);
        $fld->setValue($val);
        return $ret;
    }
    
}
