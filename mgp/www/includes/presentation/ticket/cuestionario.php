<?php

include_once "common/cdatatypes.php";

//El cuestionario es armado dinamicamente por el objeto de prestaciones al seleccionar una prestacion

class CDH_CUESTIONARIO extends CDataHandler {

    function __construct($parent) {
        parent::__construct($parent);
    }

    /**
     * Dibujo el cuestionario
     * 
     * @param type $cn
     * @param type $name
     * @param type $id
     * @param type $prefix
     * @return string
     */
    function RenderFilterForm($cn, $name = "", $id = "", $prefix = "") {
        $html = "";
        $fld = $this->getCField();
        $json = trim($fld->getValue());
        if ($name == "") {
            $name = $this->getName();
        }
        if ($id == "") {
            $id = $name;
        }
        if ($fld->isVisible() == false) {
            //El campo esta invisible...
            $html.="<input type=\"hidden\" name=\"$name\" id=\"$id\" value=\"$json\"/>" . "\n";

            //DIV para insertar el Cuestionario (que viene bajo demanda por AYAX)
            $html.='<div id="' . $id . '_placeholder"></div>' . "\n";
        }

        return $html;
    }

    /**
     * Creo el cuestionario a partir del formulario recibido
     * 
     * @global type $primary_db
     * @return type
     */
    function loadForm() {
        global $primary_db;
        $fld = $this->m_parent;

        if ($fld->m_ClassParams == '') {
            error_log("CDH_CUESTIONARIO::loadForm() Falta definir campo prestacion en el classparams.");
            $fld->setValue('');
            return;
        }

        if (!isset($_POST["m_" . $fld->m_ClassParams])) {
            //Al cargar el formulario por primera vez, este campo esta en blanco
            $fld->setValue('');
            return;
        }

        $tpr_code = $_POST["m_" . $fld->m_ClassParams];
        if ($tpr_code == '') {
            $fld->setValue('');
            error_log("CDH_CUESTIONARIO::loadForm() No hay una prestacion seleccionada.");
            return;
        }

        //Proceso cuestionario
        $result = array();
        $sql = "SELECT * FROM tic_prestaciones_cuest WHERE tpr_code='{$tpr_code}'";
        $re = $primary_db->do_execute($sql);
        while ($myrow = $primary_db->_fetch_row($re)) {
            $q = $myrow['tcu_code']; //codigo unico de la pregunta
            $tipo = $myrow['tpr_tipo_preg'];

            //Proceso la(s) respuesta(s) a la pregunta (si llega en el POST)
            $res = '';
            $id = 'cuest_' . $q;
            if (isset($_POST[$id])) {
                $recibido = $_POST[$id];
                if (is_array($recibido)) {
                    //Si es un multiple, el valor elegido es un array
                    foreach ($recibido as $rsp) {
                        $res.= $rsp . '|';
                    }
                } else {
                    //Si es un checkbox (responde con "on" cuando esta marcado)
                    if ($tipo == 'CHECKBOX') {
                        $res = ($recibido == "on" ? "SI" : "NO");
                    } else {
                        $res = $recibido;
                    }
                }
            }

            //Salvo la respuesta
            $result[] = array(
                'tpr_code' => $tpr_code,
                'tcu_code' => $q,
                'tpr_preg' => $myrow['tpr_preg'],
                'tpr_tipo_preg' => $tipo,
                'tpr_respuesta' => $res,
                'tpr_miciudad' => $myrow['tpr_miciudad']
            );
        }

        //Persisto la respuesta como un objeto JSON
        $fld->setValue(json_encode($result), JSON_UNESCAPED_UNICODE);
    }

    /**
     * Caso que el cuestionario este en una vista solo lectura
     * 
     * @param type $cn
     * @param type $showlabel
     * @return string
     */
    function RenderReadOnly($cn, $showlabel = false) {
        $fld = $this->getCfield();
        $obj_tabla = $fld->getModel(); //modelo (tabla)

        //Busco la prestación en el modelo (estoy en una tabla) tpr_code
        $tpr_code = '';
        $tic_nro = -1;
        if($obj_tabla->checkField('tpr_code')) {
            $tpr_code = $obj_tabla->getField('tpr_code')->getValue();
        }
        
        if($obj_tabla->checkField('tic_nro')) {
            $tic_nro = $obj_tabla->getField('tic_nro')->getValue();
        }
        
        //Busco el codigo de ticket
        //$tic_nro = $obj->
        //error_log("CDH_CUESTIONARIO::RenderReadOnly() obj_tabla = instancia de " . get_class($obj_tabla));
        $html = '';
        $name = "m_" . $fld->m_Name;

        if ($fld->m_IsVisible) {
            $cuest = self::htmlVerCuestionario($tic_nro, $tpr_code);
            if ($showlabel) {
                $html.="<div class=\"itm\"><div class=\"desc\">{$fld->m_Label}</div><div class=\"fldro\">{$cuest}</div></div>" . "\n";
            } else {
                $html.=$cuest;
            }
        } else {
            //Campo oculto
            $id = $name;
            $html.="<input type=\"hidden\" name=\"{$name}\" id=\"{$id}\" />" . "\n";
        }

        return $html;
    }

