
<?php

header('Content-Type: text/html; charset=UTF-8');
require_once './banco_preencher.php';

$banco = new Banco_preencher();

if (isset($_FILES['file'])) {
    $caminho = $_FILES['file']['tmp_name'];
    $fp = fopen($caminho, "r");
    $cont = 0;
    while ($line = utf8_encode(fgets($fp))) {
        if ($cont > 0) {
            $arr = explode(";", $line);
            $semestre = substr(substr($arr[4], -3), 0, 2);
            $data = explode("/", $arr[13]);
            $dtPadrao = $data[2] . "-" . $data[1] . "-" . $data[0];

            if (!$banco->checarCurso($arr[3])) {
                $banco->inserirCurso($arr[3], $arr[5], $arr[6], $arr[7], $arr[8], $arr[9], $arr[10], $arr[11], $arr[12]);
            }
            if (!$banco->checarAluno($arr[1])) {
                $banco->inserirAluno($arr[1], $arr[0], $arr[2], $arr[3], $arr[4], $dtPadrao, $arr[14], $semestre, "123456");
            }
            for ($i = 21; $i <= 96; $i += 6) {
                if (strcmp($arr[$i - 5], "NULL") != 0) {
                    if (!$banco->checarProf($arr[$i])) {
                        $banco->inserirProf($arr[$i]);
                    }
                    if (!$banco->checarDisc($arr[$i - 3], $arr[3])) {
                        $banco->inserirDisc($arr[3], $arr[$i - 3], $arr[$i - 4], $arr[$i - 2], $arr[$i - 1], $arr[$i]);
                    }
                }
            }
        }
        $cont++;
    }
    echo "Dados Inseridos";

} else {
    echo 'Erro: Arquivo Não Encontrado';
}

?>


