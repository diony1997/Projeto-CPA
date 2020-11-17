<?php
session_start();

if (empty($_SESSION['user']) and empty($_SESSION['senha'])) {
    header('Location: loginUser.php');
}
require_once 'banco.php';
$banco = new Banco();
?>
<html>
    <head>
        <meta charset="utf-8">
        <title>Pesquisa CPA</title>

        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" media="(max-width: 640px)" href="max-640px.css">
        <link rel="stylesheet" media="(min-width: 640px)" href="min-640px.css"> 
        <link rel="stylesheet" href="../lib/bootstrap/css/bootstrap.min.css" />
        <link rel="stylesheet" href="../css/estilo4.css" />
        <script src="../lib/jquery/jquery.min.js"></script>
        <script src="../lib/bootstrap/js/bootstrap.min.js"></script>
    </head>
    <body background="../img/fundoPagina.png">
        <div class="header">
            <img class="logo" src="../img/CPA_Logo_UAM.png" />

            <div class="logout">
                <form action="paginaAdmin.php">
                    <button type="submit" class="botao" ><span>Voltar</span></button>
                </form>
            </div>
        </div>
        <div class="formulario">
            <form action="paginaAddPergunta_resp.php" method="post">
                <div id='curso'>
                    <?php
                    $banco->impressao_curso();
                    ?>
                </div>
                <p>Pergunta</p>
                <textarea id="oo" name=pergunta required></textarea>
                <div id='disciplina'>
                </div>
                <div id='professor'>
                </div>
                <p>Tipo de pergunta</p>
                <select name="tipo" id='tipo' onchange="atualizar()">
                    <option value=3>Infraestrutura</option>
                    <option value=2>Professor</option>
                    <option value=1>Disciplina</option>
                </select>
                <p>Data inicial</p>
                <input type="date" name="dataInicial" placeholder="YYYY-MM-DD" required>
                <p>Data final</p>
                <input type="date" name="dataFinal" placeholder="YYYY-MM-DD" required>
                <br><br>
                <input type="submit" value="Enviar">
            </form>
        </div>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <script>
                    atualizar();
                    function atualizar() {
                        if (document.getElementById("tipo").value == 3) {
                            document.getElementById('disciplina').style.display = "none";
                            document.getElementById('professor').style.display = "none";
                        } else if (document.getElementById("tipo").value == 2) {
                            document.getElementById('disciplina').style.display = "none";
                            document.getElementById('professor').style.display = "block";
                        } else {
                            document.getElementById('disciplina').style.display = "block";
                            document.getElementById('professor').style.display = "block";
                        }
                        atualizarDisc(document.getElementById("opCurso").value);
                    }
                    function atualizarDisc(valor) {
                        $.ajax({
                            url: "banco_select.php",
                            type: "POST",
                            data: {tipo: 4, curso: valor},
                            dataType: "html"

                        }).done(function (resposta) {
                            document.getElementById("disciplina").innerHTML = resposta;
                            if (document.getElementById("helper")) {
                                document.getElementById("professor").innerHTML = "<p>Professor</p><h4>Nenhum Professor Encontrado</h4>";
                            } else {
                                atualizarProf(document.getElementById("disc2").value);
                            }
                        }).fail(function (jqXHR, textStatus) {
                            //Não Implementado

                        }).always(function () {
                            //Não Implementado
                        });
                    }

                    function atualizarProf(valor) {

                        $.ajax({
                            url: "banco_select.php",
                            type: "POST",
                            data: {tipo: document.getElementById("tipo").value, disciplina: valor, curso: document.getElementById("opCurso").value},
                            dataType: "html"

                        }).done(function (resposta) {

                            document.getElementById("professor").innerHTML = resposta;
                        }).fail(function (jqXHR, textStatus) {
                            //Não Implementado
                        }).always(function () {
                            //Não Implementado
                        });
                    }


        </script>
    </body>
</html>