    /**
     * Caso de que el campo este en el area de edicion de una tabla
     * Es llamado por el objeto CField / Llamado por ctable_handler
     * 
     * @param type $cn
     * @param type $frmname
     * @param type $table
     * @param type $row
     * @param type $ro
     * @param type $name
     * @param type $suffix
     * @return type
     */
    function RenderTableEdit($cn, $frmname, $table = "", $row = 0, $ro = false, $name = "", $suffix = "") {
        $fld = $this->m_parent; //Este campo
        $html = '';

        if ($name == "") {
            $name = $this->getName($table, $row);
        }
        if ($frmname == "") {
            $id = $name;
        } else {
            $id = $frmname . "_" . $name;
        }
        try {
            $obj_tabla = $fld->m_parent; //Modelo (estoy en una tabla)
            $obj = $obj_tabla->m_parent;

            $obj_tpr_code = (($obj_tabla && method_exists($obj_tabla, 'getField')) ? $obj_tabla->getField('tpr_code') : null);
            $tpr_code = ($obj_tpr_code ? $obj_tpr_code->getValue() : '');

            $obj_tic_nro = (($obj && method_exists($obj, 'getField')) ? $obj->getField('tic_nro') : null);
            $tic_nro = ($obj_tic_nro ? $obj_tic_nro->getValue() : '');
        } catch (Exception $e) {
            error_log('CDH_CUESTIONARIO::RenderTableEdit() ' . $e->getMessage());
            $tpr_code = '';
            $tic_nro = 0;
        }

        //Compongo el valor del campo
        $mostrar = self::htmlVerCuestionario($tic_nro, $tpr_code);

        //Si es read only, pongo el valor del campo dentro un HIDDEN, si no muestro el campo editable
        if ($ro) {
            //Si es read-only y visible, muestro un texto (si es invisible no muestro nada)
            if ($fld->m_IsVisible) {
                $html.="<div id=\"t{$name}\">{$mostrar}</div>\n";
            }
        } else {
            //El campo es editable, se usa para editar un registro
            //Anulo la funcion de busqueda flexible asi no sale el indicador
            $fld->m_search = "fix";
            $html.=$this->RenderFilterForm($cn, $name, $id, $id);
        }

        return $html;
    }

    /**
     * Crea el cuestionario de una prestacion en HTML
     * 
     * @global cdbdata $primary_db
     * @param string $tpr_code
     * @return string
     */
    static function crearCuestionario($tpr_code) {
        global $primary_db;

        //Armo el Cuestionario
        $html = '
        <div id="sub_prestaciones_cuest">
            <div class="row">
                <div id="subtit_prestaciones_cuest" class="col-xs-12">
                    <h4><i class="glyphicon glyphicon-comment"></i> Cuestionario</h4>
                </div>
            </div>
                
            <div id="tbody_prestaciones_cuest">';

        $sql2 = "SELECT tpr_code, tcu_code, tpr_orden, tpr_preg, tpr_tipo_preg, tpr_opciones, tpr_miciudad FROM tic_prestaciones_cuest WHERE tpr_code='{$tpr_code}'";
        $re2 = $primary_db->do_execute($sql2);

        $cant = 0;
        while ($myrow = $primary_db->_fetch_row($re2)) {
            $buff = '';
            $opciones = $myrow['tpr_opciones'];
            $q = $myrow['tcu_code']; //codigo de la pregunta
            $cant++;

            switch ($myrow['tpr_tipo_preg']) {
                case "TEXTO":
                    $buff.= '<input class="form-control" type="text" id="cuest_' . $q . '" name="cuest_' . $q . '">';
                    break;

                case "LISTA":
                    $buff.= '<select class="form-control" id="cuest_' . $q . '" name="cuest_' . $q . '">';
                    $partes = explode(';', $opciones);
                    foreach ($partes as $parte) {
                        $p = trim($parte);
                        $buff.= '<option value="' . $p . '">' . $p .'</option>';
                    }
                    $buff.= '</select>';
                    break;

                case "MULTIPLE":
                    $partes = explode(';', $opciones);
                    $cant2 = 1;
                    foreach ($partes as $parte) {
                        $p = trim($parte);
                        $buff.= '<span class="form-inline">' .
                                '<label for="cb_cuest_' . $cant . '_' . $cant2 . '">' . $p . '</label> ' .
                                '<input class="form-control" type="checkbox" name="cuest_' . $q . '[]" id="cb_cuest_' . $cant . '_' . $cant2 . '" value="' . $p . '">' .
                                '</span>  ';
                        $cant2++;
                    }
                    break;

                case "CHECKBOX":
                    $buff.= '<input class="form-control" type="checkbox" name="cuest_' . $q . '">';
                    break;

                default:
                    error_log("crearCuestionario($tpr_code) No se conoce el tipo {$myrow['tpr_tipo_preg']}");
            }

            $html.= '<div class="form-group input-sm">'.
                    '   <label class="col-xs-3 control-label">' . $myrow['tpr_preg'] . '</label>'.
                    '   <div class="input-group col-xs-9">' . $buff . '</div>'.
                    '</div>' . "\n";
        }
        $html.= '   </div>'. // tbody_prestaciones_cuest
                '</div>'; //sub_prestaciones_cuest
        
        //Caso que no haya ninguna pregunta para esta prestacion...
        if ($cant == 0) {
            $html = '';
        }
        //error_log("crearCuestionario($tpr_code) $html");
        return $html;
    }

    static function htmlVerCuestionario($tic_nro, $prestacion) {
        global $primary_db;

        if ($tic_nro === '' || $prestacion === '') {
            return '';
        }

        $h = '<div class="cuestionario">';
        $sql2 = "SELECT tic_nro, tpr_code, tcu_code, tpr_preg, tpr_tipo_preg, tpr_respuesta, tpr_miciudad FROM tic_ticket_cuestionario WHERE tpr_code='{$prestacion}' and tic_nro='{$tic_nro}'";
        $re2 = $primary_db->do_execute($sql2);
        while ($row = $primary_db->_fetch_row($re2)) {
            $h.='<div class="cuest form-inline">' .
                    '<span class"preg">' . $row['tpr_preg'] . ':</span> ' .
                    '<span class="resp">' . $row['tpr_respuesta'] . '</span>' .
                '</div>';
        }
        $h.='</div>';
        return $h;
    }
}
