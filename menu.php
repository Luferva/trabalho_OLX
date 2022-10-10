<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OLX - Menu</title>
</head>

<body>
<?php
require('config.php');
require('verifica.php');

?>
<nav>
    <a href="cadastro_anun.php">Cadastrar Anúncios</a>
    <?php if ($_SESSION["UsuarioNivel"] == "ADM"){?><a href="aprov_anun.php">Aprovar Anúncio</a><?php }?>
    <?php if ($_SESSION["UsuarioNivel"] == "ADM"){?><a href="cadastro_cat.php">Cadastrar categoria</a><?php }?>
    <a href="cadastro_user.php">Cadastrar Usuário</a>
    <a href="relatorio_anun.php">Relátorio de Anúncio</a>
</nav>  

</body>
</html>