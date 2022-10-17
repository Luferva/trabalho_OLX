<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OLX - Cadastro Anúncios</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <h1>Cadastro de Anúncios</h1>

    <?php
    require('config.php');
    require('verifica.php');

    $id = @$_REQUEST['id'];

    if (@$_REQUEST['botao'] == "Excluir") {
        $query_excluir = "
			DELETE FROM anuncio WHERE id='$id'
		";
        $result_excluir = mysqli_query($con, $query_excluir);

        if ($result_excluir) echo "<h2> Registro excluido com sucesso!!!</h2>";
        else echo "<h2> Nao consegui excluir!!!</h2>";
    }
    if (@$_REQUEST['id'] and @!$_REQUEST['botao']) {
        $query = "
		SELECT * FROM anuncio WHERE id='{$_REQUEST['id']}'
	";
        $result = mysqli_query($con, $query);
        $row = mysqli_fetch_assoc($result);
        //echo "<br> $query";	
        foreach ($row as $key => $value) {
            $_POST[$key] = $value;
        }
    }
    if (@$_REQUEST['botao'] == "Gravar") {
        if (!$_REQUEST['id']) {
            $status = 'N';

            $insere = "INSERT into anuncio (id_categoria, id_usuario, valor, descricao, status, nome) VALUES ('{$_POST['id_categoria']}', '{$_SESSION['id_usuario']}', '{$_POST['valor']}', '{$_POST['descricao']}','$status', '{$_POST['nome']}')";
            $result_insere = mysqli_query($con, $insere);

            if ($result_insere) echo "<h2> Registro inserido com sucesso!!! </br> Foi mandado ao Administrador para aprovação</h2>";
            else echo mysqli_error($con); //"<h2> Nao consegui inserir!!!</h2>";
        } else {

            $insere = "UPDATE anuncio SET 
					id_categoria = '{$_POST['id_categoria']}'
                    , valor = '{$_POST['valor']}'
					, descricao = '{$_POST['descricao']}'
                    , status = '{$_POST['status']}'
                    , nome = '{$_POST['nome']}'
					WHERE id = '{$_REQUEST['id']}'
				";
            $result_update = mysqli_query($con, $insere);

            if ($result_update) echo "<h2> Registro atualizado com sucesso!!!</h2>";
            else echo "<h2> Nao consegui atualizar!!!</h2>";
        }
    }

    ?>


    <form action="cadastro_anun.php" method="POST">
        <div>
            <label><strong>Nome:</strong></label>
            <input type=text name=nome value="<?php echo @$_POST['nome']; ?>" placeholder="Digite nome do produto"><br>
        </div>
        <div>
            <label><strong>Categoria:</strong></label>
            <?php
            $query = "SELECT id, nome FROM categoria ORDER BY nome";
            $result = mysqli_query($con, $query);
            if (!$result) echo mysqli_error($con);
            ?>
            <select name="id_categoria">
                <option value=" "> ..:: selecione ::.. </option>
                <?php
                while ($row = mysqli_fetch_assoc($result)) {
                ?>
                    <option value="<?php echo $row['id']; ?>" <?php echo $row['id'] == @$_POST['id_categoria'] ? "selected" : "" ?>><?php echo @$row['nome'] ?></option>

                <?php
                }
                ?>
            </select>
        </div>
        <div>
            <label><strong>Valor:</strong></label>
            <input type=text name=valor value="<?php echo @$_POST['valor']; ?>" placeholder="Digite valor do produto"><br>
        </div>
        <?php if ($_SESSION["UsuarioNivel"] == "ADM") { ?>
            <div>
                <label><strong>Status:</strong></label>
                <input type=radio name=status value=S <?php echo @$_POST['status'] == 'S' ? " checked " : "" ?>><strong> Sim</strong><input type=radio name=status value=N <?php echo @$_POST['status'] == 'N' ? " checked " : "" ?>><strong> Não</strong><br>
            </div>
        <?php } else { ?> <input type="hidden" name=status value=<?php echo @$_POST['status']; ?>><?php } ?>
        <div>
            <label><strong>Descrição:</strong></label>
            <input type=text name=descricao value="<?php echo @$_POST['descricao']; ?>" placeholder="Descrição do produto"><br>
        </div>
        <input type=submit name=botao value=Gravar>
        <input type="hidden" name="id" value="<?php echo @$_REQUEST['id'] ?>" />
    </form>
    <br>
    <form action="cadastro_anun.php" method="POST">
        <div>
            <label><strong>ID</strong>:</label>
            <input type="text" name="id" placeholder="Digite ID que deseja excluir">
        </div>
        <input type=submit name=botao value=Excluir>
    </form>
    <br>

    <div><a href="relatorio_anun.php"><img src="imagens/voltar.png" alt="voltar pagina"></a></div>

</body>

</html>