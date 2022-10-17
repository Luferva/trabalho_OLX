<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OLX - Cadastro Categorias</title>
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

<?php
   
    include('funcao.php');

    if ($_SESSION["UsuarioNivel"] != "ADM") echo "<script>alert('Você não é Administrador!');top.location.href='menu.php';</script>"; 

     if(@$_REQUEST['botao'] =="Gravar")
    {
        $nome = $_POST['nome'];

        gravaLog ($id_usuario, date("Y-m-d h:m:s"),'Categoria', $nome, 'criou');
        
        $query = "INSERT INTO categoria (nome) values ('$nome')";
        $result = mysqli_query($con, $query);
        if(!$result) echo mysqli_error($con);
    }
    if (@$_REQUEST['botao'] =="Deletar")
    {
        $id = $_POST['id'];

        gravaLog ($id_usuario, date("Y-m-d h:m:s"),'Categoria', $id, 'deletou');

        $query = "DELETE FROM categoria WHERE id = '$id'";
        $result = mysqli_query($con, $query);
        if(!$result) echo mysqli_error($con);
    }

?>

<form action="#" method="POST">
        <fieldset>
            <div>
                <label><strong>Nome:</strong></label>
                <input type=text name=nome placeholder= "Digite a categoria"><br>
            </div>
            <input type=submit name=botao value=Gravar>
        </fieldset>
</form> 
<br>
<form action="#" method="POST">
        <fieldset>
            <div>
                <label><strong>ID</strong>:</label>
                <input type="text" name= "id" placeholder="Digite ID que deseja excluir">
            </div>
            <input type=submit name=botao value=Deletar >   
            </form>
        </fieldset>
<br>

<div class="voltar2"><a href="menu.php"><img src="imagens/voltar.png" alt="voltar pagina"></a></div>

</body>
</html>




