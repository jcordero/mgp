<?php
include_once 'beans/ticket.php';

class eventbus_miciudad {
    private $last_response;
    
    function run($event) {
        global $primary_db;
        $msg = '';
        $d = $event->eev_data;
        
        //'op'        =>  'cambio_estado',
        //'ticket'    =>  $this->tic_nro,
        //'prestacion'=>  $pres->tpr_code

        error_log("eventbus_miciudad::run() ".print_r($event,true));
        
        //Cuando se hace un alta, no hay que informar nada...
        if( $d->op==='ingreso ticket' ) {
            
        }
        
        //Cuando se hace un cambio de estado, hay que notificar a MiCiudad
        if( $d->op==='cambio_estado' ) {    
            error_log("eventbus_miciudad::run() reporto cambio_estado a MiCiudad");
        
            //Cargo el ticket
            $t = new ticket();
            $t->setNro($d->ticket);
            $t->load('basico');
            
            //URL del web service destinatario
            $url = $primary_db->DesFiltrado( CSession::getParameter($primary_db,'miciudad.endpoint_url',"") );
            $api_key = $primary_db->DesFiltrado( CSession::getParameter($primary_db,'miciudad.apikey',"") );
            $api_secret = $primary_db->DesFiltrado( CSession::getParameter($primary_db,'miciudad.secret',"") );
            
            if($url==='')
                return 'ERROR no esta declarado el parametro miciudad.endpoint_url';
            
            //Cual es la prestacion que dispara el mensaje?
            $tpr_code = $d->prestacion;
            foreach( $t->prestaciones as $prest ) {
                if( $prest->tpr_code == $tpr_code ) {
                    $avance = $prest->getLastAvance();
                    
                    //pendiente 1, inspección 2, en curso 3, en espera 4, resuelto 5, rechazado 6, cerrado 7, certificación 8, rechazado indebido 9
                    $cod_estado = CSession::getParameter($primary_db,'miciudad.estado.'.$avance->tic_estado_in,0);
                            
                    //Mensaje a enviar
//                    $data = http_build_query(array(
                    $data = json_encode(array(
                        'numeroSolicitud'   => $t->getNroTicket().'/'.$t->getAnioTicket(), 
                        'estado'            => $cod_estado,
                        'estadoNombre'      => $avance->tic_estado_in,
                        'fecha'             => $avance->tav_tstamp_in,
                        'visibleCiudadano'  => ($avance->tic_estado_in==='pendiente' || $avance->tic_estado_in==='rechazado indebido' ? false : true)
                    )); 

                    //Envio el mensaje URL
                    $msg_url = $url."?apiKey=".$api_key."&hash=".md5($api_secret.$data);
                    
                    //Retorna el codigo HTTP de respuesta
                    $ret = $this->put($msg_url, $data);

                    //Si responde con {"detalle":"estado \/ visibleCiudadano son datos requeridos"} o algo asi es que esta mal
                    if($ret==='' || $this->last_response==='') {
                        $msg = "Error (sin respuesta) del endpoint {$url}";
                    }else {
                        $ret_obj = json_decode($this->last_response);
                        if(isset($ret_obj)) {
                            if (isset($ret_obj->detalle)) {
                                $msg = "Error ($ret_obj->detalle) del endpoint {$url}";
                            }
                        } else {
                            $msg = "Error (falta respuesta en JSON) del endpoint {$url}";
                        }
                    }
                }
            }
                    
        }
        
        return $msg;
    }
    
    private function put($url, $data) {
        error_log('put() data ' . $data);
        $c = curl_init();
        curl_setopt($c, CURLOPT_URL, $url);
        curl_setopt($c, CURLOPT_HTTPHEADER, array('Content-Type: application/json','Expect:'));
        curl_setopt($c, CURLOPT_VERBOSE, 1);
        curl_setopt($c, CURLOPT_CUSTOMREQUEST, "PUT"); 
        curl_setopt($c, CURLOPT_RETURNTRANSFER, 1); 
        curl_setopt($c, CURLOPT_POSTFIELDS,$data);
        $verbose = fopen('php://temp', 'rw+');
        curl_setopt($c, CURLOPT_STDERR, $verbose);

        $this->last_response = curl_exec($c); 
        $info = curl_getinfo($c); 
        
        if(!curl_errno($c)){ 
          error_log("put() Took " . $info['total_time'] . ' seconds to send a request to ' . $info['url']); 
          error_log('put() Respuesta '.$this->last_response);
        } else { 
          error_log('put() Curl error: ' . curl_error($c)); 
        } 
        curl_close($c);

        !rewind($verbose);
        $verboseLog = stream_get_contents($verbose);
        error_log("put() Log: ".$verboseLog);
        error_log("put() HTTP Response code: ".$info['http_code']);
        
        return $info['http_code'];
    }
}
