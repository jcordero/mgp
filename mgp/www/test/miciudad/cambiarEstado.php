<?php

/* Recibo la llamada simulando el endpoint de MiCiudad
 * 
 * Si todo bien HTTP 201 { id:"nuevo_estado numerico" }
 * Si falla 
 *  HTTP 404 No existe el ticket
 *  HTTP 502 Error de la API { detalle:"error" }
 */

ini_set("error_log",'/Users/jcordero/plataforma4_sites/mgp_git/mgp/log/api_integracion.log');
error_log("\n------------------ INICIO PROCESO API MiCiudad-----------------------\n");

$metodo = $_SERVER['REQUEST_METHOD'];   // GET, PUT 

if($metodo=='PUT') {
    $post_vars = null;
    parse_str(file_get_contents("php://input"),$post_vars);
    
    $numeroSolicitud = $post_vars['numeroSolicitud']; 
    $estado = $post_vars['estado'];
    $estadoNombre = $post_vars['estadoNombre'];
    $fecha = $post_vars['fecha'];
    
    error_log("Recibi operacion: numeroSolicitud=$numeroSolicitud estado=$estado estadoNombre=$estadoNombre fecha=$fecha");
    
    header('HTTP/1.0 201 Status');
    echo json_encode(array("id" => $estado));
}
else
{
    header('HTTP/1.0 502 Bad Gateway');
}
