<?php
require_once('./Capacitacao.php');
require_once('./Texto.php');
$t= new Texto ('data.txt', '///');

$a = $t->toArray();
var_dump($a);

?>
