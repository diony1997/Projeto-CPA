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
                <?php
                $banco->impressao_curso();
                ?>
            <br><br>

            Nome: <input id="teste3" name="nome"/> <br>
            Data: <input type="date" id="birthday" name="birthday"> <br>
            <input type="submit"/> <br>
        </form>

        URL: <input type="text" value="www.msn.com" id="novaURL"/> <br>
        <input type="submit" value="Gerar QRCode" onclick="atualizar()"/><br>
        <div id="qrcode"></div>
        <img id="QR" />



        <script src="js/easy.qrcode.js"></script>
        <script>
            atualizar();
            var url = document.getElementById('novaURL');
            var qrcode = new QRCode(document.getElementById('qrcode'), {
                text: url.value,
                title: "Pesquisa CPA",
                titleFont: "bold 16px Arial",
                titleColor: "#000000",
                titleBackgroundColor: "#ffffff",
                titleHeight: 50,
                titleTop: 30,
            });

            function atualizar() {
                        document.getElementById("novaURL").value = document.getElementById("opCurso").value;
                    }
            function gerarQR() {
                var divText = document.getElementById("qrcode").outerHTML;
                var janela = window.open('', '', 'width=260,height=310');
                var doc = janela.document;
                doc.open();
                doc.write(divText);
                doc.close();
            }

        </script>
    </body>
</html>
