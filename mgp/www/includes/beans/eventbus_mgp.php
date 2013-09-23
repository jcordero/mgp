<?php
include_once 'beans/ticket.php';
include_once 'common/csession.php';
include_once 'beans/cambio_estado_mgp.php';

class eventbus_mgp {
    private $last_response;
    
    function run($event) {
        global $primary_db;
        $msg = '';
        $d = $event->eev_data;
        
        //'op'        =>  'cambio_estado','ingreso ticket'
        //'ticket'    =>  $this->tic_nro,
        //'prestacion'=>  $pres->tpr_code

            
        //Cargo el ticket
        $t = new ticket();
        $t->setNro($d->ticket);
        $t->load('basico');
        
        //Creo el mensaje
        $c = new cambio_estado_mgp();
        $c->loadFromTicket($t);

        //URL del web service destinatario
        $url = $primary_db->DesFiltrado( CSession::getParameter($primary_db,'mgp.endpoint_url',"") );

        //Secret
        $secret = $primary_db->DesFiltrado( CSession::getParameter($primary_db,'mgp.secret','') );
            
        $ticket_json = json_encode($c);
        $c->signature = md5($ticket_json.$secret);
        
        $data = json_encode($c); 

        //Envio el mensaje
        $ret = $this->put($url, $data);

        if($ret!=200)
            $msg = "Error #{$ret} del endpoint {$url}";
        
        return $msg;
    }
    
    private function put($url, $data) {
        
        error_log("post() URL=$url BODY=$data"); 

        $c = curl_init();
        curl_setopt($c, CURLOPT_URL, $url);
        curl_setopt($c, CURLOPT_HTTPHEADER, array('Content-Type: application/json','Expect:'));
        curl_setopt($c, CURLOPT_VERBOSE, 1);
        curl_setopt($c, CURLOPT_CUSTOMREQUEST, "POST"); 
        curl_setopt($c, CURLOPT_RETURNTRANSFER, 1); 
        curl_setopt($c, CURLOPT_POSTFIELDS,$data);
        $verbose = fopen('php://temp', 'rw+');
        curl_setopt($c, CURLOPT_STDERR, $verbose);

        $this->last_response = curl_exec($c); 
        $info = curl_getinfo($c); 
        
        if(!curl_errno($c)){ 
          error_log("post() Took " . $info['total_time'] . ' seconds to send a request to ' . $info['url']); 
          error_log('post() Respuesta '.$this->last_response);
        } else { 
          error_log('post() Curl error: ' . curl_error($c)); 
        } 
        curl_close($c);

        !rewind($verbose);
        $verboseLog = stream_get_contents($verbose);
        error_log("post() ".htmlspecialchars($verboseLog));
        
        return $info['http_code'];
    }

}