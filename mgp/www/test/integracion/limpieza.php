<?php

/* Recibo la llamada simulando el endpoint de Luminarias
 * 
 * Si todo bien HTTP 200 { result:"OK" }
 * Si falla 
 *  HTTP 400 Error de la API { result:"ERROR", error:"detalle del error" }
 */

ini_set("error_log",'/Users/jcordero/plataforma4_sites/mgp_git/mgp/log/api_integracion.log');
error_log("\n------------------ INICIO PROCESO API INTEGRACION LIMPIEZA -----------------------\n");

$secret = 'jYh37H*3h4@ggj(33hdmrawp23';
$metodo = $_SERVER['REQUEST_METHOD'];   //PUT 

if($metodo=='POST') {
    $post_vars = null;
    //parse_str(file_get_contents("php://input"),$post_vars);
    $stream = file_get_contents("php://input");
    if($stream) {
        $post_vars=  json_decode($stream);
        $signature = $post_vars->signature;
    }
    $firmado = false;
    
    //Autenticacion del mensaje
    $ticket = json_encode($post_vars->ticket,JSON_UNESCAPED_UNICODE);
    $firma = md5($secret.$ticket);
    if( $firma==$signature ) {
        $firmado = true;        
    } else {
        error_log("ERROR Operacion rechazada por firma invalida");
    }
    
    //Proceso del ticket recibido
    error_log("Recibi operacion LIMPIEZA: ".print_r($post_vars,true));

    echo json_encode(array("result" => "OK"),JSON_UNESCAPED_UNICODE);
}
else
{
    header('HTTP/1.0 400 Bad Request');
    echo json_encode(array("error"=>"Metodo HTTP invalido"),JSON_UNESCAPED_UNICODE);
    error_log("ERROR operacion rechazada metodo HTTP invalido ");
}
