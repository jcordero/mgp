<?php
include 'common/sites.php';
include 'beans/ticket.php';

echo  'Creo objeto ticket <pre>';
$t = new ticket();
echo $t->toJSON();
echo '</pre>';
