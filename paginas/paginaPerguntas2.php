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
$banco->exibirPergunta();
$saida = $banco->exibirPergunta();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Pesquisa CPA</title>

        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" media="(max-width: 640px)" href="max-640px.css">
        <link rel="stylesheet" media="(min-width: 640px)" href="min-640px.css"> 
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet">
        <link rel="stylesheet" href="../lib/bootstrap/css/bootstrap.min.css" />
        <link rel="stylesheet" href="../css/estilo3.css" />
        <script src="../lib/jquery/jquery.min.js"></script>
        <script src="../lib/bootstrap/js/bootstrap.min.js"></script>
    </head>
    <body background="../img/fundoPagina.png">
        <header>
            <div>
                <img class="logo" src="../img/CPA_Logo_UAM.png" />
            </div>

        </header>
        <div class="pergunta">
            <form action="paginaPergunta2_resp.php" method="post">
                <h2 id="pergunta0" class="pergunta">Pergunta 1</h2>
                <div class="estrelas">
                    <input type="radio" id="cm_star-empty" name="fb" value="" />
                    <label for="cm_star-1"><i class="fa"></i></label>
                    <input type="radio" id="cm_star-1" name="fb" value="1" checked/>
                    <label for="cm_star-2"><i class="fa"></i></label>
                    <input type="radio" id="cm_star-2" name="fb" value="2"/>
                    <label for="cm_star-3"><i class="fa"></i></label>
                    <input type="radio" id="cm_star-3" name="fb" value="3"/>
                    <label for="cm_star-4"><i class="fa"></i></label>
                    <input type="radio" id="cm_star-4" name="fb" value="4"/>
                    <label for="cm_star-5"><i class="fa"></i></label>
                    <input type="radio" id="cm_star-5" name="fb" value="5"/>
                    <input type="hidden" id="id0" name="idfb1" value="0">
                    <div id="p0div1" class="tipo">
                        <input type="checkbox" name="fb1t1" value="on">
                        <label>Não tenho essa Disciplina</label>
                    </div>
                    <div id="p0div2" class="tipo">
                        <input type="checkbox" name="fb1t2" value="on">
                        <label>Não tenho aula com esse(a) professor(a)</label>
                    </div>
                </div>

                <h2 id="pergunta1" class="pergunta">Pergunta 2</h2>
                <div id = "divP2" class="estrelas">
                    <input type="radio" id="cm_star-empty" name="fb2" value=""/>
                    <label for="cm_star-6"><i class="fa"></i></label>
                    <input type="radio" id="cm_star-6" name="fb2" value="1" checked/>
                    <label for="cm_star-7"><i class="fa"></i></label>
                    <input type="radio" id="cm_star-7" name="fb2" value="2"/>
                    <label for="cm_star-8"><i class="fa"></i></label>
                    <input type="radio" id="cm_star-8" name="fb2" value="3"/>
                    <label for="cm_star-9"><i class="fa"></i></label>
                    <input type="radio" id="cm_star-9" name="fb2" value="4"/>
                    <label for="cm_star-10"><i class="fa"></i></label>
                    <input type="radio" id="cm_star-10" name="fb2" value="5"/>
                    <input type="hidden" id="id1" name="idfb2" value="0">
                    <div id="p1div1" class="tipo">
                        <input type="checkbox" name="fb2t1" value="on">
                        <label>Não tenho essa Disciplina</label>
                    </div>
                    <div id="p1div2" class="tipo">
                        <input type="checkbox" name="fb2t2" value="on">
                        <label>Não tenho aula com esse(a) professor(a)</label>
                    </div>
                </div>

                <h2 id="pergunta2" class="pergunta">Pergunta 3</h2>
                <div id = "divP3" class="estrelas">
                    <input type="radio" id="cm_star-empty" name="fb3" value=""/>
                    <label for="cm_star-11"><i class="fa"></i></label>
                    <input type="radio" id="cm_star-11" name="fb3" value="1" checked/>
                    <label for="cm_star-12"><i class="fa"></i></label>
                    <input type="radio" id="cm_star-12" name="fb3" value="2"/>
                    <label for="cm_star-13"><i class="fa"></i></label>
                    <input type="radio" id="cm_star-13" name="fb3" value="3"/>
                    <label for="cm_star-14"><i class="fa"></i></label>
                    <input type="radio" id="cm_star-14" name="fb3" value="4"/>
                    <label for="cm_star-15"><i class="fa"></i></label>
                    <input type="radio" id="cm_star-15" name="fb3" value="5"/>
                    <input type="hidden" id="id2" name="idfb3" value="0">
                    <div id="p2div1" class="tipo">
                        <input type="checkbox" name="fb3t1" value="on">
                        <label>Não tenho essa Disciplina</label>
                    </div>
                    <div id="p2div2" class="tipo">
                        <input type="checkbox" name="fb3t2" value="on">
                        <label>Não tenho aula com esse(a) professor(a)</label>
                    </div>
                </div>

                <h2 id="pergunta3" class="pergunta">Pergunta 4</h2>
                <div id = "divP4" class="estrelas">
                    <input type="radio" id="cm_star-empty" name="fb4" value=""/>
                    <label for="cm_star-16"><i class="fa"></i></label>
                    <input type="radio" id="cm_star-16" name="fb4" value="1" checked/>
                    <label for="cm_star-17"><i class="fa"></i></label>
                    <input type="radio" id="cm_star-17" name="fb4" value="2"/>
                    <label for="cm_star-18"><i class="fa"></i></label>
                    <input type="radio" id="cm_star-18" name="fb4" value="3"/>
                    <label for="cm_star-19"><i class="fa"></i></label>
                    <input type="radio" id="cm_star-19" name="fb4" value="4"/>
                    <label for="cm_star-20"><i class="fa"></i></label>
                    <input type="radio" id="cm_star-20" name="fb4" value="5"/>
                    <input type="hidden" id="id3" name="idfb4" value="0">
                    <div id="p3div1" class="tipo">
                        <input type="checkbox" name="fb4t1" value="on">
                        <label>Não tenho essa Disciplina</label>
                    </div>
                    <div id="p3div2" class="tipo">
                        <input type="checkbox" name="fb4t2" value="on">
                        <label>Não tenho aula com esse(a) professor(a)</label>
                    </div>
                </div>

                <h2 id="pergunta4" class="pergunta">Pergunta 5</h2>
                <div id = "divP5" class="estrelas">
                    <input type="radio" id="cm_star-empty" name="fb5" value=""/>
                    <label for="cm_star-21"><i class="fa"></i></label>
                    <input type="radio" id="cm_star-21" name="fb5" value="1" checked/>
                    <label for="cm_star-22"><i class="fa"></i></label>
                    <input type="radio" id="cm_star-22" name="fb5" value="2"/>
                    <label for="cm_star-23"><i class="fa"></i></label>
                    <input type="radio" id="cm_star-23" name="fb5" value="3"/>
                    <label for="cm_star-24"><i class="fa"></i></label>
                    <input type="radio" id="cm_star-24" name="fb5" value="4"/>
                    <label for="cm_star-25"><i class="fa"></i></label>
                    <input type="radio" id="cm_star-25" name="fb5" value="5"/>
                    <input type="hidden" id="id4" name="idfb5" value="0">
                    <div id="p4div1" class="tipo">
                        <input type="checkbox" name="fb5t1" value="on">
                        <label>Não tenho essa Disciplina</label>
                    </div>
                    <div id="p4div2" class="tipo">
                        <input type="checkbox" name="fb5t2" value="on">
                        <label>Não tenho aula com esse(a) professor(a)</label>
                    </div>
                </div>



                <div class="botao1">
                    <button class="botao" ><span>Enviar</span></button>
                </div>
            </form>
        </div>

        <script>
            pergunta();
            //checar se a segunda pergunta existe
            if (document.getElementById("id1").value == 0) {
                document.getElementById("divP2").style.display = "none";
                document.getElementById("pergunta1").style.display = "none";
            }
            if (document.getElementById("id2").value == 0) {
                document.getElementById("divP3").style.display = "none";
                document.getElementById("pergunta2").style.display = "none";
            }
            if (document.getElementById("id3").value == 0) {
                document.getElementById("divP4").style.display = "none";
                document.getElementById("pergunta3").style.display = "none";
            }
            if (document.getElementById("id4").value == 0) {
                document.getElementById("divP5").style.display = "none";
                document.getElementById("pergunta4").style.display = "none";
            }
            function pergunta() {
                var perguntas = <?php echo json_encode($saida); ?>;
                var pergunta = perguntas.split(";");
                //cada interação do for é uma pergunta
                for (var i = 0; i < pergunta.length - 1; i++) {
                    var conteudo = pergunta[i].split("#");
                    document.getElementById("id" + i).value = conteudo[0];
                    document.getElementById("pergunta" + i).innerHTML = conteudo[1];
                    if (conteudo[2] === "1") {
                        document.getElementById("p" + i + "div2").style.display = "none";
                    } else if (conteudo[2] === "2") {
                        document.getElementById("p" + i + "div1").style.display = "none";
                    } else {
                        document.getElementById("p" + i + "div1").style.display = "none";
                        document.getElementById("p" + i + "div2").style.display = "none";
                    }
                }
            }
        </script>
    </body>
</html>
