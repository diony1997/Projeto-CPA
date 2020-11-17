<?php
session_start();

if (empty($_SESSION['user']) and empty($_SESSION['senha'])) {
    header('Location: loginUser.php');
}

require_once 'banco.php';
$banco = new Banco();

$bloco = filter_input(INPUT_POST, 'bloco');

$tabela = $banco->gerarRelatorio($bloco);
?>

<html>
    <head>
        <link rel="stylesheet" href="../lib/bootstrap/css/bootstrap.min.css">
        <script src="../lib/jquery/jquery.min.js"></script>
        <script src="../lib/bootstrap/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/excellentexport@3.4.3/dist/excellentexport.min.js"></script>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet">
        <meta charset = "UTF-8">
        <title>Relatório</title>
    </head>

    <body background="../img/fundoPagina.png">        
        <header>
            <?php
            echo $tabela;
            ?>
            <br>
            <a download="relatorio.xls" href="#" onclick="return ExcellentExport.excel(this, 'Relatorio', 'Relatório');">Export to Excel</a>
            <br>
            <a download="relatorio.csv" href="#" onclick="return ExcellentExport.csv(this, 'Relatorio');">Export to CSV</a>
        </header>
    </body>
</html>

