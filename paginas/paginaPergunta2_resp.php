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
$resposta3 = filter_input(INPUT_POST, 'fb3');
$idpergunta3 = filter_input(INPUT_POST, 'idfb3');
$resposta4 = filter_input(INPUT_POST, 'fb4');
$idpergunta4 = filter_input(INPUT_POST, 'idfb4');
$resposta5 = filter_input(INPUT_POST, 'fb5');
$idpergunta5 = filter_input(INPUT_POST, 'idfb5');

if ($resposta1 > 0) {
    if (isset($_POST["fb1t1"]) || isset($_POST["fb1t2"])) {
        $banco->inserirResposta(0, $idpergunta1, 1);
    } else {
        $banco->inserirResposta($resposta1, $idpergunta1, 0);
    }   
    $banco->gerarRelacao($idpergunta1);
}
if ($resposta2 > 0) {
    if (isset($_POST["fb2t1"]) || isset($_POST["fb2t2"])) {
        $banco->inserirResposta(0, $idpergunta2, 1);
    } else {
        $banco->inserirResposta($resposta2, $idpergunta2, 0);
    }
    $banco->gerarRelacao($idpergunta2);
}
if ($resposta3 > 0) {
    if (isset($_POST["fb3t1"]) || isset($_POST["fb3t2"])) {
        $banco->inserirResposta(0, $idpergunta3, 1);
    } else {
        $banco->inserirResposta($resposta3, $idpergunta3, 0);
    }
    $banco->gerarRelacao($idpergunta3);
}
if ($resposta4 > 0) {
    if (isset($_POST["fb4t1"]) || isset($_POST["fb4t2"])) {
        $banco->inserirResposta(0, $idpergunta4, 1);
    } else {
        $banco->inserirResposta($resposta4, $idpergunta4, 0);
    }
    $banco->gerarRelacao($idpergunta4);
}
if ($resposta5 > 0) {
    if (isset($_POST["fb5t1"]) || isset($_POST["fb5t2"])) {
        $banco->inserirResposta(0, $idpergunta5, 1);
    } else {
        $banco->inserirResposta($resposta5, $idpergunta5, 0);
    }
    $banco->gerarRelacao($idpergunta5);
}

$_SESSION['checar'] = FALSE;
header('location:paginaPerguntas2.php');
?>