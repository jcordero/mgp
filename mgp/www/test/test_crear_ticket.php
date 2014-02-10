<?php

//DESARROLLO
//$url = "http://mgp/mgp/webservices/tickets";

//TEST
$url = "http://mgp.commsys.com.ar/mgp/webservices/tickets";

//PRODUCCION
//$url = "http://147.mardelplata.gob.ar/mgp/webservices/tickets";
    
/* 'playa' => 'Cabo Largo',
    'lat' => '-38.0985',
    'lng' => '-57.5452',
 */

//DECLARACION DEL TICKET
$ingreso_ticket = array(
    'object'            =>  "ingreso_ticket",
    'tic_tipo'          =>  "RECLAMO",
    'tic_nota_in'       =>  "Una nota inicial",
    'ciu_nombre'        =>  "Jorge",
    'ciu_apellido'      =>  "Cordero",
    'ciu_movil'         =>  "1541435224",
    'ciu_documento'     =>  "ARG DNI 20470276",
    'tpr_code'          =>  "030601",
    'tic_coordx'        =>  -38.09848,
    'tic_coordy'        =>  -57.545197,
    'tic_calle_nombre'  =>  "",
    'tic_nro_puerta'    =>  0
);

$ingreso_ticket_json = json_encode($ingreso_ticket,JSON_UNESCAPED_UNICODE);
$secret = "8b868e67197910fb";

$data = http_build_query(array(
    'payload'   => $ingreso_ticket_json, 
    'signature' => md5($secret.$ingreso_ticket_json)
)); 

//ENVIO DEL TICKET
$c = curl_init();
curl_setopt($c, CURLOPT_URL, $url);
curl_setopt($c, CURLOPT_HTTPHEADER, array('Content-Type: application/json','Expect:'));
curl_setopt($c, CURLOPT_VERBOSE, 1);
curl_setopt($c, CURLOPT_CUSTOMREQUEST, "PUT"); 
curl_setopt($c, CURLOPT_RETURNTRANSFER, 1); 
curl_setopt($c, CURLOPT_POSTFIELDS,$data);
$verbose = fopen('php://temp', 'rw+');
curl_setopt($c, CURLOPT_STDERR, $verbose);

echo "<p>Uso URL = {$url} <br>Envio: <pre>".print_r($ingreso_ticket,true)."</pre><br>Codificado: <pre>{$data}</pre>";
$tuData = curl_exec($c); 
echo "<hr><p>Respuesta: <pre>".print_r(json_decode($tuData),true)."</pre>";

if(!curl_errno($c)){ 
  $info = curl_getinfo($c); 
  echo '<p>Took ' . $info['total_time'] . ' seconds to send a request to ' . $info['url']; 
  echo '<p>Respuesta<pre>'.$tuData.'</pre>';
} else { 
  echo '<p>Curl error: ' . curl_error($c); 
} 
curl_close($c);

echo '<p>---- LOG ------';
!rewind($verbose);
$verboseLog = stream_get_contents($verbose);
echo "<p><pre>", htmlspecialchars($verboseLog), "</pre>";

