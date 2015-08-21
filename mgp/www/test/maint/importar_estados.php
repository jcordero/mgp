<?php

include_once 'common/sites.php';
include_once 'beans/ticket.php';
ini_set("error_log", LOG_PATH . "importar_estados.log");

//Abro el archivo
$handle = fopen("reclamos_basura.csv", "r");
$data = null;
$cant = 0;
$cambios = 1;
do {
    if ($data[0]) {
        $ticket = "RECLAMO " . $data[0] . "/" . $data[1];
        $estado = strtolower($data[2]);
        $cant++;
        echo "<p>#$cant $ticket - $estado";

        //Existe el ticket?
        $existe = $primary_db->QueryString("select count(*) from tic_ticket where tic_identificador='$ticket' ");
        echo " - " . ($existe == "1" ? "EXISTE" : "NO EXISTE");
        if($existe=="1") {
            //Esta en el mismo estado?
            $row = $primary_db->QueryArray("select ttp_estado,tpr_code from tic_ticket_prestaciones ttp join tic_ticket tic on ttp.tic_nro=tic.tic_nro where tic_identificador='$ticket' limit 1");
            $estado_actual = $row["ttp_estado"];
            $tpr_code = $row["tpr_code"];
            echo " - ".($estado == $estado_actual ? "SIN CAMBIOS" : "CAMBIAR DESDE $estado_actual #".($cambios++));
            
            if($estado != $estado_actual) {
                $tic = new ticket();
                $tic->setIdent($ticket);
                $tic->load();
                $tic->cambiar_estado($tpr_code, $estado, "script de cambio de estado");
            }
        }
    }
} while ($data = fgetcsv($handle, 1000, ";"));


