<?php

include_once "presentation/selectarray.php";

class CDH_ESTADO_PRESTACION extends CDH_SELECTARRAY {

    function __construct($parent) {
        parent::__construct($parent);
        $this->m_array = array(
            'pendiente' => "pendiente",
            'inspección' => "inspección",
            'en curso' => "en curso",
            'en espera' => "en espera",
            'resuelto' => "resuelto",
            'rechazado' => "rechazado",
            'rechazado indebido' => "rechazado indebido",
            'cerrado' => "cerrado",
            'finalizado' => "finalizado",
            'certificación' => "certificación"
        );
    }

    function RenderReadOnly($cn, $showlabel = false) {
        $fld = $this->getCField();
        $val = $fld->getValue();
        $fld->setValue($this->badge($val));
        $ret = parent::RenderReadOnly($cn, $showlabel);
        $fld->setValue($val);
        return $ret;
    }

    /*
      function RenderFilterForm($cn, $name = "", $id = "", $prefix = "") {
      $fld = $this->getCField();
      $fld->setValue("nuevo valor");

      return parent::RenderFilterForm($cn, $name, $id);
      }
     */

    function RenderTableEdit($cn, $frmname, $table = "", $row = 0, $ro = false, $name = "", $suffix = "") {
        $fld = $this->getCField();
        $val = $fld->getValue();
        $fld->setValue($this->badge($val));
        $ret = parent::RenderTableEdit($cn, $frmname, $table, $row, $ro, $name, $suffix);
        $fld->setValue($val);
        return $ret;
    }

    private function badge($estado) {
        $mostrar = "";
        switch ($estado) {
            case 'pendiente':
                $mostrar = "<span class='badge badge-danger'>{$estado}</span>";
                break;
            case 'inspección':
            case 'certificación':
                $mostrar = "<span class='badge badge-info'>{$estado}</span>";
                break;
            case 'en curso':
            case 'en espera':
                $mostrar = "<span class='badge badge-warning'>{$estado}</span>";
                break;
            case 'resuelto':
            case 'cerrado':
            case 'finalizado':
                $mostrar = "<span class='badge badge-success'>{$estado}</span>";
                break;
            case 'rechazado':
            case 'rechazado indebido':
                $mostrar = "<span class='badge badge-inverse'>{$estado}</span>";
                break;
            default:
                $mostrar = $estado;
        }
        return $mostrar;
    }

}
