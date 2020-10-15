<?php

require_once './Conexao.php';

class Banco {

    private $linkDB;

    function __construct() {
        $this->linkDB = new Conexao("bankunovo");
    }

    function login($ra, $senha) {
        $sql = "SELECT * FROM `aluno` WHERE RA = '" . $ra . "' && Password = '" . $senha . "'";

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
            header('location: index.php');
        } else {
            unset ($_SESSION['ra']);
            unset ($_SESSION['senha']);
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

    function inserirPergunta($id, $pergunta, $materia) {
        $sql = "INSERT INTO `perguntas` (`id`, `pergunta`, `materia`) VALUES ('" . $id . "','" . $pergunta . "','" . $materia . "')";
        $stmt = mysqli_prepare($this->linkDB->con, $sql);
        if (!$stmt) {
            die("Falha no comando SQL");
        }
        $stmt->execute();
    }

    function apagarPergunta($id) {
        $sql = "DELETE FROM `perguntas` WHERE `perguntas`.`id` = " . $id;
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

    function buscarPergunta($materia) {
        $sql = "SELECT pergunta FROM `perguntas` WHERE materia = '" . $materia . "'";
        $stmt = mysqli_prepare($this->linkDB->con, $sql);
        if (!$stmt) {
            die("Falha no comando SQL");
        }
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "Pergunta: " . $row["pergunta"] . "<br>";
            }
        } else {
            echo "Não ha perguntas";
        }
    }

    function __destruct() {
        $this->linkDB = NULL;
    }

}
