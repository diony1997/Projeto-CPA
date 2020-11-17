<?php

require_once './Conexao.php';

class Banco_preencher {

    private $linkDB;

    function __construct() {
        $this->linkDB = new Conexao("bankunovo");
    }

    function checarAluno($ra) {
        $sql = "SELECT * FROM `aluno` WHERE ra = '" . $ra . "'";
        $stmt = mysqli_prepare($this->linkDB->con, $sql);
        if (!$stmt) {
            die("Falha no comando SQL: Checar Aluno");
        }
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows != 0) {
            return true;
        } else {
            return false;
        }
    }

    function checarCurso($nome) {
        $sql = "SELECT * FROM `curso` WHERE nome = '" . $nome . "'";
        $stmt = mysqli_prepare($this->linkDB->con, $sql);
        if (!$stmt) {
            die("Falha no comando SQL: Checar Curso");
        }
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows != 0) {
            return true;
        } else {
            return false;
        }
    }

    function checarProf($nome) {
        $sql = "SELECT * FROM `professor` WHERE nome = '" . $nome . "'";
        $stmt = mysqli_prepare($this->linkDB->con, $sql);
        if (!$stmt) {
            die("Falha no comando SQL: Checar Professor");
        }
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows != 0) {
            return true;
        } else {
            return false;
        }
    }

    function checarDisc($nome, $nomeCurso) {
        $idCurso = $this->buscarCursoId($nomeCurso);
        $sql = "SELECT * FROM `disciplina` WHERE nome = '" . $nome . "' AND idCurso ='" . $idCurso . "'";
        $stmt = mysqli_prepare($this->linkDB->con, $sql);
        if (!$stmt) {
            die("Falha no comando SQL: Checar Disciplina");
        }
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows != 0) {
            return true;
        } else {
            return false;
        }
    }

    function inserirCurso($nome, $campus, $turno, $escola, $vertical, $escola_aim, $nivel, $tipo, $modalidade) {

        $sql = "INSERT INTO `curso` (`id`, `nome`, `campus`, `turno`, `escola`, `vertical`, `escola_aim`, `nivel`, `tipo`, `modalidade`)"
                . "VALUES (NULL, '" . $nome . "','" . $campus . "','" . $turno . "','" . $escola . "', '" . $vertical . "', '"
                . $escola_aim . "', '" . $nivel . "', '" . $tipo . "', '" . $modalidade . "')";

        $stmt = mysqli_prepare($this->linkDB->con, $sql);
        if (!$stmt) {
            die("Falha no comando SQL: Inserção Curso");
        }
        $stmt->execute();
    }

    function inserirAluno($ra, $nome, $email, $nomeCurso, $bloco, $dtnascimento, $genero, $semestre, $senha) {

        $idCurso = $this->buscarCursoId($nomeCurso);

        $sql = "INSERT INTO `aluno` (`ra`, `nome`, `email`, `idCurso`, `bloco`, `dtnascimento`, `genero`, `semestre`, `senha`)"
                . "VALUES ('" . $ra . "', '" . $nome . "','" . $email . "','" . $idCurso . "','" . $bloco . "', '" . $dtnascimento . "', '"
                . $genero . "', " . $semestre . ", '" . $senha . "')";

        $stmt = mysqli_prepare($this->linkDB->con, $sql);
        if (!$stmt) {
            die("Falha no comando SQL: Inserção Aluno");
        }
        $stmt->execute();
    }

    function inserirProf($nome) {

        $sql = "INSERT INTO `professor` (`id`, `nome`)"
                . "VALUES ( NULL, '" . $nome . "')";

        $stmt = mysqli_prepare($this->linkDB->con, $sql);
        if (!$stmt) {
            die("Falha no comando SQL: Inserção Professor");
        }
        $stmt->execute();
    }

    function inserirDisc($nomeCurso, $nome, $modelo, $tcc, $estagio, $nomeProf) {

        $idCurso = $this->buscarCursoId($nomeCurso);
        $idProf = $this->buscarProfId($nomeProf);


        $sql = "INSERT INTO `disciplina` (`id`, `idCurso`, `nome`, `modelo`, `tcc`, `estagio`, `idProfessor`)"
                . "VALUES ( NULL, '" . $idCurso . "', '" . $nome . "','" . $modelo . "','" . $tcc . "','" . $estagio . "','" . $idProf . "')";

        $stmt = mysqli_prepare($this->linkDB->con, $sql);
        if (!$stmt) {
            die("Falha no comando SQL: Inserção Disciplina");
        }
        $stmt->execute();
    }

    function buscarCursoId($nome) {
        $sql = "SELECT id FROM `curso` WHERE nome = '" . $nome . "'";
        $stmt = mysqli_prepare($this->linkDB->con, $sql);
        if (!$stmt) {
            die("Falha no comando SQL: Buscar Curso Id");
        }
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return $row["id"];
    }

    function buscarProfId($nome) {
        $sql = "SELECT id FROM `professor` WHERE nome = '" . $nome . "'";
        $stmt = mysqli_prepare($this->linkDB->con, $sql);
        if (!$stmt) {
            die("Falha no comando SQL: Buscar Professor Id");
        }
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return $row["id"];
    }

    function __destruct() {
        $this->linkDB = NULL;
    }

}
