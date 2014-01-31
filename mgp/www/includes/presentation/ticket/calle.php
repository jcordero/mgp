<?php 
include_once "common/cdatatypes.php";

class CDH_CALLE extends CDataHandler 
{
    function __construct($parent) 
    {
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
        global $primary_db;
        $ret = array();

        list($term,$id) = explode("|",$pars);

        $client = new SoapClient("http://gis.mardelplata.gob.ar/webservice/ws_calles.php?wsdl");
        try
        {
            $r = $client->callejero_mgp($term);
            foreach($r as $posible)
                $ret[] = array("value"=>$posible->codigo ,"label"=>$posible->descripcion);	
        }
        catch (SoapFault $exception)
        {
            error_log( "CDH_CALLE callejero_mgp() ->".$exception );
        }
       
        return json_encode($ret,JSON_UNESCAPED_UNICODE);
    }
    
    function getJsIncludes()
    {	
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
        
        if(function_exists("apc_fetch")) {
            $resultado = false;
            $ret = apc_fetch("callejero",$resultado);
            if($resultado) {
                //Las claves coinciden? retorno OK, si no coinciden mando el nuevo dataset
                if( isset($ret["key"]) && $ret["key"]==$p )
                    return "OK";
                else
                    return json_encode($ret,JSON_UNESCAPED_UNICODE);
            }
        }
        
        $rs = $primary_db->do_execute("select * from geo_calles order by gca_descripcion");
        while( $row=$primary_db->_fetch_row($rs) ) {
            $ret_c[] = $row['gca_codigo'];
            $ret_v[] = $row['gca_descripcion'];
        }
        $ret = array("codigos"=>$ret_c,"calles"=>$ret_v);
        $key = md5(json_encode($ret),JSON_UNESCAPED_UNICODE);
        $ret["key"] = $key;
        
        if(function_exists("apc_store")) {
            apc_store("callejero", $ret);
        }        
        
        if( isset($ret["key"]) && $ret["key"]==$p )
            return "OK";
        else
            return json_encode($ret,JSON_UNESCAPED_UNICODE);
    }
}

