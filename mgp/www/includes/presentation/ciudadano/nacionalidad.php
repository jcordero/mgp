<?php 
include_once "presentation/select.php";

class CDH_NACIONALIDAD extends CDH_SELECT {
    function __construct($parent) 	{
        parent::__construct($parent);
        $fld = $this->m_parent;
        $fld->m_search="fix";
        $fld->m_js_initial = "nacionalidad_obj.init";
    }
    
    function getJsIncludes() {
        return '<script type="text/javascript" src="'.WEB_PATH.'/includes/presentation/ciudadano/nacionalidad.js"></script>';
    }
    
    function getPaises($p) {
        global $primary_db;
        $cod = array();
        $pais = array();
        $sql = "SELECT cpa_code, cpa_descripcion FROM ciu_paises ORDER BY 2";
        $rs = $primary_db->do_execute($sql);
        while( $row=$primary_db->_fetch_row($rs)) {
            $cod[] = $row["cpa_code"];
            $pais[] = $row["cpa_descripcion"];
        }
        return json_encode(array("codigos"=>$cod,"descripciones"=>$pais));
    }
}

