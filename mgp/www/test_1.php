<?php

//$url = "http://mgp.commsys.com.ar/mgp/webservices/tickets.php?tipo=RECLAMO&anio=2013&nro=37";
$url = "http://mgp/mgp/webservices/tickets.php?tipo=RECLAMO&anio=2013&nro=16";

$secret = 'hasdYR33n1j34j#4jn*(-s';


$c = curl_init();
curl_setopt($c, CURLOPT_URL, $url);
curl_setopt($c, CURLOPT_VERBOSE, 1);
curl_setopt($c, CURLOPT_RETURNTRANSFER, 1); 
$verbose = fopen('php://temp', 'rw+');
curl_setopt($c, CURLOPT_STDERR, $verbose);

echo "<p>Envio URL: ".$url;
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

