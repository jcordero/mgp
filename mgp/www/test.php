<?php
include 'includes/beans/call_status.php';
include 'includes/beans/person_status.php';
session_start();

echo  'Inicio prueba de clases call_status y person_status';
$p = new person_status();
$c = new call_status();

echo "<P>Estado: ".$c->talk_status;
echo "<P>Estado: ".$p->person_status;

$c->talk_status = 'CONECTADO';
$c->saveSession();

$p->person_status = 'IDENTIFICADO';
$p->saveSession();