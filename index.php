<html>
    <head>
        <meta charset="UTF-8">
        <title>Teste PHP</title>
    </head>
    <body>
        <form action="index_resp.php" method="post">
            codigo: <input name="codigo"/> <br>
            Nome: <input name="nome"/> <br>
            Preco: <input name="preco"/> <br>
            <input type="submit"/> <br>

        </form>


        URL: <input type="text" id="novaURL"/> <br>
        <input type="submit" value="Gerar QRCode" onclick="gerarQR()"/><br>
        <div id="qrcode"></div>


        <script src = "qrcode.min.js"></script>

        <script>
            var url = document.getElementById('novaURL');
            var qrcode = new QRCode(document.getElementById('qrcode'));

            function gerarQR() {
                qrcode.makeCode(url.value);
            }
        </script>

    </body>
</html>
