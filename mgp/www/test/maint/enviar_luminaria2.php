<?php

$ticket = array(
    "RECLAMO 2295/2013",
    "RECLAMO 3032/2013",
    "RECLAMO 4085/2013",
    "RECLAMO 4475/2013",
    "RECLAMO 4703/2013",
    "RECLAMO 8117/2013",
    "RECLAMO 12746/2013",
    "RECLAMO 13047/2013",
    "RECLAMO 13963/2013",
    "RECLAMO 14512/2013",
    "RECLAMO 14747/2013",
    "RECLAMO 14902/2013",
    "RECLAMO 14934/2013",
    "RECLAMO 14945/2013",
    "RECLAMO 15145/2013",
    "RECLAMO 15195/2013",
    "RECLAMO 15204/2013",
    "RECLAMO 15418/2013",
    "RECLAMO 15463/2013",
    "RECLAMO 15479/2013",
    "RECLAMO 15480/2013",
    "RECLAMO 15539/2013",
    "RECLAMO 15540/2013",
    "RECLAMO 15736/2013",
    "RECLAMO 15792/2013",
    "RECLAMO 15943/2013",
    "RECLAMO 16160/2013",
    "RECLAMO 16168/2013",
    "RECLAMO 16224/2013",
    "RECLAMO 16291/2013",
    "RECLAMO 16292/2013",
    "RECLAMO 16418/2013",
    "RECLAMO 16591/2013",
    "RECLAMO 16630/2013",
    "RECLAMO 16631/2013",
    "RECLAMO 16639/2013",
    "RECLAMO 16646/2013",
    "RECLAMO 16690/2013",
    "RECLAMO 16726/2013",
    "RECLAMO 16861/2013",
    "RECLAMO 22100/2014",
    "RECLAMO 23842/2014",
    "RECLAMO 26049/2014",
    "RECLAMO 26050/2014",
    "RECLAMO 26501/2014",
    "RECLAMO 26502/2014",
    "RECLAMO 26532/2014",
    "RECLAMO 26534/2014",
    "RECLAMO 26546/2014"
);

include_once 'common/sites.php';
include_once 'beans/eventbus_event.php';
ini_set("error_log", LOG_PATH . "envio_luminarias2.log");

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
        $ev->eev_task = "luminaria";
        $ev->save();
        echo "<br>$t enviado";
    } else {
        echo "<br><span style=\"color:red\">$t NO ENCONTRADO</span>";
        error_log("$t no encontrado");
    }
}

