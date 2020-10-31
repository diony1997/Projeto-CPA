<?php
session_start();
if (empty($_SESSION['user']) and empty($_SESSION['senha'])) {
    header('Location: loginUser.php');
}
require_once 'banco.php';
$banco = new Banco();
?>

<html>
    <head>
        <meta charset="utf-8">
        <title>Pesquisa CPA</title>
    </head>
    <body>
        <form action="paginaRelatorio_resp.php" method="post">
            <?php
            $banco->impressao_bloco();
            ?>
            <input type="submit" value="Gerar Relatório">
        </form>
    </body>
</html>
