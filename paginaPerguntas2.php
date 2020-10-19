<html>
    <head>
        <meta charset="utf-8">
        <title>Pesquisa CPA</title>

        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" media="(max-width: 640px)" href="max-640px.css">
        <link rel="stylesheet" media="(min-width: 640px)" href="min-640px.css"> 
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet">
        <link rel="stylesheet" href="lib/bootstrap/css/bootstrap.min.css" />
        <link rel="stylesheet" href="css/estilo3.css" />
        <script src="lib/jquery/jquery.min.js"></script>
        <script src="lib/bootstrap/js/bootstrap.min.js"></script>
    </head>
    <body background="img/fundoPagina.png">
        <header>
            <div>
                <img class="logo" src="img/CPA_Logo_UAM.png" />
            </div>

        </header>
        <div class="pergunta">
            <form action="paginaPergunta2_resp.php" method="post">
                <h2 id="pergunta0" class="pergunta">Sua experiência de aprendizagem nas aulas remotas (ao vivo)</h2>

                <div class="estrelas">
                    <input type="radio" id="cm_star-empty" name="fb" value="" checked/>
                    <label for="cm_star-1"><i class="fa"></i></label>
                    <input type="radio" id="cm_star-1" name="fb" value="1"/>
                    <label for="cm_star-2"><i class="fa"></i></label>
                    <input type="radio" id="cm_star-2" name="fb" value="2"/>
                    <label for="cm_star-3"><i class="fa"></i></label>
                    <input type="radio" id="cm_star-3" name="fb" value="3"/>
                    <label for="cm_star-4"><i class="fa"></i></label>
                    <input type="radio" id="cm_star-4" name="fb" value="4"/>
                    <label for="cm_star-5"><i class="fa"></i></label>
                    <input type="radio" id="cm_star-5" name="fb" value="5"/>
                    <input type="hidden" id="id0" name="idfb1" value="0">
                </div>

                <h2 id="pergunta1" class="pergunta">Desempenho geral do professor</h2>

                <div class="estrelas">
                    <input type="radio" id="cm_star-empty" name="fb2" value="" checked/>
                    <label for="cm_star-6"><i class="fa"></i></label>
                    <input type="radio" id="cm_star-6" name="fb2" value="1"/>
                    <label for="cm_star-7"><i class="fa"></i></label>
                    <input type="radio" id="cm_star-7" name="fb2" value="2"/>
                    <label for="cm_star-8"><i class="fa"></i></label>
                    <input type="radio" id="cm_star-8" name="fb2" value="3"/>
                    <label for="cm_star-9"><i class="fa"></i></label>
                    <input type="radio" id="cm_star-9" name="fb2" value="4"/>
                    <label for="cm_star-10"><i class="fa"></i></label>
                    <input type="radio" id="cm_star-10" name="fb2" value="5"/>
                    <input type="hidden" id="id1" name="idfb2" value="0">
                </div>


                <div class="botao1">
                    <button class="botao" ><span>Enviar</span></button>
                </div>
            </form>
        </div>
        <?php
        session_start();
        
        require_once 'banco.php';
        $banco = new Banco();
        /*
         * chama duas vezes(solução provisoria para atualizar o vetor de disciplina)
         * inseri um if para checar se é a primeira vez que executa mas mesmo assim não funciona
         * se retirar o if caso algum atualize a pagina vai marcar como feito e se não chamar
         * duas vezes o usuario tem que da f5 para mostrar as perguntas corretas
         */
        $banco->buscarPergunta();
        $saida = $banco->buscarPergunta();
        ?>
        <script>
            pergunta();
            function pergunta() {
                var perguntas = <?php echo json_encode($saida); ?>;
                var pergunta = perguntas.split(";");
                //cada interação do for é uma pergunta
                for (var i = 0; i < pergunta.length - 1; i++) {
                    var conteudo = pergunta[i].split("#");
                    document.getElementById("id" + i).value = conteudo[0];
                    document.getElementById("pergunta" + i).innerHTML = conteudo[1];
                }
            }
        </script>
    </body>
</html>
