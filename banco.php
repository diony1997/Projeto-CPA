<?php

require_once './Conexao.php';

class Banco {

    private $linkDB;

    function __construct() {
        $this->linkDB = new Conexao("bankunovo");
    }

    function login($ra, $senha) {
        $sql = "SELECT * FROM `aluno` WHERE RA = '" . $ra . "' && senha = '" . $senha . "'";
        $stmt = mysqli_prepare($this->linkDB->con, $sql);
        if (!$stmt) {
            die("Falha no comando SQL: COnferir RA e Senha");
        }
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows != 0) {
            $_SESSION['ra'] = $ra;
            $_SESSION['senha'] = $senha;
            $this->buscarPerguntas();
            $this->buscarBloco($ra);
            header('location: paginaPerguntas2.php');
        } else {
            unset($_SESSION['ra']);
            unset($_SESSION['senha']);
            $_SESSION['loginerror'] = 2;
            header('Location: login.php');
        }
    }

    function checarRA($ra) {
        $sql = "SELECT * FROM `aluno` WHERE ra = '" . $ra . "'";
        $stmt = mysqli_prepare($this->linkDB->con, $sql);
        if (!$stmt) {
            die("Falha no comando SQL: Checar RA");
        }
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows != 0) {
            return true;
        } else {
            return false;
        }
    }

    function buscarBloco() {
        $sql = "SELECT bloco FROM `aluno` WHERE ra = '" . $_SESSION['ra'] . "'";
        $stmt = mysqli_prepare($this->linkDB->con, $sql);
        if (!$stmt) {
            die("Falha no comando SQL: Buscar Aluno.Bloco");
        }
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $_SESSION['bloco'] = $row["bloco"];
    }

    function inserirPergunta($pergunta, $materia) {
        $sql = "INSERT INTO `perguntas` (`pergunta`, `materia`) VALUES ('" . $pergunta . "','" . $materia . "')";
        $stmt = mysqli_prepare($this->linkDB->con, $sql);
        if (!$stmt) {
            die("Falha no comando SQL");
        }
        $stmt->execute();
    }

    function alterarSenha($ra, $senhaOld, $senhaNew) {
        if (login($ra, $senhaOld)) {
            //senha antiga igual
            //Implementar
        } else {
            $sql = "UPDATE `aluno` SET `Password` = '" . $senhaNew . "' WHERE `aluno`.`RA` = '" . $ra . "'";
            $stmt = mysqli_prepare($this->linkDB->con, $sql);
            if (!$stmt) {
                die("Falha no comando SQL");
            }
            $stmt->execute();
        }
    }

    //busca todas perguntas disponiveis no curso
    function buscarPerguntas() {
        $data_atual = date('Y-m-d');
        //buscar o curso pelo ra
        $sql = "SELECT idcurso FROM `aluno` WHERE ra = '" . $_SESSION['ra'] . "'";
        $stmt = mysqli_prepare($this->linkDB->con, $sql);
        if (!$stmt) {
            die("Falha no comando SQL: buscarPerguntas() buscar Curso");
        }
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $curso = $row["idcurso"];

        //busca as perguntas do curso
        $sql = "SELECT id FROM `pergunta` WHERE idCurso = '" . $curso . "' and dataInicial <= '" . $data_atual . "' and dataFinal > '" . $data_atual . "'";
        $stmt = mysqli_prepare($this->linkDB->con, $sql);
        if (!$stmt) {
            die("Falha no comando SQL: busca das perguntas " . $data_atual);
        }
        $stmt->execute();
        $result = $stmt->get_result();
        $saida = "";
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $saida .= $row["id"] . ";";
            }
        } else {
            header('location:fim.php');
        }
        $pergunta = explode(";", $saida);
        unset($pergunta[sizeof($pergunta) - 1]);
        $pergunta = array_values($pergunta);
        $this->conferirJafeito($pergunta);
    }

    //confere se ja se o aluno ja respondeu as perguntas
    function conferirJafeito($pergunta) {
        for ($x = 0; $x < sizeof($pergunta); $x++) {
            $sql = "SELECT * FROM `aluno_resp` WHERE alunora = '" . $_SESSION['ra'] . "' and idPergunta = '" . $pergunta[$x] . "'";
            $stmt = mysqli_prepare($this->linkDB->con, $sql);
            if (!$stmt) {
                die("Falha no comando SQL: Buscar Aluno_Resp");
            }
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                unset($pergunta[$x]);
                $pergunta = array_values($pergunta);
                $x--;
            }
        }
        $_SESSION['pergunta'] = $pergunta;
        $_SESSION['checar'] = TRUE;
    }

    //retorna uma string com todas perguntas encontradas
    function exibirPergunta() {
        $pergunta = $_SESSION['pergunta'];
        //para checar se buscou duas perguntas
        $pergunta2 = $pergunta3 = $pergunta4 = $pergunta5 = FALSE;
        $saida = "";
        if (empty($pergunta)) {
            header('location:fim.php');
        } else {
            $saida .= $this->pergunta($pergunta[0]);
            //confere se existe uma pergunta adicional no array
            if (sizeof($pergunta) > 1) {
                $pergunta2 = TRUE;
                $saida .= $this->pergunta($pergunta[1]);
            }
            if (sizeof($pergunta) > 2) {
                $pergunta3 = TRUE;
                $saida .= $this->pergunta($pergunta[2]);
            }
            if (sizeof($pergunta) > 3) {
                $pergunta4 = TRUE;
                $saida .= $this->pergunta($pergunta[3]);
            }
            if (sizeof($pergunta) > 4) {
                $pergunta5 = TRUE;
                $saida .= $this->pergunta($pergunta[4]);
            }

            if ($_SESSION['checar'] == FALSE) {
                $_SESSION['checar'] = TRUE; //variavel para checar o formulario foi enviado ou não
                //Retirar do vetor as perguntas exibidas
                unset($pergunta[0]);
                if ($pergunta2) {
                    unset($pergunta[1]);
                }
                if ($pergunta3) {
                    unset($pergunta[2]);
                }
                if ($pergunta4) {
                    unset($pergunta[3]);
                }
                if ($pergunta5) {
                    unset($pergunta[4]);
                }
                $pergunta = array_values($pergunta);
                $_SESSION['pergunta'] = $pergunta;
            }
            return $saida;
        }
    }

    //retorna uma String: idPergunta, Conteudo
    function pergunta($idpergunta) {
        $saida = "";
        $sql = "SELECT id,conteudo FROM `pergunta` WHERE id = '" . $idpergunta . "'";
        $stmt = mysqli_prepare($this->linkDB->con, $sql);
        if (!$stmt) {
            die("Falha no comando SQL: select pergunta " . $idpergunta);
        }
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $saida .= $row["id"] . "#" . $row["conteudo"] . ";";
        }
        return $saida;
    }

    function inserirResposta($valor, $idpergunta) {
        $this->checarTabelaResp($idpergunta);
        $sql = "UPDATE `resposta` SET `valor` = (valor + " . $valor . "), `cont` = (cont + 1) WHERE `resposta`.`blocoturma` = '" . $_SESSION['bloco'] . "' AND `resposta`.`idPergunta` = '" . $idpergunta . "'";
        $stmt = mysqli_prepare($this->linkDB->con, $sql);
        if (!$stmt) {
            die("Falha no comando SQL: Update resposta");
        }
        $stmt->execute();
    }

    //gerar uma relação entre o ra e a disciplina para sinalizar que o aluno ja respondeu
    function gerarRelacao($idpergunta) {
        $sql = "INSERT INTO `aluno_resp` (`alunora`, `idPergunta`) VALUES ('" . $_SESSION['ra'] . "', '" . $idpergunta . "')";
        $stmt = mysqli_prepare($this->linkDB->con, $sql);
        if (!$stmt) {
            die("Falha no comando SQL: gerar Relação aluno_resp");
        }
        $stmt->execute();
    }

    function gerarRelatorio($bloco) {
        $sql = "SELECT curso.nome as Curso, pergunta.conteudo as Pergunta, replace(resposta.valor/resposta.cont,'.',',') as Media ,resposta.cont as QTD_Respostas, resposta.blocoturma as Bloco from resposta\n"
                . "inner JOIN pergunta on pergunta.id = resposta.idPergunta\n"
                . "INNER JOIN curso on curso.id = pergunta.idCurso\n"
                . "where blocoturma = '" . $bloco . "'";
        $stmt = mysqli_prepare($this->linkDB->con, $sql);
        if (!$stmt) {
            die("Falha no comando SQL: Gerar relatorio");
        }
        $stmt->execute();
        $result = $stmt->get_result();
        $tabela = $this->criarTabela();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
//                $saida .= $row["Curso"] . '#' . $row["Pergunta"] . "#" . $row["Media"] . "#" . $row["QTD_Respostas"] . ";";
                $tabela = $this->inserirTabela($row, $tabela);
            }
        } else {
            echo 'Bloco invalido';
        }
        $tabela = $this->fecharTabela($tabela);
        return $tabela;
    }

    //função para conferir se existe a tabela de resposta
    function checarTabelaResp($idpergunta) {
        $sql = "SELECT * FROM `resposta` WHERE blocoturma = '" . $_SESSION['bloco'] . "' && idPergunta = '" . $idpergunta . "'";
        $stmt = mysqli_prepare($this->linkDB->con, $sql);
        if (!$stmt) {
            die("Falha no comando SQL: checar tabela resposta");
        }
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows < 1) {
            $sql = "INSERT INTO `resposta` (`blocoturma`, `idPergunta`) VALUES ('" . $_SESSION['bloco'] . "','" . $idpergunta . "')";
            $stmt = mysqli_prepare($this->linkDB->con, $sql);
            if (!$stmt) {
                die("Falha no comando SQL: inserir tabela resposta");
            }
            $stmt->execute();
        }
    }

    function criarTabela() {
        $tabela = '<table id="Relatorio" border="1">'; //abre table
        $tabela .= '<thead>'; //abre cabeçalho
        $tabela .= '<tr>'; //abre uma linha
        $tabela .= '<th>Curso</th>'; // colunas do cabeçalho
        $tabela .= '<th>Pergunta</th>';
        $tabela .= '<th>Média</th>';
        $tabela .= '<th>Quantidade de Respostas</th>';
        $tabela .= '<th>Bloco</th>';
        $tabela .= '</tr>'; //fecha linha
        $tabela .= '</thead>'; //fecha cabeçalho
        $tabela .= '<tbody>'; //abre corpo da tabela

        return $tabela;
    }

    function inserirTabela($row, $tabela) {
        $tabela .= '<tr>'; // abre uma linha
        $tabela .= '<td>' . $row["Curso"] . '</td>';
        $tabela .= '<td>' . $row["Pergunta"] . '</td>';
        $tabela .= '<td>' . $row["Media"] . '</td>';
        $tabela .= '<td>' . $row["QTD_Respostas"] . '</td>';
        $tabela .= '<td>' . $row["Bloco"] . '</td>';
        $tabela .= '</tr>'; // fecha linha

        return $tabela;
    }

    function fecharTabela($tabela) {
        $tabela .= '</tbody>'; //fecha corpo
        $tabela .= '</table>'; //fecha tabela

        return $tabela;
    }

    function __destruct() {
        $this->linkDB = NULL;
    }

}
