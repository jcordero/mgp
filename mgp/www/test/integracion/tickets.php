<?php

/* Recibo la llamada simulando el endpoint de Luminarias
 * 
 * Si todo bien HTTP 200 { result:"OK" }
 * Si falla 
 *  HTTP 400 Error de la API { result:"ERROR", error:"detalle del error" }
 */

ini_set("error_log",'/Users/jcordero/plataforma4_sites/mgp_git/mgp/log/api_integracion.log');
error_log("\n------------------ INICIO PROCESO API Luminarias-----------------------\n");

$secret = 'jYh37H*3h4@ggj(33hdmrawp23';
$metodo = $_SERVER['REQUEST_METHOD'];   //PUT 

if($metodo=='PUT') {
    $post_vars = null;
    parse_str(file_get_contents("php://input"),$post_vars);
    
    $ticket = $post_vars['ticket']; 
    $signature = $post_vars['signature'];
    
    //Autenticacion del mensaje
    $firma = md5($secret.$ticket);
    if( $firma==$signature ) {
        //Proceso del ticket recibido
        $ticket_obj = json_decode($ticket);
        error_log("Recibi operacion: ".print_r($ticket_obj,true));

        echo json_encode(array("result" => "OK"),JSON_UNESCAPED_UNICODE);
    } else {
        header('HTTP/1.0 400 Bad Request');
        echo json_encode(array("error"=>"Firma recibida invalida"),JSON_UNESCAPED_UNICODE);
        error_log("ERROR Operacion rechazada por firma invalida");
    }
}
else
{
    header('HTTP/1.0 400 Bad Request');
    echo json_encode(array("error"=>"Metodo HTTP invalido"),JSON_UNESCAPED_UNICODE);
    error_log("ERROR operacion rechazada metodo HTTP invalido ");
}
