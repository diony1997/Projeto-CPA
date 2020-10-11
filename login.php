
<!DOCTYPE HTML>
<html>
    <head>
        <link rel="stylesheet" href="lib/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" media="(max-width: 800px)" href="css/estilo.css">
        <link rel="stylesheet" media="(min-width: 800px)" href="css/estilo.css">
        <script src="lib/jquery/jquery.min.js"></script>
        <script src="lib/bootstrap/js/bootstrap.min.js"></script>

        <link href="https://fonts.googleapis.com/css2?family=Tajawal&display=swap" rel="stylesheet">

        <meta charset = "UTF-8">

        <title>Projeto CPA</title>
    </head>

    <body>

        <header>

            <div id = "fundo">
                <img src = "css/fundo.jpg" alt = "">
            </div>

            <div class = "wrapper">
                <div class="imagem">
                    <img class = "cpa" src="img/cpa.png">
                </div>

                <div class="insert">
                    <form action="login_resp.php" method="post">
                        <h1>LOGIN</h1>
                        <br/>
                        <input class="caixa" type="text" name="user" placeholder="RA">
                        <br/><br/>        
                        <input class="caixa" type="text" name="senha" placeholder="Senha">
                        <br/><br/>
                        <input class="botão" type="submit" value="Login">
                        <br/><br/>
                    </form>
                    <div id = "rec">
                        <a class = "recuperacao" href=RecUsuario.html>Recuperar Senha</a>
                    </div>
                </div>
            </div>
        </header>
        <?php
        session_start();
        if (isset($_SESSION['message'])) {
            print $_SESSION['message'];
            $_SESSION['message'] = null;
        }
        ?>
    </body>
</html>