<?php

include_once "common/cdatatypes.php";
include_once "beans/functions.php";

class CDH_RECLAMANTE extends CDataHandler {

    function __construct($parent) {
        parent::__construct($parent);
    }

    function RenderReadOnly($cn, $showlabel = false) {
        global $primary_db;
        $fld = $this->m_parent;
        $html = "";
        $val = $fld->getValue();
        $reclamante = str_replace("\n", "<br>", $this->getHelperValue($primary_db, $val));

        if ($fld->m_IsVisible) {
            if ($showlabel) {
                $html.=   "<div id=\"{$fld->m_Name}\" class=\"form-group input-sm\">"
                        . " <label class=\"col-xs-3 control-label\" for=\"l{$fld->m_Name}\">{$fld->m_Label}</label>"
                        . " <div class=\"input-group col-xs-9\">"
                        . "     <p class=\"form-control-static\" id=\"l{$fld->m_Name}\">{$reclamante}</p>"
                        . " </div>"
                        . "</div>\n";
            } else {
                $html.=$reclamante;
            }
        }

        return $html;
    }

    function RenderTableEdit($cn, $frmname, $table = "", $row = 0, $ro = false, $name = "", $suffix = "") {
        return parent::RenderTableEdit($cn, $frmname, $table = "", $row = 0, $ro = false, $name = "", $suffix = "");
    }

    function RenderFilterForm($cn, $name = "", $id = "", $suffix = "") {
        return $this->RenderReadOnly($cn, true);
    }

    function getHelperValue($cn, $val) {
        $tic_nro = intval($val, 10);

        //Traigo los datos del primer ciudadano
        $sql = "select ciu_nombres,ciu_apellido,ciu_tel_movil,ciu_tel_fijo,ciu_email from ciu_ciudadanos ciu join tic_ticket_ciudadano tic on ciu.ciu_code=tic.ciu_code where tic.tic_nro = {$tic_nro} limit 1";
        $row = $cn->QueryArray($sql);
        if ($row) {
            return "{$row['ciu_nombres']} {$row['ciu_apellido']}\n{$row['ciu_tel_movil']} {$row['ciu_tel_fijo']}\n{$row['ciu_email']}";
        } else {
            return "";
        }
    }

}
