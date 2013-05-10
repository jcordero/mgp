<?php
global $primary_db;
define('SESSION_UPDATE',false);
include_once 'common/sites.php';
include_once 'beans/eventbus_event.php';
include_once 'beans/eventbus_luminaria.php';
include_once 'beans/eventbus_limpieza.php';
include_once 'beans/eventbus_miciudad.php';
ini_set("error_log", LOG_PATH.'event_bus.log');

echo "\n* * INICIO PROCESO DE EVENTOS \n";

//Cuantos reintentos se pueden hacer?
$max_retries = CSession::getParameter($primary_db,'eventbus.retries',20);

//Recorro la tabla de eventos y ejecuto las operaciones correspondientes al evento
$sql = "select * from eve_events where eev_status='pendiente'";
$rs = $primary_db->do_execute($sql);
while($row=$primary_db->_fetch_row($rs)) {
    
    $ev = new eventbus_event();
    $ev->load($row);
    $reintentos = intval($ev->eev_error_msg);
    $clase = 'eventbus_'.$ev->eev_task;
    
    if(!class_exists($clase)) {
        $ev->setStatus('error', "No existe un controlador para el task solicitado", true);
    } else {
        echo "- Proceso: $clase\n";
        $th = new $clase();
        $msg = $th->run($ev);
        if($msg==='') {
            $ev->setStatus('completado', '', true);
        } else {
            //Se puede hacer un reintento mas?
            if($reintentos<=$max_retries) {
                $reintentos++;
                $ev->setStatus('pendiente', $reintentos);
            } else {
                $ev->setStatus('error', "Tarea abandonada mas de {$max_retries} intentos fallidos", true);
           }
        }
    }
}

echo "\n * * FIN DEL PROCESO DE EVENTOS \n";

?>
