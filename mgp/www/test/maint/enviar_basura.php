<?php


$ticket = array(
    "RECLAMO 25252/2014",
    "RECLAMO 25253/2014",
    "RECLAMO 28670/2014",
    "RECLAMO 31168/2014",
    "RECLAMO 34348/2014",
    "RECLAMO 30367/2014",
    "RECLAMO 34123/2014",
    "RECLAMO 34340/2014",
    "RECLAMO 46453/2014",
    "RECLAMO 31145/2014",
    "RECLAMO 34316/2014",
    "RECLAMO 34353/2014",
    "RECLAMO 34361/2014",
    "RECLAMO 34500/2014",
    "RECLAMO 40255/2014",
    "RECLAMO 40558/2014",
    "RECLAMO 44902/2014",
    "RECLAMO 31623/2014",
    "RECLAMO 34318/2014",
    "RECLAMO 31272/2014",
    "RECLAMO 40171/2014",
    "RECLAMO 24626/2014",
    "RECLAMO 34116/2014",
    "RECLAMO 34349/2014",
    "RECLAMO 34507/2014",
    "RECLAMO 40076/2014",
    "RECLAMO 40858/2014",
    "RECLAMO 41599/2014",
    "RECLAMO 45436/2014"
);

include_once 'common/sites.php';
include_once 'beans/eventbus_event.php';
ini_set("error_log", LOG_PATH . "envio_basura.log");

foreach ($ticket as $t) {
    //Pido el codigo de reclamo interno 
    $tic_nro = $primary_db->QueryString("select tic_nro from tic_ticket where tic_identificador='{$t}'");

    //Salvo el evento
    if ($tic_nro != "") {

        //Pido el codigo de la prestacion
        $tpr_code = $primary_db->QueryString("select tpr_code from tic_ticket_prestaciones where tic_nro='{$tic_nro}' LIMIT 1");

        //Creo un evento 
        $ev = new eventbus_event();
        $ev->eev_data = array(
            "op" => "ingreso ticket",
            "ticket" => $tic_nro,
            "prestacion" => $tpr_code
        );
        $ev->eev_task = "limpieza";
        $ev->save();
        echo "<br>$t enviado";
    } else {
        echo "<br><span style=\"color:red\">$t NO ENCONTRADO</span>";
        error_log("$t no encontrado");
    }
}

