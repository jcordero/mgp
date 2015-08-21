<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);


$data = (object) array ( 
	'provincia' => 'Santa Fe',
	'tipo' => 'GOBERNADOR',
	'fecha' => '20150610T093322',
	'votos1' => 100,
	'votos2' => 80,
	'votos3' => 30,
	'votos4' => 0,
	'enblanco' => 2,
	'nulos' => 0,
	'total' => 250 
);
$content = json_encode($data);
$url = 'http://pro.commsys.com.ar/escrutinio/mesa/1027';

$c = curl_init();
curl_setopt($c, CURLOPT_URL, $url);
curl_setopt($c, CURLOPT_HTTPHEADER, array('Content-Type: application/json', 'Expect:'));
curl_setopt($c, CURLOPT_VERBOSE, 1);
curl_setopt($c, CURLOPT_CUSTOMREQUEST, 'POST');
curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($c, CURLOPT_POSTFIELDS, $content);
$resp = curl_exec($c);
curl_close($c);

echo $resp;

