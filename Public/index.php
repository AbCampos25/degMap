<?php
 session_start();
   //ESTA E A PAGINA PRINCIPAL DO APP, RESPONSAVEL PELO GERENCIAMETO
  
   //INLUINDO ALGUNS ARQUIVOS NECESSARIOS
  include './../App/config.php';
  include './../App/autoload.php'; 
  

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=App_name?></title>
    <link rel="stylesheet" href="<?=URL?>/Public/Css/assets/fontawesome/css/all.min.css">
    <link href="<?=URL?>/Public/Css/bootstrap-5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?=URL?>/Public/Css/index.css">
</head>
<body>
<?php

    //INSTANCIANDO A CLASSE RESPONSAVEL PELOS CAMINHOS OU ROTAS
        new rota();
?>
  <script src="<?=URL?>/Public/Css/bootstrap-5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>