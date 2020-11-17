<?php
require_once 'banco.php';

$banco = new banco();
$tipo = filter_input(INPUT_POST, 'tipo');
$disciplina = filter_input(INPUT_POST, 'disciplina');
$curso = filter_input(INPUT_POST, 'curso');


if($tipo == 1){
    $banco->impressao_professor($tipo, $disciplina);
} else if($tipo == 2) {
    $banco->impressao_professor($tipo, $curso);
} else if($tipo == 4) {
    $banco->impressao_disciplina($curso);
}