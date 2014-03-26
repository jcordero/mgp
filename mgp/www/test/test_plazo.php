<html>
    <head><title>Test de fecha</title>
    </head>
    <body>
        <form action="test_plazo.php" method="POST">
            <fieldset>
                <label for="cant">Cantidad</label><input type="number" min="1" max="100" name="cant">
                <label for="unit">Unidad</label><select name="unit"><option>DAY<option>HOUR<option>MINUTE </select>
                <label for="tipo">Modalidad</label><select name="tipo"><option>LABORALES<option>CORRIDOS</select>
                <button type="submit">Calcular</button>
            </fieldset>    
        </form>

<?php
include_once "common/sites.php";
include_once "beans/ticket.php";

$prest = new prestacion();

$cant = isset($_REQUEST["cant"]) ? intval($_REQUEST["cant"],10) : 0;
$unit = isset($_REQUEST["unit"]) ? $_REQUEST["unit"] : "DAY";
$tipo = isset($_REQUEST["tipo"]) ? $_REQUEST["tipo"] : "LABORALES";

if($cant>0) {
    echo "<h3>Test de plazo</h3> Cantidad = ".$cant."<br> Unidad = ".$unit."<br> Tipo = ".$tipo."<br>";
    echo "Vencimiento: ".$prest->getVencimiento($cant, $unit, $tipo);
}
?>

    </body>
</html>
