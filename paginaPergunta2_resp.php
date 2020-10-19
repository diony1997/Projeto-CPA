<?php

require_once 'banco.php';
session_start();
if (!(isset($_SESSION['ra']) == true) and ( isset($_SESSION['senha']) == true)) {
    header('login.php');
}

$banco = new Banco();

$resposta1 = filter_input(INPUT_POST, 'fb');
$idpergunta1 = filter_input(INPUT_POST, 'idfb1');
$resposta2 = filter_input(INPUT_POST, 'fb2');
$idpergunta2 = filter_input(INPUT_POST, 'idfb2');

echo "<br>Resposta id = ".$idpergunta1." = ".$resposta1."</br>";
echo "<br>Resposta id = ".$idpergunta2." = ".$resposta2."</br>";


?>