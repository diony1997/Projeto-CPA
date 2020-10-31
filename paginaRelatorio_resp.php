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
        <meta charset="utf-8">
        <title>Pesquisa CPA</title>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/excellentexport@3.4.3/dist/excellentexport.min.js"></script>
    </head>
    <body>
        <?php
        echo $tabela;
        ?>

        <br>
        <br>
        <a download="relatorio.xls" href="#" onclick="return ExcellentExport.excel(this, 'Relatorio', 'Relatório');">Export to Excel</a>
        <br>
        <a download="relatorio.csv" href="#" onclick="return ExcellentExport.csv(this, 'Relatorio');">Export to CSV</a>
    </body>
</html>

