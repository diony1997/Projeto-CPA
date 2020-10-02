<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
            $cod = $_POST['codigo'];
            $nome = $_POST['nome'];
            $con = mysqli_connect("localhost", "root", "", "bankunovo");
        if (!$con) {
            echo 'Mission Failed<br>';
        }
       // $sql = "insert into registro values".
        //        "(" . $cod . " , '" . $nome . " )";
        $sql = "insert into registro values(".$cod.",'".$nome."')";
        if (mysqli_query($con, $sql)) {
            echo 'Salvado<br>';
        } else {
            echo 'Não Salvado F<br>';
        }
        
        mysqli_close($con);
        ?>
    </body>
</html>
