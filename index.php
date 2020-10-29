<?php
session_start();
require_once 'banco.php';
$banco = new Banco();
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Teste PHP</title>
    </head>
    <body>
        <form action="index_resp.php" method="post">
            codigo: <input name="codigo"/> <br><br>
            <select name="curso" id="cars">
                <?php 
                $banco->impressao_curso();
                ?>
            </select>
            <br><br>

            Nome: <input id="teste3" name="nome"/> <br>
            Preco: <input name="preco"/> <br>
            <input type="submit"/> <br>
        </form>

        URL: <input type="text" value="www.msn.com" id="novaURL"/> <br>
        <input type="submit" value="Gerar QRCode" onclick="gerarQR()"/><br>
        <div id="qrcode"></div>



        <script src="js/easy.qrcode.js"></script>
        <script>
            var url = document.getElementById('novaURL');
            var qrcode = new QRCode(document.getElementById('qrcode'), {
                text: url.value,
                title: "Pesquisa CPA",
                titleFont: "bold 16px Arial",
                titleColor: "#000000",
                titleBackgroundColor: "#ffffff",
                titleHeight: 50,
                titleTop: 30
            });

            function gerarQR() {
                qrcode.makeCode(url.value);
            }

        </script>
    </body>
</html>
