<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OLX - Menu</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php
    require('config.php');
    require('verifica.php');
    ?>

    <header><img src="imagens/olx.png" alt="Logo OLX"><br>
    <h1>Bem Vindo ao OLX !!!</h1>
    </header>

    <div id="profile">
        <img src="uploads/<?php echo $_SESSION["avatar"]; ?>" width="140"><br>
        <strong><?php echo ($_SESSION["nome_user"]) ?></strong><br>
        <a href="logout.php"><img src="imagens/logout.png" alt="Logout" width="50"></a><br>

    </div>
    <br>
    <nav>
        <a href="cadastro_anun.php">Cadastrar Anúncios</a>
        <?php if ($_SESSION["UsuarioNivel"] == "ADM") { ?><a href="cadastro_cat.php">Cadastrar categoria</a><?php } ?>
        <a href="cadastro_user.php">Cadastrar Usuário</a>
        <a href="relatorio_anun.php">Relátorio de Anúncio</a>



    </nav>

</body>

</html>