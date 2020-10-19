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

if ($resposta1 > 0) {
    $banco->inserirResposta($resposta1, $idpergunta1);
}
if ($resposta2 > 0) {
    $banco->inserirResposta($resposta2, $idpergunta2);
}
$banco->gerarRelacao();
$_SESSION['checar'] = FALSE;
header('location:paginaPerguntas2.php');

?>