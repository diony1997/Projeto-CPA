<?php

require_once './Conexao.php';

class Banco {

    private $linkDB;

    function __construct() {
        $this->linkDB = new Conexao("bankunovo");
    }

    function login($ra,$senha) {
        
        $sql = "SELECT * FROM `registro` WHERE nome = '".$ra."' && codigo = '".$senha."'";

        $result = $this->linkDB->con->query($sql);
        if ($result->num_rows != 0) {
            return true;
        } else {
            return false;
        }
    }

    function checarRA($ra){
        $sql = "SELECT * FROM `registro` WHERE nome = '".$ra."'";

        $result = $this->linkDB->con->query($sql);
        if ($result->num_rows != 0) {
            return true;
        } else {
            return false;
        }
    }
    
    function inserirPergunta() {
        
    }

    function buscarPergunta() {
        
    }

    function __destruct() {
        $this->linkDB = NULL;
    }

}
