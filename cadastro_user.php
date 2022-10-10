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
    include('funcao.php');

   if ($_SESSION["UsuarioNivel"] != "ADM") echo "<script>alert('Você não é Administrador!');top.location.href='menu.php';</script>"; 


   if (@$_REQUEST['id'] and !$_REQUEST['botao'])
   {
       $query = "
           SELECT * FROM usuario WHERE id='{$_REQUEST['id']}'
       ";
       $result = mysqli_query($con, $query);
       $row = mysqli_fetch_assoc($result);
       //echo "<br> $query";	
       foreach( $row as $key => $value )
       {
           $_POST[$key] = $value;
       }
   }
    if(@$_REQUEST['botao'] =="Gravar")
    {
        $nome = $_POST['nome'];
        $nivel = $_POST['nivel'];
        $login = $_POST['login'];
        $senha = md5($_POST['senha']);
        
       gravaLog ($id_usuario, date("Y-m-d h:m:s"),'Usuario', $nome, 'criou');

       $uploaddir = 'uploads/';
       $uploadfile = $uploaddir . basename($_FILES['userfile']['name']);
       
       if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
		    echo "Arquivo válido e enviado com sucesso.\n";
	    } else {
		    echo "Possível ataque de upload de arquivo!\n";
	    }
        if (!$_REQUEST['id'])
        {
        $query = "INSERT INTO usuario (nivel, login, senha, nome, avatar) values ('$nivel', '$login', '$senha', '$nome', '{$_FILES["userfile"]["name"]}')";
        $result = mysqli_query($con, $query);
        if(!$result) echo mysqli_error($con);
        }else{
            $insere = "UPDATE usuario SET 
                        nome = '{$_POST['nome']}'
                        , sexo = '{$_POST['nivel']}'
                        , login = '{$_POST['login']}'
                        , senha = '{$_POST['senha']}'
                        WHERE id = '{$_REQUEST['id']}'
                    ";
            $result_update = mysqli_query($con, $insere);
    
            if ($result_update) echo "<h2> Registro atualizado com sucesso!!!</h2>";
            else echo "<h2> Nao consegui atualizar!!!</h2>";
            
        }

    }
    if (@$_REQUEST['botao'] =="Deletar")
    {
        $id = $_POST['id'];

        gravaLog ($id_usuario, date("Y-m-d h:m:s"),'Usuario', $id, 'deletou');

        $query = "DELETE FROM usuario WHERE id = '$id'";
        $result = mysqli_query($con, $query);
        if(!$result) echo mysqli_error($con);
    }

?>

<form enctype="multipart/form-data" action="cadastro_user.php" method="POST">
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
        <div>
            <label><strong>Avatar:</strong></label>
            <input type=file name=userfile ><br>
        </div>
        <input type=submit name=botao value=Gravar>
</form> 
<br>
<form action="cadastro_user.php" method="POST">
        <div>
            <label><strong>ID</strong>:</label>
            <input type="text" name= "id" placeholder="Digite ID que deseja excluir">
        </div>
        <input type=submit name=botao value=Deletar >   
</form>
<br>
    
<div><a href="menu.php"><img src="imagens/voltar.png" alt="voltar pagina"></a></div>

</body>
</html>