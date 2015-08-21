<?php
global $primary_db;
define('SESSION_UPDATE',false);
include_once 'common/sites.php';
include_once 'beans/functions.php';

ini_set("error_log", LOG_PATH.'fix_reclamos.log');

error_log("* * INICIO PROCESO");

//Arreglo de estado -> Cambiar en tic_ticket_prestaciones y crear un tic_avance
$mal_estado = array();
$rs = $primary_db->do_execute("select tpr.tic_nro,tpr_code,estado,ttp_estado,fecha from tic_ticket_prestaciones tpr join tmp_reclamos tre on tpr.tic_nro=tre.tic_nro where ttp_estado <> estado");
while( $row=$primary_db->_fetch_row($rs) ) {
    $tic = (object) array(
        "tic_nro"       =>  $row["tic_nro"],
        "tpr_code"      =>  $row["tpr_code"],
        "nuevo_estado"  => strtolower($row["estado"]),
        "estado"        =>  $row["ttp_estado"],
        "fecha"         =>  $row["fecha"]
    );
    $mal_estado[$row["tic_nro"]] = $tic;
    
    //Corrijo estado
    $primary_db->do_execute("update tic_ticket_prestaciones set ttp_estado='{$tic->nuevo_estado}' where tic_nro={$tic->tic_nro} and tpr_code='{$tic->tpr_code}'");
    
    //Pongo fecha de cierre
    $ultimo_tav_code = $primary_db->QueryString("select tav_code from tic_avance where tic_nro={$tic->tic_nro} and tpr_code='{$tic->tpr_code}' order by tav_tstamp_in desc limit 1");
    $primary_db->do_execute("update tic_avance set tav_tstamp_out='{$tic->fecha}', use_code_out='1' where tic_nro={$tic->tic_nro} and tpr_code='{$tic->tpr_code}' and tav_code='{$ultimo_tav_code}'");
    
    //Agrego avance para documentar cierre
    $tav_code = $primary_db->Sequence("tic_avance");
    $primary_db->do_execute("INSERT INTO tic_avance (tic_nro        , tpr_code          , tav_code   , tav_tstamp_in  , use_code_in, tic_estado_in    , tav_nota        , tic_motivo, tic_estado_out        , tav_tstamp_out, use_code_out) ".
                                            "VALUES ({$tic->tic_nro}, '{$tic->tpr_code}', {$tav_code}, '{$tic->fecha}', '1'        ,  '{$tic->estado}', 'ajuste M.Baulo', ''        , '{$tic->nuevo_estado}', NULL          , NULL        )");
    
    //Ajusto fecha de cierre                                        
    $primary_db->do_execute("update tic_ticket set tic_tstamp_cierre='{$tic->fecha}',tic_estado='CERRADO' where tic_nro={$tic->tic_nro}");                                        
}

//Vuelco a pantalla
echo 'MAL CAMPO ESTADO:<br> <table border="1"><tr><th>ticket</th><th>prestacion</th><th>nuevo estado</th><th>estado anterior</th><th>fecha</th></tr>';
foreach($mal_estado as $recl) {
    echo "<tr><td>{$recl->tic_nro}</td><td>{$recl->tpr_code}</td><td>{$recl->nuevo_estado}</td><td>{$recl->estado}</td><td>{$recl->fecha}</td></tr>";
}
echo "</table>";




$mal_fecha = array();
$rs2 = $primary_db->do_execute("select tic.tic_nro, tic_tstamp_cierre,fecha,estado from tic_ticket tic join tmp_reclamos tre on tic.tic_nro=tre.tic_nro where tic_tstamp_cierre <> fecha");
while( $row=$primary_db->_fetch_row($rs2) ) {
    $tic = (object) array(
        "tic_nro"       =>  $row["tic_nro"],
        "fecha_cierre"  =>  $row["tic_tstamp_cierre"],
        "fecha"         =>  $row["fecha"],
        "estado"        =>  strtolower($row["estado"]),
        "tpr_code"      =>  ""
    );
    $mal_fecha[$row["tic_nro"]] = $tic;
        
    
    //Cual es la prestacion?
    $tic->tpr_code = $primary_db->QueryString("select tpr_code from tic_ticket_prestaciones where tic_nro={$tic->tic_nro} limit 1");

    //Como es el ultimo estado?
    $ultimo = $primary_db->QueryArray("select tav_code, tic_estado_in from tic_avance where tic_nro={$tic->tic_nro} and tpr_code='{$tic->tpr_code}' order by tav_tstamp_in desc limit 1");
    
    if($ultimo["tic_estado_in"]==$tic->estado) {
        $primary_db->do_execute("update tic_avance set tav_tstamp_in='{$tic->fecha}', tav_tstamp_out=NULL, use_code_in='1', use_code_out=NULL, tav_nota='ajuste M.Baulo' where tic_nro={$tic->tic_nro} and tpr_code='{$tic->tpr_code}' and tav_code='{$ultimo["tav_code"]}'");

    } else {
        $primary_db->do_execute("update tic_avance set tav_tstamp_out='{$tic->fecha}', use_code_out='1' where tic_nro={$tic->tic_nro} and tpr_code='{$tic->tpr_code}' and tav_code='{$ultimo["tav_code"]}'");

        //Agrego avance para documentar cierre
        $tav_code = $primary_db->Sequence("tic_avance");
        $primary_db->do_execute("INSERT INTO tic_avance (tic_nro        , tpr_code          , tav_code   , tav_tstamp_in  , use_code_in, tic_estado_in    , tav_nota        , tic_motivo, tic_estado_out  , tav_tstamp_out, use_code_out) ".
                                                "VALUES ({$tic->tic_nro}, '{$tic->tpr_code}', {$tav_code}, '{$tic->fecha}', '1'        ,  '{$tic->estado}', 'ajuste M.Baulo', ''        , '{$tic->estado}', NULL          , NULL        )");
    }
    
    //Ajusto fecha de cierre                                        
    $primary_db->do_execute("update tic_ticket set tic_tstamp_cierre='{$tic->fecha}',tic_estado='CERRADO' where tic_nro={$tic->tic_nro}");                                        
}

//Vuelco a pantalla
echo 'MAL CAMPO FECHA CIERRE:<br> <table border="1"><tr><th>ticket</th><th>prestacion</th><th>estado</th><th>fecha anterior</th><th>fecha nueva</th></tr>';
foreach($mal_fecha as $recl) {
    echo "<tr><td>{$recl->tic_nro}</td><td>{$recl->tpr_code}</td><td>{$recl->estado}</td><td>{$recl->fecha_cierre}</td><td>{$recl->fecha}</td></tr>";
}
echo "</table>";

