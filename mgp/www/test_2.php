<?php

//$url = "http://mgp.commsys.com.ar/mgp/webservices/tickets/reclamo/2013/31";
$url = "http://mgp/mgp/webservices/tickets/reclamo/2013/33";
//$url = "http://147.mardelplata.gob.ar/mgp/webservices/tickets/reclamo/2013/31";
    
$secret = 'hasdYR33n1j34j#4jn*(-s';
$foto = '/Users/jcordero/Desktop/ducreux1.jpg';

//llamada por CURL
$cambio_estado_ticket = json_encode((object) array(
  'object'      =>  'cambio_estado_ticket',
  'avance'      =>  array(
      'tpr_code'        => "010202",
      'tav_tstamp_in'   => "20130509T132304",
      'tic_estado_in'   => "resuelto",
      'tav_nota'        => "Se cambio la tulipa"
  ),
  'archivos'    =>  array(
      array(
          'nombre'  =>  'nueva_tulipa.jpg',
          'tipo'    =>  'image/jpeg',
          'media'   =>  base64_encode(file_get_contents($foto)),
          'publico' =>  'SI',
          'nota'    =>  'Foto de la tulipa nueva'
      )
  ) 
));

$data = http_build_query(array(
    'payload'   => $cambio_estado_ticket, 
    'signature' => md5($secret.$cambio_estado_ticket)
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

