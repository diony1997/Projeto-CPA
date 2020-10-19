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




        <button onclick="pergunta()"></button>
<h1 id="message0">Hello World!</h1>
<h1 id="message1">Hello World!</h1>


        <?php
        session_start();
        require_once 'banco.php';
        $banco = new Banco();
        $saida = $banco->buscarPergunta();
        ?>

        <script src = "qrcode.min.js" ></script>

        <script>
            var url = document.getElementById('novaURL');
            var qrcode = new QRCode(document.getElementById('qrcode'));
            pergunta();
            function gerarQR() {
                qrcode.makeCode(url.value);
            }
            function escrever() {
                document.getElementById("message").innerHTML = "your text here";
            }
            function pergunta() {
                var perguntas = <?php echo json_encode($saida); ?>;
                var pergunta = perguntas.split(";");
                //cada interação do for é uma pergunta
                for (var i = 0; i < pergunta.length - 1; i++) {
                    document.getElementById("message"+i).innerHTML = pergunta[i];
                }
            }

        </script>


    </body>
</html>
