<?php

//$url = "http://mgp.commsys.com.ar/mgp/webservices/tickets";
$url = "http://mgp/mgp/webservices/tickets";
//$url = "http://147.mardelplata.gob.ar/mgp/webservices/tickets";
    
//llamada por CURL
$ingreso_ticket = json_encode((object) array(
  'afiliado'    =>  12345,
  'id_agenda'   =>  10,
  'id_turno'    =>  1000
));

$data = http_build_query(array(
    'payload'   => $ingreso_ticket, 
    'signature' => md5($secret.$ingreso_ticket)
)); 

$c = curl_init();
curl_setopt($c, CURLOPT_URL, $url);
curl_setopt($c, CURLOPT_HTTPHEADER, array('Content-Type: application/json','Expect:'));
curl_setopt($c, CURLOPT_VERBOSE, 1);
curl_setopt($c, CURLOPT_CUSTOMREQUEST, "PUT"); 
curl_setopt($c, CURLOPT_RETURNTRANSFER, 1); 
curl_setopt($c, CURLOPT_POSTFIELDS,$data);
$verbose = fopen('php://temp', 'rw+');
curl_setopt($c, CURLOPT_STDERR, $verbose);

echo "<p>Uso URL = ".$url;
$tuData = curl_exec($c); 
echo "<p>Respuesta: <pre>".print_r(json_decode($tuData),true)."</pre>";

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

