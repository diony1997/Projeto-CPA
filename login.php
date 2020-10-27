
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
                <img src = "img/fundo.jpg" alt = "">
            </div>

            <div class = "wrapper">
                <div class="imagem">
                    <img class = "cpa" src="img/CPA_Logo_UAM.png">
                </div>

                <div class="insert">
                    <form action="login_resp.php" method="post">
                        <h1>LOGIN</h1>
                        <br/>
                        <input class="caixa" type="text" name="user" placeholder="RA" />
                        <br/><br/>
                        <input class="caixa" type="password" name="senha" placeholder="Senha" />
                        <br/><br/>    
                        <input class="botão" type="button" value="Login" />
                        <br/><br/>
                     </form>
                        <?php
                    session_start();
                    if (isset($_SESSION['loginerror'])) {
                        if ($_SESSION['loginerror'] == 1) {
                            echo '<span style="color:#B22222;text-align:center;">RA inválido</span>';
                        } 
                        if($_SESSION['loginerror'] == 2){
                            echo '<span style="color:#B22222;text-align:center;">Senha inválida</span>';
                        }
                    }
                    session_unset();
                    ?>
                </div>
            </div>
        </header>

    </body>
</html>
