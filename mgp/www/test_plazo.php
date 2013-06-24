<?php
include_once "common/sites.php";
include_once "beans/ticket.php";

$prest = new prestacion();

$cant = 10;
$unit = "DAY";
$tipo = "LABORALES";

echo "<h3>Test de plazo</h3> Cantidad = ".$cant."<br> Unidad = ".$unit."<br> Tipo = ".$tipo."<br>";
echo "Vencimiento: ".$prest->getVencimiento($cant, $unit, $tipo);

$cant = 10;
$unit = "DAY";
$tipo = "CORRIDOS";

echo "<h3>Test de plazo</h3> Cantidad = ".$cant."<br> Unidad = ".$unit."<br> Tipo = ".$tipo."<br>";
echo "Vencimiento: ".$prest->getVencimiento($cant, $unit, $tipo);


echo "<hr>";



$cant = 3;
$unit = "DAY";
$tipo = "LABORALES";

echo "<h3>Test de plazo</h3> Cantidad = ".$cant."<br> Unidad = ".$unit."<br> Tipo = ".$tipo."<br>";
echo "Vencimiento: ".$prest->getVencimiento($cant, $unit, $tipo);

$cant = 3;
$unit = "DAY";
$tipo = "CORRIDOS";

echo "<h3>Test de plazo</h3> Cantidad = ".$cant."<br> Unidad = ".$unit."<br> Tipo = ".$tipo."<br>";
echo "Vencimiento: ".$prest->getVencimiento($cant, $unit, $tipo);
