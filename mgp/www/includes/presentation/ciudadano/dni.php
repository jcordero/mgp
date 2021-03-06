<?php

include_once "common/cdatatypes.php";

// PAIS TIPO NUMERO

class CDH_DNI extends CDataHandler {

    function __construct($parent) {
        parent::__construct($parent);
        $fld = $this->m_parent;
        $fld->m_allow_blank = true;
        $fld->m_js_validate = "valDNI";
        $fld->m_js_totext = "toTextDNI";
        $fld->m_js_tovalue = "toTextDNI";
        $fld->m_js_edit = "editDNI";
        $fld->m_js_initial = "initDNI";
        $this->m_js_main_search = "chg_dni";
    }

    /** Generar HTML para formulario
     * 
     * @param type $cn
     * @param type $name
     * @param type $id
     * @param type $pre
     * @return string
     */
    public function RenderFilterForm($cn, $name = "", $id = "", $pre = "") {
        if ($name == ""){
            $name = $this->getName();
        }
        if ($id == ""){
            $id = $name;
        }
        $fld = $this->m_parent;

        $val = $this->getValue();
        if (!$fld->m_IsVisible) {
            $html.="<input type=\"hidden\" name=\"$name\" id=\"$id\" value=\"$val\"/>";
        } else {
            //val = campo compuesto
            //val1 = tipo de documento
            //val2 = numero de documento
            $lista = explode(' ', $val);
            $val1 = (isset($lista[0]) ? $lista[0] : "");
            $val2 = (isset($lista[1]) ? $lista[1] : "");
            $val3 = (isset($lista[2]) ? $lista[2] : "");

            $html = "<div id=\"{$fld->m_Name}\" class=\"form-group input-sm\">
                        <label class=\"control-label col-xs-3\">{$fld->m_Label}</label>
                        <div class=\"col-xs-9 form-inline\">
                            <input type=\"hidden\" name=\"{$name}\" id=\"{$id}\" value=\"{$val}\"/>";

            if ($fld->m_IsReadOnly==true) {
                $html.="<p class=\"form-control-static\">{$val}</p>";
            } else {
                //Pais
                $html.=  "<div class=\"form-group col-xs-6\">"
                        ."  <select class=\"form-control input-sm\" name=\"p{$name}\" id=\"p{$id}\" data-selected=\"{$val1}\">"
                            .$this->getOptions()
                        ."  </select>"
                        ."</div>";

                //Tipo de documento
                $html.="<div class=\"form-group col-xs-2\">
                            <select class=\"form-control input-sm\" name=\"t{$name}\" id=\"t{$id}\" data-selected=\"{$val2}\">
                                <option value=\"DNI\">DNI</option>
                                <option value=\"LE\" >LE</option>
                                <option value=\"LC\" >LC</option>
                                <option value=\"PAS\">PAS</option>
                                <option value=\"CI\" >CI</option>
                                <option value=\"PRE\">PRE</option>
                            </select>
                        </div>
                ";

                //Nro de documento
                if ($fld->m_ClassParams != "no_search") {
                    $html.= "<div class=\"form-group col-xs-4\">
                                <div class=\"input-group\">
                                    <input class=\"form-control input-sm\" type=\"text\" name=\"n{$name}\" id=\"n{$id}\" value=\"{$val3}\" maxlength=\"15\"/>"
                            ."      <span class=\"input-group-addon\" onclick=\"chg_docid(this)\" id=\"b{$id}\"><i class=\"glyphicon glyphicon-search\" ></i></span>"
                            ."  </div>"
                            ."</div>";    
                } else {
                    $html.="<div class=\"form-group col-xs-4\">
                                <input class=\"form-control input-sm\" type=\"text\" name=\"n{$name}\" id=\"n{$id}\" value=\"{$val3}\" maxlength=\"15\"/>"
                            . "</div>";
                }
                
                
                
            }
            $html.="</div></div>";
        }
        return $html;
    }

