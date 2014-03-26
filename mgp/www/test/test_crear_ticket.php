<?php

//DESARROLLO
$url = "http://mgp/mgp/webservices/tickets";

//TEST
//$url = "http://mgp.commsys.com.ar/mgp/webservices/tickets";

//PRODUCCION
//$url = "http://147.mardelplata.gob.ar/mgp/webservices/tickets";
    
/* 'playa' => 'Cabo Largo',
    'lat' => '-38.0985',
    'lng' => '-57.5452',
 * 
 * 
 * {"tipo":"DOMICILIO","alternativa":"NRO","calle_nombre":"SALTA","calle":null,"callenro":2100,"piso":"","dpto":"","nombre_fantasia":"","barrio":"PLAZA PERALTA RAMOS","comuna":"","lat":-37.99987411499,"lng":-57.557281494141,"calle_nombre2":null,"calle2":null} 
 */

//DECLARACION DEL TICKET
$ingreso_ticket = array(
    'object'            =>  "ingreso_ticket",
    'tic_tipo'          =>  "RECLAMO",
    'tic_nota_in'       =>  "Una nota inicial",
    'ciu_nombre'        =>  "Romina",
    'ciu_apellido'      =>  "Borgonovo",
    'ciu_movil'         =>  "1541435224",
    'ciu_documento'     =>  "ARG DNI 25569985",
    'tpr_code'          =>  "0901",
    'tic_coordx'        =>  -37.99987411499,
    'tic_coordy'        =>  -57.557281494141,
    'tic_calle_nombre'  =>  "SALTA",
    'tic_nro_puerta'    =>  2100,
    'ttp_cuestionario'  =>  array(
                                (object) array("tpr_miciudad"=>"325", "tpr_respuesta"=>"182") //Rubro:: Pizzeria
                            )
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

