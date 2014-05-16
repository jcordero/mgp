<?php
include_once "common/cdatatypes.php";
include_once "presentation/selectarray.php";

/** Los canales posibles son:
 * 
 * WEB
 * CALL
 * CGPC
 * ENTE
 * 
 * 	 */
class CDH_CANALDEINGRESO extends CDH_SELECTARRAY {

    function __construct($parent) {
        global $sess;
        parent::__construct($parent);

        $this->m_array = array();
        if (isset($sess)) {
            //Tomo de los grupos funcionales aquellos que empiecen con canal_
            $canal = "CALL";

            //Reviso los grupos del usurio logeado busco uno que diga canal_
            if (isset($_SESSION['groups'])) {
                $partes = explode(",", $_SESSION['groups']);
                foreach ($partes as $grupo) {
                    $grp = strtoupper(trim($grupo));
                    if (substr($grp, 0, 6) == "CANAL_") {
                        $canal = substr($grupo, 7);
                    }
                }
            }

            $this->m_array[$canal] = $canal;
        } else {
            $this->m_array["WEB"] = "WEB";
        }
    }

    function RenderFilterForm($cn, $name = "", $id = "", $prefix = "") {
        $fld = $this->getCField();
        error_log("CDH_CANALDEINGRESO::RenderFilterForm() visible=".($fld->isVisible() ? "SI" : "NO"));
        if (count($this->m_array) == 1) {
            $fld->m_IsVisible = false;
            $keys = array_keys($this->m_array);
            $fld->setValue($this->m_array[$keys[0]]);
        }

        return parent::RenderFilterForm($cn, $name, $id);
    }

    function RenderReadOnly($cn, $showlabel = false) {
        $fld = $this->getCField();
        error_log("CDH_CANALDEINGRESO::RenderReadOnly() visible=".($fld->isVisible() ? "SI" : "NO"));
        return parent::RenderReadOnly($cn, $showlabel);
    }
}
