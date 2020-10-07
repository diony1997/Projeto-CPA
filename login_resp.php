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
                $banco = new Banco();

                $ra = $_POST['user'];
                $senha = $_POST['senha'];
                if ($banco->checarRA($ra)) {
                    if ($banco->login($ra, $senha)) {
                        echo 'senha valida';
                    } else {
                        //redireciona para outra pagina
                        session_start();
                        $_SESSION['message'] = "<script>alert('Senha Inválida');</script>";
                        header("Location: login.php?");
                    }
                } else {
                    echo 'Usuario invalido';
                }
                ?>

            </div>

        </header>

    </body>

</html>