    function loadForm() {
        $fld = $this->m_parent;
        $val1 = "";
        $val2 = "";
        if ($fld->m_no_form == false) {
            $val = (isset($_REQUEST["m_" . $fld->m_Name]) ? $_REQUEST["m_" . $fld->m_Name] : "");
            $val1 = (isset($_REQUEST["pm_" . $fld->m_Name]) ? $_REQUEST["pm_" . $fld->m_Name] : "");
            $val2 = (isset($_REQUEST["tm_" . $fld->m_Name]) ? $_REQUEST["tm_" . $fld->m_Name] : "");
            $val3 = (isset($_REQUEST["nm_" . $fld->m_Name]) ? $_REQUEST["nm_" . $fld->m_Name] : "");

            //Combino los dos campos, el tipo y el nro de documento
            if ($val1 != "" && $val2 != "" && $val3 != "") {
                $fld->setValue($val1 . " " . $val2 . " " . $val3);
            } elseif ($val != "") {
                $fld->setValue($val);
            } else {
                $fld->setValue("");
            }
        }
    }

    function getJsIncludes() {
        return '<script type="text/javascript" src="' . WEB_PATH . '/includes/presentation/ciudadano/dni.js"></script>';
    }

    function buscarPadron2007($p) {
        global $padron_db;
        list($pais, $tipo, $nr) = explode(' ', $p);
        $nro = intval($nr);
        $ret = array('resultado' => 'no encontrado');
        if ($pais === 'ARG') {
            $row = $padron_db->QueryArray("SELECT matricula,apelnom,direcc,clase,ocup,sexo,tipo,localidad,provincia,depto FROM padron_2007 where matricula={$nro}");
            if ($row) {
                list($apellido, $nombre) = explode(' ', $row['apelnom'], 2);
                $genero = $row['sexo'] === 'F' ? 'FEMENINO' : 'MASCULINO';
                $ret = array(
                    'resultado' => 'encontrado',
                    'nro' => $row['matricula'],
                    'nombre' => $nombre,
                    'apellido' => $apellido,
                    'direccion' => $row['direcc'],
                    'ocupacion' => $row['ocup'],
                    'genero' => $genero,
                    'localidad' => $row['localidad'],
                    'provincia' => $row['provincia'],
                    'barrio' => $row['depto']
                );
            }
        }
        return json_encode($ret, JSON_UNESCAPED_UNICODE);
    }
    
    function buscarPadron($p) {
        global $padron_db;
        list($pais, $tipo, $nr) = explode(' ', $p);
        $nro = intval($nr);
        $ret = array('resultado' => 'no encontrado');
        if ($pais === 'ARG') {
            $row = $padron_db->QueryArray("SELECT matricula,apellido,nombres,domicilio,clase,profesion,sexo FROM padron where matricula={$nro}");
            if ($row) {
                $genero = $row['sexo'] === 'F' ? 'FEMENINO' : 'MASCULINO';
                $ret = array(
                    'resultado' => 'encontrado',
                    'nro' => $row['matricula'],
                    'nombre' => $row['nombres'],
                    'apellido' => $row['apellido'],
                    'direccion' => $row['domicilio'],
                    'ocupacion' => $row['profesion'],
                    'genero' => $genero,
                    'localidad' => "",
                    'provincia' => "",
                    'barrio' => ""
                );
            }
        }
        return json_encode($ret, JSON_UNESCAPED_UNICODE);
    }

    private function getOptions() {
        global $primary_db;

        if (function_exists('apc_fetch')) {
            $opt = apc_fetch('CDH_DNI: lista_paises');
            if ($opt !== false){
                return $opt;
            }
        }

        $html = '';
        $rs = $primary_db->do_execute("SELECT cpa_code, cpa_descripcion FROM ciu_paises ORDER BY 2");
        while ($row = $primary_db->_fetch_row($rs)) {
            $html.="<option value=\"{$row['cpa_code']}\">" . $row['cpa_descripcion'];
        }

        if (function_exists('apc_store')) {
            apc_store('CDH_DNI: lista_paises', $html);
        }
        return $html;
    }

}
