<?php
session_start();
require_once 'banco.php';
$banco = new Banco();


$curso = filter_input(INPUT_POST, 'curso');
$conteudo = filter_input(INPUT_POST, 'pergunta');
$disciplina = filter_input(INPUT_POST, 'disciplina');
$professor = filter_input(INPUT_POST, 'professor');
$tipo = filter_input(INPUT_POST, 'tipo');
$dataInicial = filter_input(INPUT_POST, 'dataInicial');
$dataFinal = filter_input(INPUT_POST, 'dataFinal');

$banco->inserirPergunta($curso, $conteudo, $disciplina, $professor, $tipo, $dataInicial, $dataFinal)
?>
/* 
* To change this license header, choose License Headers in Project Properties.
* To change this template file, choose Tools | Templates
* and open the template in the editor.
*/

