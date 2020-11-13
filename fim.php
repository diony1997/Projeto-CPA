<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>Pesquisa CPA</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" media="(max-width: 640px)" href="max-640px.css">
        <link rel="stylesheet" media="(min-width: 640px)" href="min-640px.css">
        <link rel="stylesheet" href="lib/bootstrap/css/bootstrap.min.css" />
        <link rel="stylesheet" href="css/estilo3.css" />
        <script src="lib/jquery/jquery.min.js"></script>
        <script src="lib/bootstrap/js/bootstrap.min.js"></script>
    </head>
    <body background="img/fundoPagina.png">
        <header>
            <div>
                <img class="logo" src="img/CPA_Logo_UAM.png" />
            </div>
        </header>
        
        <div class="fim">
            
            <h2 class="fim">Fim</h2>
            <h2 class="fim">Agradecemos a participação!</h2>
            
        </div>
    </body>
</html>
<?php
session_start();
if (empty($_SESSION['ra']) and empty($_SESSION['senha'])) {
    header('location:login.php');
}
session_unset();
?>
