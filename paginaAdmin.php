<?php
session_start();
if (empty($_SESSION['user']) and empty($_SESSION['senha'])) {
    header('location:loginUser.php');
}
?>
<!DOCTYPE HTML>
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
                <form>
                    <input type="text" name="curso" placeholder="Curso" class="input1"><br><br>
                    <input type="text" name="url" placeholder="URL" class="input1">
                </form>
            </div>

            <div class="logout">
                <button class="botao" ><span>Sair</span></button>
            </div>
        </div> 
        <div class="principal">
            <div class="perguntas">
                <a href="#"><button class="botao1" ><span>Adicionar Perguntas</span></button></a>
            </div>
            <div class="qrcode">
                <button class="botao2" onclick="abrirQR()"><span>Gerar QR Code</span></button>
            </div>
            <div class="relatorio">
                <a href="paginaRelatorio.php"><button class="botao3" ><span>Gerar <br>Relatório</span></button></a>
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
                    function abrirQR() {
                        var janela = window.open('', '', 'width=280,height=330,resizable');
                        janela.document.write(document.getElementById("QR").outerHTML);
                        janela.document.write('<title>QR Code</title><scri' + 'pt> document.getElementById("QR").style.display = "block"; </scri' + 'pt>');
                    }
        </script>

    </body>
</html>



