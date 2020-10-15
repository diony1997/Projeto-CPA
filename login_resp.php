<!DOCTYPE HTML>
<html>

    <head>
        <link rel="stylesheet" href="lib/bootstrap/css/bootstrap.min.css" />
        <link rel="stylesheet" media="(max-width: 800px)" href="css/estilo.css">
        <link rel="stylesheet" media="(min-width: 800px)" href="css/estilo.css">
        <script src="lib/jquery/jquery.min.js"></script>
        <script src="lib/bootstrap/js/bootstrap.min.js"></script>

        <link href="https://fonts.googleapis.com/css2?family=Tajawal&display=swap" rel="stylesheet">

        <meta charset = "UTF-8"/>

        <title>Projeto CPA</title>
    </head>

    <body>

        <header>

            <div id = "fundo">
                <img src = "css/fundo.jpg" alt = "" />
            </div>

            <div class = "wrapper">
                <div class="imagem">
                    <img class = "cpa" src="img/cpa.png" />
                </div>


                <?php
                require_once 'banco.php';
                session_start();
                if ((isset($_SESSION['ra']) == true) and ( isset($_SESSION['senha']) == true)) {
                    header('location:index.php');
                }

                $banco = new Banco();

                $ra = $_POST['user'];
                $senha = $_POST['senha'];
                if ($banco->checarRA($ra)) {
                    $banco->login($ra, $senha);
                } else {
                    echo 'Usuario invalido';
                }
                ?>

            </div>

        </header>

    </body>

</html>