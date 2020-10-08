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

        if ($stmt->num_rows != 0) {
            return true;
        } else {
            return false;
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

    function inserirPergunta() {
        
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
            while($row = $result->fetch_assoc()){
                echo "Pergunta: ".$row["pergunta"]."<br>";
            }
        } else {
            echo "Não ha perguntas";
        }
    }

    function __destruct() {
        $this->linkDB = NULL;
    }

}
