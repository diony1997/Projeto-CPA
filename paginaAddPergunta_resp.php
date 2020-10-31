<?php

session_start();
/*
if (empty($_SESSION['user']) and empty($_SESSION['senha'])) {
    header('Location: loginUser.php');
}
 * 
 */
require_once 'banco.php';
$banco = new Banco();


$curso = filter_input(INPUT_POST, 'curso');
echo 'O curso é ' . $curso . "<br>";
$conteudo = filter_input(INPUT_POST, 'pergunta');
echo 'O conteudo é ' . $conteudo . "<br>";
$disciplina = filter_input(INPUT_POST, 'disciplina');
echo 'A disciplina é ' . $disciplina . "<br>";
$professor = filter_input(INPUT_POST, 'professor');
echo 'O professor é ' . $professor . "<br>";
$tipo = filter_input(INPUT_POST, 'tipo');
echo 'O tipo é ' . $tipo . "<br>";
$dataInicial = filter_input(INPUT_POST, 'dataInicial');
echo 'A dataInicial é ' . $dataInicial . "<br>";
$dataFinal = filter_input(INPUT_POST, 'dataFinal');
echo 'A dataFinal é ' . $dataFinal . "<br>";

$banco->inserirPergunta($curso, $conteudo, $disciplina, $professor, $tipo, $dataInicial, $dataFinal)
?>
<form action="paginaAdmin.php">
    <button type="submit"><span>HOME</span></button>
</form>

