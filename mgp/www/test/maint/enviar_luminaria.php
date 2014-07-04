<?php

$ticket = array(
    "RECLAMO 17146/2013",
    "RECLAMO 17225/2013",
    "RECLAMO 17497/2013",
    "RECLAMO 17642/2013",
    "RECLAMO 17645/2013",
    "RECLAMO 17675/2013",
    "RECLAMO 17713/2013",
    "RECLAMO 17714/2013",
    "RECLAMO 17715/2013",
    "RECLAMO 17716/2013",
    "RECLAMO 17731/2013",
    "RECLAMO 17795/2013",
    "RECLAMO 17797/2013",
    "RECLAMO 17831/2013",
    "RECLAMO 17843/2013",
    "RECLAMO 17854/2013",
    "RECLAMO 18389/2013",
    "RECLAMO 18398/2013",
    "RECLAMO 18399/2013",
    "RECLAMO 19001/2013",
    "RECLAMO 19010/2013",
    "RECLAMO 19014/2013",
    "RECLAMO 20346/2013",
    "RECLAMO 21762/2013",
    "RECLAMO 22669/2013",
    "RECLAMO 22670/2013",
    "RECLAMO 23049/2013",
    "RECLAMO 23051/2013",
    "RECLAMO 24222/2013",
    "RECLAMO 24583/2013",
    "RECLAMO 1780/2014",
    "RECLAMO 2663/2014",
    "RECLAMO 2666/2014",
    "RECLAMO 2667/2014",
    "RECLAMO 2760/2014",
    "RECLAMO 3402/2014",
    "RECLAMO 3497/2014",
    "RECLAMO 6432/2014",
    "RECLAMO 6433/2014",
    "RECLAMO 6434/2014",
    "RECLAMO 6435/2014",
    "RECLAMO 6437/2014",
    "RECLAMO 6438/2014",
    "RECLAMO 6439/2014",
    "RECLAMO 6440/2014",
    "RECLAMO 6441/2014",
    "RECLAMO 6442/2014",
    "RECLAMO 6444/2014",
    "RECLAMO 6445/2014",
    "RECLAMO 6446/2014",
    "RECLAMO 6447/2014",
    "RECLAMO 9090/2014",
    "RECLAMO 9678/2014",
    "RECLAMO 9679/2014",
    "RECLAMO 10194/2014",
    "RECLAMO 12651/2014",
    "RECLAMO 12985/2014",
    "RECLAMO 12987/2014",
    "RECLAMO 12988/2014",
    "RECLAMO 12989/2014",
    "RECLAMO 12990/2014",
    "RECLAMO 12992/2014",
    "RECLAMO 12993/2014",
    "RECLAMO 12994/2014",
    "RECLAMO 12995/2014",
    "RECLAMO 12996/2014",
    "RECLAMO 12998/2014",
    "RECLAMO 12999/2014",
    "RECLAMO 13000/2014",
    "RECLAMO 13001/2014",
    "RECLAMO 13002/2014",
    "RECLAMO 13003/2014",
    "RECLAMO 13004/2014",
    "RECLAMO 13005/2014",
    "RECLAMO 13006/2014",
    "RECLAMO 13007/2014",
    "RECLAMO 13008/2014",
    "RECLAMO 13009/2014",
    "RECLAMO 13010/2014",
    "RECLAMO 13011/2014",
    "RECLAMO 13012/2014",
    "RECLAMO 13013/2014",
    "RECLAMO 13015/2014",
    "RECLAMO 13016/2014",
    "RECLAMO 13018/2014",
    "RECLAMO 13019/2014",
    "RECLAMO 13020/2014",
    "RECLAMO 13021/2014",
    "RECLAMO 13022/2014",
    "RECLAMO 13023/2014",
    "RECLAMO 13024/2014",
    "RECLAMO 13025/2014",
    "RECLAMO 13026/2014",
    "RECLAMO 13530/2014",
    "RECLAMO 16249/2014",
    "RECLAMO 22783/2014",
);

include_once 'common/sites.php';
include_once 'beans/eventbus_event.php';
ini_set("error_log", LOG_PATH."envio_luminarias.log");

foreach($ticket as $t) {
    //Pido el codigo de reclamo interno 
    $tic_nro = $primary_db->QueryString("select tic_nro from tic_ticket where tic_identificador='{$t}'");
    
    //Salvo el evento
    if($tic_nro!="") {
        
        //Pido el codigo de la prestacion
        $tpr_code = $primary_db->QueryString("select tpr_code from tic_ticket_prestaciones where tic_nro='{$tic_nro}' LIMIT 1");
        
        //Creo un evento 
        $ev = new eventbus_event();
        $ev->eev_data = array(
            "op"            =>  "ingreso ticket",
            "ticket"        =>  $tic_nro,
            "prestacion"    =>  $tpr_code
        );
        $ev->eev_task = "luminaria";
        $ev->save();
        echo "<br>$t enviado";
    } else {
        echo "<br><span style=\"color:red\">$t NO ENCONTRADO</span>";
        error_log("$t no encontrado");
    }
}

