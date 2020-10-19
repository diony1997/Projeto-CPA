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
        //$result = $this->linkDB->con->query($sql);

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
    
    function buscarBloco(){
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

    function inserirResposta($valor, $idpergunta){
        //fazer update ou criar uma tabela resposta caso não exista
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
        $ra = $_SESSION['ra'];
        $sql = "SELECT idcurso FROM `aluno` WHERE ra = '" . $ra . "'";
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
            header('location:fim.html');
        }
        $disciplina = explode(";", $saida);
        unset($disciplina[sizeof($disciplina) - 1]);
        $disciplina = array_values($disciplina);
        $this->conferirJafeito($disciplina, $ra);
    }

    //confere se ja se o aluno ja respondeu as perguntas
    function conferirJafeito($disciplina, $ra) {
        for ($x = 0; $x < sizeof($disciplina); $x++) {
            $sql = "SELECT * FROM `aluno_resp` WHERE alunora = '" . $ra . "' and iddisciplina = '" . $disciplina[$x] . "'";
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
    }

    function buscarPergunta() {
        $disciplina = $_SESSION['disciplina'];
        if (empty($disciplina)) {
            header('location:fim.html');
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
        }
        $_SESSION['atual'] = $disciplina[0];
        unset($disciplina[0]);
        $disciplina = array_values($disciplina);
        $_SESSION['disciplina'] = $disciplina;
        return $saida;
    }

    function __destruct() {
        $this->linkDB = NULL;
    }

}
