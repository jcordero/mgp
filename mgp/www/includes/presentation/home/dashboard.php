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
      
        $dash_config = json_decode($p);
        $_SESSION["dash_config"] = $dash_config;
        $extra = "";
        
        //Opciones = TODOS, ABIERTOS, CERRADOS, VENCIDOS
        switch($dash_config->boton) {
            case "ABIERTOS":
                $sql = "select tic_coordx,tic_coordy,tic_identificador from v_tickets where tic_coordx<>0 and ttp_estado in ('pendiente','en espera','en curso')";
                break;
            case "CERRADOS":
                $sql = "select tic_coordx,tic_coordy,tic_identificador from v_tickets where tic_coordx<>0 and ttp_estado in ('cerrado','resuelto','rechazado','rechazado indebido')";
                break;
            case "VENCIDOS":
                $sql = "select tic_coordx,tic_coordy,tic_identificador from v_tickets where tic_coordx<>0 and ttp_estado in ('pendiente','en espera','en curso') and datediff(now(),tic_tstamp_plazo)>0";
                break;
            default:
                $sql = "select tic_coordx,tic_coordy,tic_identificador from v_tickets where tic_coordx<>0";
        }
        
        //Canal de ingreso
        if($dash_config->canal!="")
            $extra .= " and tic_canal='{$dash_config->canal}'";
        
        //Barrio
        if($dash_config->barrio!="")
            $extra .= " and tic_barrio='{$dash_config->barrio}'";
                
        //Prestacion
        if($dash_config->prestacion!="")
            $extra .= " and tpr_code like '{$dash_config->prestacion}%'";
                
        //Organismo
        if($dash_config->organismo!="")
            $extra .= " and tor_code='{$dash_config->organismo}'";

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
        $contadores['abiertos'] = $primary_db->QueryString("select count(*) from v_tickets where ttp_estado in ('pendiente','en espera','en curso') {$extra}");
        $contadores['cerrados'] = $primary_db->QueryString("select count(*) from v_tickets where ttp_estado in ('cerrado','resuelto','rechazado','rechazado indebido') {$extra}");
        $contadores['vencidos'] = $primary_db->QueryString("select count(*) from v_tickets where ttp_estado in ('pendiente','en espera','en curso') and datediff(now(),tic_tstamp_plazo)>0 {$extra}");
        
        return json_encode(array('tickets' => $conjunto, 'contadores' => $contadores));
    }
    
    function getTicketInfo($p) {
        
        $tic = new ticket();
        $tic->setIdent($p);
        if( $tic->load('archivos') ) {
            $pres = $tic->prestaciones[0];
            
            $h = '<h5>'.$pres->tpr_code.' - '.$pres->tpr_description_full.'</h5>';
            $h.= '<b>'.$tic->tic_identificador.'</b> <b>Canal:</b> '.$tic->tic_canal.'<br>';
            $h.= '<b>Estado:</b> '.$pres->ttp_estado.' <b>Ingreso:</b> '.ISO8601toDate($tic->tic_tstamp_in).'<br>';
            $h.= '<b>Vencimiento:</b> '.ISO8601toDate($tic->tic_tstamp_plazo).'<br>';
            if($tic->tic_nota_in!="")
                $h.= '<b>Nota:</b> '.$tic->tic_nota_in.'<br>';
            
            //Direccion y lumninaria
            
            //Fotos
            foreach($tic->archivos as $f) {
                $h.= '<img class="iwimg" src="'.WEB_PATH.'/webservices/foto/'.$f->doc_storage.'"><br>';
            }
            return $h;
        }
        
        return '';    
    }
}