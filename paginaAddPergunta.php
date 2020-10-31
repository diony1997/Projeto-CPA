<?php
session_start();
require_once 'banco.php';
$banco = new Banco();
$curso = filter_input(INPUT_POST, 'cursoAdd');
$disc = filter_input(INPUT_POST, 'disciplina');
?>
<html>
    <head>
        <meta charset="utf-8">
        <title>Pesquisa CPA</title>

        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" media="(max-width: 640px)" href="max-640px.css">
        <link rel="stylesheet" media="(min-width: 640px)" href="min-640px.css"> 
        <link rel="stylesheet" href="lib/bootstrap/css/bootstrap.min.css" />
        <link rel="stylesheet" href="css/estilo4.css" />
        <script src="lib/jquery/jquery.min.js"></script>
        <script src="lib/bootstrap/js/bootstrap.min.js"></script>
    </head>
    <body background="img/fundoPagina.png">
        <div class="header">
            <img class="logo" src="img/CPA_Logo_UAM.png" />

            <div class="logout">
                <button class="botao" ><span>Sair</span></button>
            </div>
        </div>
        <div class="formulario">
            <form action="paginaAddPergunta_resp.php" method="post">

                <p>Pergunta</p>
                <textarea name=pergunta required></textarea>
                <div id='disciplina'>
                    <p>Disciplina</p>
                    <?php
                    $banco->impressao_disciplina($curso);
                    ?>
                </div>
                <div id='professor'>
                    <p>Professor</p>
                    <?php
                    $banco->impressao_professor($curso);
                    ?>
                </div>
                <p>Tipo de pergunta</p>
                <select name="tipo" id='tipo' onclick="atualizar()">
                    <option value=1>Disciplina</option>
                    <option value=2>Professor</option>
                    <option value=3>Infraestrutura</option>
                </select>
                <p>Data inicial</p>
                <input type="date" name="dataInicial" placeholder="YYYY-MM-DD" required>
                <p>Data final</p>
                <input type="date" name="dataFinal" placeholder="YYYY-MM-DD" required>
                <br><br><input type="submit" value="Enviar">
            </form>
        </div>
        <script>
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
            }
            function atualizarDisc(){
                
            }
            

        </script>
    </body>
</html>
