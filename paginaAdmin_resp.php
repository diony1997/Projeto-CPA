
<?php

header('Content-Type: text/html; charset=UTF-8');
require_once './banco_preencher.php';

$banco = new Banco_preencher();
$flag = 0;

if (isset($_FILES['file']) && is_uploaded_file($_FILES['file']['tmp_name'])) {
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
    $flag = 1;
}

?>

<html>
    <head>
        <link rel="stylesheet" href="lib/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" media="(max-width: 900px)" href="css/estilo2.css">
        <script src="lib/jquery/jquery.min.js"></script>
        <script src="lib/bootstrap/js/bootstrap.min.js"></script>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet">
        <meta charset = "UTF-8">
        <title>Atualização do Banco</title>
    </head>

    <body background="img/fundoPagina.png">        
        <header>
            <div class="wrapper">
                <img class = "cpa" src="img/CPA_Logo_UAM.png"/>
                <div class="caption">
                    <?php   if($flag == 1){
                                echo "<h1>Arquivo Encontrado</h1>";
                                echo "<p>Os novos dados foram inseridos ao banco</p>";
                            } else {
                                echo "<h1>Arquivo Não Encontrado</h1>";
                                echo "<p>Verifique o arquivo selecionado</p>";
                            } 
                    ?>
                    
                    <br/><br/>
                    <form action="paginaAdmin.php">
                        <button type="submit" class="btn btn-success">VOLTAR AO INÍCIO</button></p>
                    </form>
                </div>
            </div>
        </header>
    </body>
</html>


