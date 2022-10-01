<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OLX - Cadastro Usuários</title>
</head>

<body>
    
<h1>Cadastro de Usuários</h1>

<?php
    require('config.php');
    require('verifica.php');

    if ($_SESSION["UsuarioNivel"] != "ADM") echo "<script>alert('Você não é Administrador!');top.location.href='menu.php';</script>"; 

     if(@$_REQUEST['botao'] =="Gravar")
    {
        $nome = $_POST['nome'];
        $nivel = $_POST['nivel'];
        $login = $_POST['login'];
        $senha = md5($_POST['senha']);

        gravaLog ($id_usuario, date("Y-m-d h:m:s"),'Usuario', $nome, 'criou');
        
        $query = "INSERT INTO usuario (nome, nivel, login, senha) values ('$nome', '$nivel', '$login', '$senha')";
        $result = mysqli_query($con, $query);
        if(!$result) echo mysqli_error($con);
    }
    if (@$_REQUEST['botao'] =="Deletar")
    {
        $id = $_POST['id'];

        gravaLog ($id_usuario, date("Y-m-d h:m:s"),'Usuario', $id, 'deletou');

        $query = "DELETE FROM categoria WHERE id = '$id'";
        $result = mysqli_query($con, $query);
        if(!$result) echo mysqli_error($con);
    }

?>

<form action="#" method="POST">
        <div>
            <label><strong>Nome:</strong></label>
            <input type=text name=nome placeholder= "Digite nome"><br>
        </div>
        <div>
            <label><strong>Nivel:</strong></label>
            <input type=radio name=nivel value=ADM><strong> Administrador</strong><input type=radio name=nivel value=USER><strong> Usuário</strong><br>
        </div>
        <div>
            <label><strong>Login:</strong></label>
            <input type=text name=login placeholder= "Digite seu login"><br>
        </div>
        <div>
            <label><strong>Senha:</strong></label>
            <input type=password name=senha placeholder= "Digite senha"><br>
        </div>
        <input type=submit name=botao value=Gravar>
</form> 
<br>
<form action="#" method="POST">
        <div>
            <label><strong>ID</strong>:</label>
            <input type="text" name= "id" placeholder="Digite ID que deseja excluir">
        </div>
        <input type=submit name=botao value=Deletar >   
</form>
<br>
</body>
</html>