<?php

/** Classe para prover a conexao com o BD */
class Conexao {

    private $con;

    function __construct($nameDB) {
        $this->con = mysqli_connect("localhost", "root", "", $nameDB);
        if (!$this->con) {
            die('<h1>Falha na conexao</h1>');
        }
    }

    function __destruct() {
        mysqli_close($this->con);
    }

    function __get($name) {
        return $this->con;
    }

}
