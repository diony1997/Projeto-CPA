<?php
session_start();
require_once 'banco.php';
$banco = new Banco();
if (empty($_SESSION['user']) and empty($_SESSION['senha'])) {
    header('location:loginUser.php');
}
?>
<html>
    <head>
        <meta charset="utf-8">
        <title>Pesquisa CPA</title>

        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" media="(max-width: 640px)" href="max-640px.css">
        <link rel="stylesheet" media="(min-width: 640px)" href="min-640px.css"> 
        <link rel="stylesheet" href="lib/bootstrap/css/bootstrap.min.css" />
        <link rel="stylesheet" href="css/estilo4.css" />
        <script src="lib/jquery/jquery.min.js"></script>
        <script src="lib/bootstrap/js/bootstrap.min.js"></script>
    </head>
    <body background="img/fundoPagina.png">
        <div class="header">
            <img class="logo" src="img/CPA_Logo_UAM.png" />

            <div class="form">
                <label>Bloco</label><br>
                <?php
                $banco->impressao_bloco();
                ?>
                <br><br>
                <label>URL</label><br>
                <input type="text" id="novaURL" value="www.google.com" class="input1">
                <br><br>
                <form enctype=multipart/form-data action="paginaAdmin_resp.php" method="POST">
                    <label>Adicionar ao Banco</label><br>
                    <input name="file" type="file" accept=".csv" /><br>
                    <input type="submit" value="Enviar" name="submit">
                </form>
            </div>

            <div class="logout">
                <form action="logout_user.php">
                    <button type="submit" class="botao" ><span>Sair</span></button>
                </form>
            </div>
        </div> 
        <div class="principal">
            <div class="perguntas">
                <form action="paginaAddPergunta.php" method="post">
                    <button type="submit" class="botao1" ><span>Adicionar Perguntas</span></button>
                </form>
            </div>
            <div class="qrcode">
                <button class="botao2" onclick="abrirQR()"><span>Gerar QR Code</span></button>
            </div>
            <div class="relatorio">
                <form action="paginaRelatorio_resp.php" method="post">
                    <input type="hidden" id="cursoRe" name="bloco">
                    <button class="botao3" ><span>Gerar <br>Relatório</span></button>
                </form>
            </div>
        </div>
        <div id="QR" style="display: none;">
        </div>
        <script src="js/easy.qrcode.js"></script>
        <script>
                    var qrcode = new QRCode(document.getElementById("QR"), {
                        text: "www.google.com",
                        title: "Pesquisa CPA",
                        titleFont: "bold 16px Arial",
                        titleColor: "#000000",
                        titleBackgroundColor: "#ffffff",
                        titleHeight: 50,
                        titleTop: 30
                    });
                    atualizar();
                    function atualizar() {
                        document.getElementById("cursoRe").value = document.getElementById("opBloco").value;
                    }

                    function abrirQR() {
                        qrcode.makeCode(document.getElementById("novaURL").value);
                        var janela = window.open('', '', 'width=280,height=330,resizable');
                        janela.document.write(document.getElementById("QR").outerHTML);
                        janela.document.write('<title>QR Code</title><scri' + 'pt> document.getElementById("QR").style.display = "block"; </scri' + 'pt>');
                    }

        </script>

    </body>
</html>



