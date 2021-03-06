<?php
include_once "common/cdatatypes.php";
include_once "beans/ticket.php";
include_once "beans/functions.php";

class CDH_DASHBOARD extends CDataHandler {
    function __construct($parent) 
    {
        parent::__construct($parent);
    }

    function getTickets($p) {
        global $primary_db;
      
        //Obtengo el objeto dash_config y lo salvo en la sesion
        $dash_config = json_decode($p);
        $_SESSION["dash_config"] = $dash_config;
        error_log("CDH_DASHBOARD::getTickets() dash_config = ".print_r($dash_config,true));
        $extra = "";
        
        $estados_abiertos = toSqlList(strtolower(CSession::getParameter($primary_db,"estados.abiertos","pendiente,en espera,en curso,inspección")));
        $estados_cerrados = toSqlList(strtolower(CSession::getParameter($primary_db,"estados.cerrados","cerrado,resuelto,rechazado,rechazado indebido,finalizado,certificación")));
       
        //Opciones = TODOS, ABIERTOS, CERRADOS, VENCIDOS
        switch($dash_config->boton) {
            case "ABIERTOS":
                $sql = "select tic_coordx,tic_coordy,tic_identificador from v_tickets where tic_coordx<>0 and ttp_estado in ({$estados_abiertos})";
                break;
            case "CERRADOS":
                $sql = "select tic_coordx,tic_coordy,tic_identificador from v_tickets where tic_coordx<>0 and ttp_estado in ({$estados_cerrados})";
                break;
            case "VENCIDOS":
                $sql = "select tic_coordx,tic_coordy,tic_identificador from v_tickets where tic_coordx<>0 and ttp_estado in ({$estados_abiertos}) and datediff(now(),tic_tstamp_plazo)>0";
                break;
            default:
                $sql = "select tic_coordx,tic_coordy,tic_identificador from v_tickets where tic_coordx<>0";
        }
        
        //Canal de ingreso
        if($dash_config->canal!="") {
            $extra .= " and tic_canal='{$dash_config->canal}'";
        }
        //Barrio
        if($dash_config->barrio!=""){
            $extra .= " and tic_barrio='{$dash_config->barrio}'";
        }
        //Prestacion
        if($dash_config->prestacion->codigo!="") {
            $extra .= " and tpr_code like '{$dash_config->prestacion->codigo}%'";
        }
        //Organismo
        if($dash_config->organismo->codigo!="") {
            $extra .= " and tor_code='{$dash_config->organismo->codigo}'";
        }
        
        //Tickets
        $conjunto = array();
        $rs = $primary_db->do_execute($sql.$extra);
        while( $row=$primary_db->_fetch_row($rs) ) {
            $conjunto[] = array(
                'lat'=>$row['tic_coordx'],
                'lng'=>$row['tic_coordy'],
                'id'=>$row['tic_identificador']
            ); 
        }
        
        //Contadores
        $contadores['abiertos'] = $primary_db->QueryString("select count(*) as c from v_tickets where ttp_estado in ({$estados_abiertos}) {$extra}");
        $contadores['cerrados'] = $primary_db->QueryString("select count(*) as c from v_tickets where ttp_estado in ({$estados_cerrados}) {$extra}");
        $contadores['vencidos'] = $primary_db->QueryString("select count(*) as c from v_tickets where ttp_estado in ({$estados_abiertos}) and datediff(now(),tic_tstamp_plazo)>0 {$extra}");
       
        return json_encode(array(
            'tickets'       => $conjunto, 
            'contadores'    => $contadores
            ),JSON_UNESCAPED_UNICODE);
    }
    
    function getTicketInfo($p) {
        
        $tic = new ticket();
        $tic->setIdent($p);
        if( $tic->load('archivos') ) {
            $pres = $tic->prestaciones[0];
            
            $h = '<h5>'.$pres->tpr_code.' - '.$pres->tpr_description_full.'</h5>';
            $h.= '<b>'.$tic->tic_identificador.'</b><br>';
            $h.= '<b>Estado:</b> '.$pres->ttp_estado.' <b>Ingreso:</b> '.ISO8601toLocale($tic->tic_tstamp_in).' <b>Canal:</b> '.$tic->tic_canal.'<br>';
            $h.= '<b>Vencimiento:</b> '.ISO8601toLocale($tic->tic_tstamp_plazo).'<br>';
            if($tic->tic_nota_in!="") {
                $h.= '<b>Nota:</b> '.$tic->tic_nota_in.'<br>';
            }
            
            //Direccion y lumninaria
            $h.= '<b>Ubicación:</b> '.$tic->generarTextoDireccion().'<br>';
            
            //Fotos
            foreach($tic->archivos as $f) {
                $h.= '<img class="iwimg" src="'.WEB_PATH.'/webservices/foto/'.$f->doc_storage.'"><br>';
            }
            return $h;
        }
        
        return '';    
    }
}