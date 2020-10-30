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
                //Lembrete para checar se a verificação esta certa e é necessaria
                if (empty($_SESSION['user']) and empty($_SESSION['senha'])) {
                    header('location:loginUser.php');
                }

                $banco = new Banco();
                $user = filter_input(INPUT_POST, 'user');
                $senha = filter_input(INPUT_POST, 'senha');
                if ($banco->checarUser($user)) {
                    $banco->loginUser($user, $senha);
                } else {
                    $_SESSION['loginerror'] = 1;
                    header('Location: loginUser.php');
                }
                ?>

            </div>

        </header>

    </body>

</html>