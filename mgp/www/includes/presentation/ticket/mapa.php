<?php

include_once "common/cdatatypes.php";

/** 	Despliega un mapa de la direccion ingresada
 * 
 *      Descarga el mapa desde /common/mapa.php
 *      Origen del mapa: usig
 *      Cache local en: /plataforma4/sites/xxxx/cache
 */
class CDH_MAPA extends CDataHandler {

    function __construct($parent) {
        parent::__construct($parent);
        $fld = $this->m_parent;
        $fld->m_js_initial = "IniciarMapa";
    }

    /** Genera el HTML que se usa en una vista solo lectura
     * 
     * @param cdbdata $cn
     * @param boolean $showlabel
     * @return string
     */
    function RenderReadOnly($cn, $showlabel = false) {
        $fld = $this->m_parent;
        $html = "";
        $name = $this->getName("", "");
        $id = $name;

        if ($fld->m_IsVisible) {
            $mapa = '<div id="'.$id.'"></div>';

            if ($showlabel) {
                $html   .="<div id=\"{$fld->m_Name}\" class=\"form-group input-sm\">"
                            . "<label class=\"col-xs-3 control-label\" for=\"{$id}\">{$fld->m_Label}</label>"
                            . "<div class=\"input-group col-xs-9\">$mapa</div>"
                        . "</div>";
            } else {
                $html.=$mapa;
            }
        }

        return $html;
    }

    /**
     * Genera un campo para mostrar dentro de una tabla, ajusta el nombre en consecuencia 
     * Esta funcion la usa ctable_maint para mostrar el contenido de las tablas
     *
     * @param cdbdata $cn
     * @param string $frmname
     * @param string $table
     * @param int $row
     * @param boolean $ro
     * @param string $name
     * @param string $suffix
     * @return string
     */
    function RenderTableEdit($cn, $frmname, $table = "", $row = 0, $ro = false, $name = "", $suffix = "") {
        $fld = $this->m_parent;
        $html = "";

        if ($name == "") {
            $name = $this->getName($table, $row);
        }
        if ($frmname == "") {
            $id = $name;
        } else {
            $id = $frmname . "_" . $name;
        }

        //Si es read only, pongo el valor del campo dentro un HIDDEN, si no muestro el campo editable
        //if ($ro) {
            $mapa   = '<div id="' . $id . '"></div>';
            $html   .="<div id=\"{$fld->m_Name}\" class=\"form-group input-sm\">"
                            . "<label class=\"col-xs-3 control-label\" for=\"{$id}\">{$fld->m_Label}</label>"
                            . "<div class=\"input-group col-xs-9\">$mapa</div>"
                        . "</div>";
        //} else {
            //El campo es editable, se usa para editar un registro
            //Anulo la funcion de busqueda flexible asi no sale el indicador
           // $fld->m_search = "fix";
            //$html.= $this->RenderFilterForm($cn, $name, $id, null);
        //}
        return $html;
    }

    /**
     * Funcion para generar el contenido a mostrar dentro de un formulario. 
     * Se usa para el Form primario y para editar los registros de cada tabla 
     * Para usar en filtro de campos de un formulario
     *
     * @param cdbdata $cn
     * @param string $name
     * @param string $id
     * @param string $suffix
     * @return string
     */
    function RenderFilterForm($cn, $name = "", $id = "", $suffix = "") {
        $html = "";

        //Nombre del campo
        if ($name == "") {
            $name = $this->getName();
        }
        //ID del campo, usado en los scripts
        if ($id == "") {
            $id = $name;
        }
        
        $html.= '<div id="' . $id . '"></div>';
        return $html;
    }

    function getJsIncludes() {
        return array(
            '<script src="http://maps.googleapis.com/maps/api/js?v=3.14&sensor=false" type="text/javascript"></script>',
            '<script type="text/javascript" src="' . WEB_PATH . '/includes/presentation/ticket/mapa.js"></script>'
        );
    }

}

