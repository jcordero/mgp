<?php

$url = "http://mgp.commsys.com.ar/mgp/webservices/tickets";

$secret = 'hasdYR33n1j34j#4jn*(-s';

//Foto 
$foto = base64_encode(file_get_contents('/Users/jcordero/Desktop/59346361.jpg'));

//llamada por CURL
$ingreso_ticket = json_encode((object) array(
  'object'              =>  'ingreso_ticket',
  'tic_tipo'            =>  'RECLAMO',
  'tic_coordx'          =>  -38.0086896250302,
  'tic_coordy'          =>  -57.5345889139824,
  'tic_calle_nombre'    =>  'ALVEAR, CARLOS MARIA',
  'tic_nro_puerta'      =>  '345',
  'tpr_code'            =>  '0101',
  'ciu_documento'       =>  'ARG DNI 20300300',
  'ciu_nombre'          =>  'JUAN CARLOS',
  'ciu_apellido'        =>  'PETRUZA',
  'media'               =>  $foto
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

