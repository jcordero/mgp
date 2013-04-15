<?php
include 'common/sites.php';
include 'beans/ticket.php';
include 'beans/ciudadano.php';
echo  'Creo objeto ticket <pre>';
$t = new ticket();
echo $t->toJSON();
echo '</pre>';
echo  'obtengo un ciudadano <pre>';
$ret = array('resultado' => ciudadano::FactoryById(36));
echo json_encode($ret);
echo '</pre>';



echo  'actualizo un ciudadano <pre>';
$ret = array('resultado' => ciudadano::updateCiudadano(ciudadano::FactoryById(36)));
echo json_encode($ret);
echo '</pre>';



echo  'obtengo un ciudadano por doc <pre>';
$ret = array('resultado' => ciudadano::FactoryByDoc('ARG','DNI','20470276'));
echo json_encode($ret);
echo '</pre>';

echo  'cargo un evento <pre>';
$evento = array(
            'chi_code'      => 2,
            'ciu_code'   => 37,
             'chi_fecha'      =>'2013-03-22 00:00:00',
             'chi_motivo'   =>'motivo',
             'use_code'      => '1',
             'chi_canal'   => 'canal',
        );

$ret = array('resultado' => ciudadano::addEvento($evento));
echo json_encode($ret);
echo '</pre>';

////////////////////////////////////////////////ticket/////////////////////////////////////

echo  'obtengo un ticket ident <pre>';
$ret = array('resultado' => ticket::factoryByIdent('RECLAMO','2','2013'));
echo json_encode($ret);
echo '</pre>';


echo  'obtengo un ticket por ciudadano <pre>';
$ret = array('resultado' => ticket::factoryByCiudadano(36));
echo json_encode($ret);
echo '</pre>';


echo  'agrego un ticket <pre>';
$ticket= ticket::factoryByCiudadano(36);
$ticket->tic_lugar= "un lugar";
$ticket->tpr_code=0101;
$ticket->tru_code=0;
$ret = array('resultado' => ticket::addTicket($ticket));
echo json_encode($ret);
echo '</pre>';