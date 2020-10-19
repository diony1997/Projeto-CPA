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
            die("Falha no comando SQL");
        }
        $stmt->execute();
        $stmt->store_result();
        session_start();
        if ($stmt->num_rows != 0) {
            $_SESSION['ra'] = $ra;
            $_SESSION['senha'] = $senha;
            $this->buscarDisciplina();
            $this->buscarBloco($ra);
            header('location: paginaPerguntas2.php');
        } else {
            unset($_SESSION['ra']);
            unset($_SESSION['senha']);
            $_SESSION['message'] = "<script>alert('Senha Inválida');</script>";
            header("Location: login.php?");
        }
    }

    function checarRA($ra) {
        $sql = "SELECT * FROM `aluno` WHERE ra = '" . $ra . "'";
        $stmt = mysqli_prepare($this->linkDB->con, $sql);
        if (!$stmt) {
            die("Falha no comando SQL");
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
            die("Falha no comando SQL");
        }
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $_SESSION['bloco'] = $row["bloco"];
    }

    function inserirPergunta($id, $pergunta, $materia) {
        $sql = "INSERT INTO `perguntas` (`id`, `pergunta`, `materia`) VALUES ('" . $id . "','" . $pergunta . "','" . $materia . "')";
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

    function buscarDisciplina() {
        //buscar o curso pelo ra
        $sql = "SELECT idcurso FROM `aluno` WHERE ra = '" . $_SESSION['ra'] . "'";
        $stmt = mysqli_prepare($this->linkDB->con, $sql);
        if (!$stmt) {
            die("Falha no comando SQL");
        }
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $curso = $row["idcurso"];

        //busca as diciplinas pelo curso
        $sql = "SELECT id FROM `disciplina` WHERE idcurso = '" . $curso . "'";
        $stmt = mysqli_prepare($this->linkDB->con, $sql);
        if (!$stmt) {
            die("Falha no comando SQL");
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
        $disciplina = explode(";", $saida);
        unset($disciplina[sizeof($disciplina) - 1]);
        $disciplina = array_values($disciplina);
        $this->conferirJafeito($disciplina);
    }

    //confere se ja se o aluno ja respondeu as perguntas
    function conferirJafeito($disciplina) {
        for ($x = 0; $x < sizeof($disciplina); $x++) {
            $sql = "SELECT * FROM `aluno_resp` WHERE alunora = '" . $_SESSION['ra'] . "' and iddisciplina = '" . $disciplina[$x] . "'";
            $stmt = mysqli_prepare($this->linkDB->con, $sql);
            if (!$stmt) {
                die("Falha no comando SQL");
            }
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                unset($disciplina[$x]);
                $disciplina = array_values($disciplina);
                $x--;
            }
        }
        $_SESSION['disciplina'] = $disciplina;
        $_SESSION['checar'] = TRUE;
    }

    function buscarPergunta() {
        $disciplina = $_SESSION['disciplina'];
        if (empty($disciplina)) {
            header('location:fim.php');
        } else {
            $sql = "SELECT id,conteudo FROM `pergunta` WHERE iddisciplina = '" . $disciplina[0] . "'";
            $stmt = mysqli_prepare($this->linkDB->con, $sql);
            if (!$stmt) {
                die("Falha no comando SQL");
            }
            $stmt->execute();
            $result = $stmt->get_result();
            $saida = "";
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $saida .= $row["id"] . "#" . $row["conteudo"] . ";";
                }
            }

            $_SESSION['atual'] = $disciplina[0];
            if ($_SESSION['checar'] == FALSE) {
                $_SESSION['checar'] = TRUE; //variavel para checar o formulario foi enviado ou não
                unset($disciplina[0]);
                $disciplina = array_values($disciplina);
                $_SESSION['disciplina'] = $disciplina;
            }
            return $saida;
        }
    }

    function inserirResposta($valor, $idpergunta) {
        $this->checarTabelaResp($idpergunta);
        $sql = "UPDATE `resposta` SET `valor` = (valor + " . $valor . "), `cont` = (cont + 1) WHERE `resposta`.`bloco` = '" . $_SESSION['bloco'] . "' AND `resposta`.`idpergunta` = '" . $idpergunta . "' AND `resposta`.`iddisciplina` = '" . $_SESSION['atual'] . "'";
        $stmt = mysqli_prepare($this->linkDB->con, $sql);
        if (!$stmt) {
            die("Falha no comando SQL");
        }
        $stmt->execute();
    }

    //gerar uma relação entre o ra e a disciplina para sinalizar que o aluno ja respondeu
    function gerarRelacao() {
        $sql = "INSERT INTO `aluno_resp` (`alunora`, `iddisciplina`) VALUES ('" . $_SESSION['ra'] . "', '" . $_SESSION['atual'] . "')";
        $stmt = mysqli_prepare($this->linkDB->con, $sql);
        if (!$stmt) {
            die("Falha no comando SQL");
        }
        $stmt->execute();
    }

    function gerarRelatorio($bloco) {
        $sql = "SELECT disciplina.nome as Discplina, pergunta.conteudo as Pergunta, (resposta.valor/resposta.cont) as Media ,resposta.cont as QTD_Respostas from disciplina\n"
                . "inner JOIN pergunta on disciplina.id = pergunta.iddisciplina\n"
                . "INNER JOIN resposta on resposta.idpergunta = pergunta.id\n"
                . "where bloco = '" . $bloco . "'";
        $stmt = mysqli_prepare($this->linkDB->con, $sql);
        if (!$stmt) {
            die("Falha no comando SQL");
        }
        $stmt->execute();
        $result = $stmt->get_result();
        $saida = "";
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<br>" . print_r($row) . "</br>";
            }
        } else {
            echo 'Bloco invalido';
        }
    }

    //função para conferir se existe a tabela de resposta
    function checarTabelaResp($idpergunta) {
        $sql = "SELECT * FROM `resposta` WHERE bloco = '" . $_SESSION['bloco'] . "' && idpergunta = '" . $idpergunta . "' && iddisciplina = '" . $_SESSION['atual'] . "'";
        $stmt = mysqli_prepare($this->linkDB->con, $sql);
        if (!$stmt) {
            die("Falha no comando SQL");
        }
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows < 1) {
            $sql = "INSERT INTO `resposta` (`bloco`, `idpergunta`, `iddisciplina`) VALUES ('" . $_SESSION['bloco'] . "','" . $idpergunta . "','" . $_SESSION['atual'] . "')";
            $stmt = mysqli_prepare($this->linkDB->con, $sql);
            if (!$stmt) {
                die("Falha no comando SQL");
            }
            $stmt->execute();
        }
    }

    function __destruct() {
        $this->linkDB = NULL;
    }

}
