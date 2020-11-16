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
$conteudo = filter_input(INPUT_POST, 'pergunta');
$disciplina = filter_input(INPUT_POST, 'disciplina');
$professor = filter_input(INPUT_POST, 'professor');
$tipo = filter_input(INPUT_POST, 'tipo');
$dataInicial = filter_input(INPUT_POST, 'dataInicial');
$dataFinal = filter_input(INPUT_POST, 'dataFinal');

$banco->inserirPergunta($curso, $conteudo, $disciplina, $professor, $tipo, $dataInicial, $dataFinal)
?>

<html>
    <head>
        <link rel="stylesheet" href="lib/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" media="(max-width: 900px)" href="css/estilo2.css">
        <link rel="stylesheet" media="(min-width: 900px)" href="css/estilo2.css">
        <script src="lib/jquery/jquery.min.js"></script>
        <script src="lib/bootstrap/js/bootstrap.min.js"></script>

        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet">

        <meta charset = "UTF-8">

        <title>Pergunta Inserida</title>
        
    </head>

    <body background = "img/fundoPagina.png" alt = "">
        <header>
            <div class="wrapper">
                <img class = "cpa" src="img/CPA_Logo_UAM.png"/>
                <div class="caption">
                    <h1>PERGUNTA INSERIDA</h1>
                    <p>Os dados foram inseridos com sucesso no sistema</p>
                    <br/><br/>
                    <form action="paginaAdmin.php">
                        <button type="submit" class="btn btn-success">VOLTAR AO INÍCIO</button></p>
                    </form>
                </div>
            </div>
        </header>
    </body>
</html>
