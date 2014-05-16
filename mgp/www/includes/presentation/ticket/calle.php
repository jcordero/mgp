<?php 
include_once "common/cdatatypes.php";
/**
 * Este campo guarda el codigo de la calle y su nombre, en un string separado por un pipe
 * 
 */
class CDH_CALLE extends CDataHandler {
    function __construct($parent) {
        parent::__construct($parent);
        $fld = $this->m_parent;
        $fld->m_search="fix";
		
        $fld->m_js_initial = "calle_init";
        $this->m_use_helper = true;
        $this->m_hide_helper = true;
        $fld->m_js_totext = "calle_totext"; 
        $fld->m_js_edit = "calle_edit"; 
        $this->m_icon = "icono-autocomplete.gif";
    }

    
    function AutocompleterDataSource($pars) {
        $ret = array();

        list($term,$id) = explode("|",$pars);

        $client = new SoapClient("http://gis.mardelplata.gob.ar/webservice/ws_calles.php?wsdl");
        try {
            $r = $client->callejero_mgp($term);
            foreach($r as $posible) {
                $ret[] = array("value"=>$posible->codigo ,"label"=>$posible->descripcion);	
            }
        } catch (SoapFault $exception) {
            error_log( "CDH_CALLE AutocompleterDataSource() ->".$exception );
        }
       
        return json_encode($ret,JSON_UNESCAPED_UNICODE);
    }
    
    function getJsIncludes() {	
        return '<script type="text/javascript" src="'.WEB_PATH.'/includes/presentation/ticket/calle.js"></script>';
    }
    
    
    /** 
     * Hacer un bloque con el callejero vigente
     * @global type $primary_db
     * @param type $p
     * @return type
     */ 
    function getCallejero($p) {
        global $primary_db;
        
        //existe un callejero en el cache APC?
        if(function_exists("apc_fetch")) {
            $resultado = false;
            $ret = apc_fetch("callejero",$resultado);
            if($resultado) {
                //Si existe, la clave del navegador y la local coinciden?
                //Si es asi retorno OK, si no coinciden mando el nuevo dataset al navegador
                if( isset($ret["key"]) && $ret["key"]==$p ) {
                    return "OK";
                } else {
                    return json_encode($ret,JSON_UNESCAPED_UNICODE);
                }
            }
        }
        //No existe el callejero en el cache APC...
        
        //Creo una nueva version del callejero desde la DB
        $rs = $primary_db->do_execute("select * from geo_calles order by gca_descripcion");
        while( $row=$primary_db->_fetch_row($rs) ) {
            $ret_c[] = $row['gca_codigo'];
            $ret_v[] = $row['gca_descripcion'];
        }
        $ret = array("codigos"=>$ret_c,"calles"=>$ret_v);
        
        //Creo el hash de esta version del callejero
        $key = md5(json_encode($ret_c,JSON_UNESCAPED_UNICODE));
        $ret["key"] = $key;
        
        //Salvo el resultado para la proxima, en el cache del APC
        if(function_exists("apc_store")) {
            apc_store("callejero", $ret);
        }        
        
        //Evaluo la key del navegador con la key local para determinar si hace falta 
        //volver a enviar el callejero
        if( isset($ret["key"]) && $ret["key"]==$p ) {
            return "OK";
        } else {
            return json_encode($ret,JSON_UNESCAPED_UNICODE);
        }
    }
    
    function getHelperValue($cn,$val) {
        $fld = $this->m_parent;
        $p = explode("|", $val);
        if(isset($p[1])) {
            $fld->writeAltValue($p[1]);
            return $p[1];
        }
        return "";
    }	
}

