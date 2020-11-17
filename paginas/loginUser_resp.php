<?php
require_once 'banco.php';
session_start();
//Lembrete para checar se a verificação esta certa e é necessaria
if (empty($_SESSION['user']) and empty($_SESSION['senha'])) {
    header('location:loginUser.php');
}

$banco = new Banco();
$user = filter_input(INPUT_POST, 'user');
$senha = filter_input(INPUT_POST, 'senha');
if ($banco->checarUser($user)) {
    $banco->loginUser($user, $senha);
} else {
    $_SESSION['loginerror'] = 1;
    header('Location: loginUser.php');
}
?>