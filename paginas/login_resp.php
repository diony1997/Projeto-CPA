<?php

require_once 'banco.php';
session_start();
//Lembrete para checar se a verificação esta certa e é necessaria
if (empty($_SESSION['ra']) and empty($_SESSION['senha'])) {
    header('location:login.php');
}

$banco = new Banco();
$ra = filter_input(INPUT_POST, 'user');
$senha = filter_input(INPUT_POST, 'senha');
if ($banco->checarRA($ra)) {
    $banco->login($ra, $senha);
} else {
    $_SESSION['loginerror'] = 1;
    header('Location: login.php');
}
?>
