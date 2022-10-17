<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OLX - Relátorio de Anúncios</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php
    require('config.php');
    require('verifica.php');
    ?>

    <header><img src="imagens/olx.png" alt="Logo OLX"><br>
        <h1>Cadastro de Categoria</h1>
    </header>

    <div id="profile">
        <img src="uploads/<?php echo $_SESSION["avatar"]; ?>" width="140"><br>
        <strong><?php echo ($_SESSION["nome_user"]) ?></strong><br>
        <a href="logout.php"><img src="imagens/logout.png" alt="Logout" width="50"></a><br>

    </div>

    <br>

    <form action="relatorio_anun.php?botao=gravar" method="post" name="form1">
        <fieldset>
            <table width="95%" border="0" align="center">
                <tr bgcolor="#393FB8">
                    <td width="18%" align="right"><strong>Nome</strong>:</td>
                    <td width="26%"><input type="text" name="nome" placeholder="Nome do anúncio" /></td>
                    <td width="17%" align="right"><strong>Categoria</strong>:</td>
                    <td width="18%">
                        <?php
                        $query = "SELECT id, nome FROM categoria ORDER BY nome";
                        $result = mysqli_query($con, $query);
                        if (!$result) echo mysqli_error($con);
                        ?>
                        <select name="id_categoria">
                            <option value=""> ..:: selecione ::.. </option>
                            <?php
                            while ($row = mysqli_fetch_assoc($result)) {
                            ?>
                                <option value="<?php echo $row['id']; ?>" <?php echo $row['id'] == @$_POST['id_categoria'] ? "selected" : "" ?>><?php echo @$row['nome'] ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </td>
                    <td width="21%"><input type="submit" name="botao" value="Gerar" /></td>
                    <td><a href="menu.php"><img src=imagens/voltar.png alt="voltar pagina"></a></td>
                </tr>
            </table>
        </fieldset>
    </form>
    <br>

    <?php if (@$_REQUEST['botao'] == "Gerar") { ?>

        <table width="95%" border="1" align="center">
            <tr bgcolor="#393FB8">
                <th width="5%">ID</th>
                <th width="30%">Nome</th>
                <th width="5%">Valor</th>
                <th width="15%">Descrição</th>
                <th width="15%">Status</th>
                <th width="15%">Opções</th>
            </tr>

            <?php
            $nome = $_POST['nome'];
            $categoria = $_POST['id_categoria'];

            $query = "SELECT *FROM anuncio WHERE id > 0 ";
            $query .= ($nome ? " AND nome LIKE '%$nome%' " : "");
            $query .= ($categoria ? " AND id_categoria = '$categoria' " : "");
            if ($_SESSION["UsuarioNivel"] == "USER") {
                $query .= (" AND status = 'S' ");
            }
            $query .= " ORDER by id";
            $result = mysqli_query($con, $query);
            while ($coluna = mysqli_fetch_array($result)) {
            ?>

                <tr>
                    <th width="5%"><?php echo $coluna['id']; ?></th>
                    <th width="30%"><?php echo $coluna['nome']; ?></th>
                    <th width="15%"><?php echo $coluna['valor']; ?></th>
                    <th width="15%"><?php echo $coluna['descricao']; ?></th>
                    <?php if ($_SESSION["UsuarioNivel"] == "ADM") { ?>
                        <th width="15%"><?php echo $coluna['status']; ?></th>
                    <?php } ?>
                    <th><a href="cadastro_anun.php?pag=cadastro_anun&id=<?php echo $coluna['id']; ?>">editar</a></th>
                </tr>

            <?php
            }
            ?>
        </table>
    <?php
    }
    ?>
</body>

</html>