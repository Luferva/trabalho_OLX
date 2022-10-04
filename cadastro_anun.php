<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OLX - Cadastro Anúncios</title>
</head>

<body>
    
<h1>Cadastro de Anúncios</h1>

<?php
    require('config.php');
    require('verifica.php');

     if(@$_REQUEST['botao'] =="Gravar")
    {
        $categoria = $_POST['categoria'];
        $valor = $_POST['valor'];
        $descricao = $_POST['descricao'];
        $status = 'N';
        $nome = $_POST['nome'];
        
        $query = "INSERT INTO anuncio (id_categoria, id_usuario, valor, descricao, status, nome) values ('$categoria', '$id_usuario', '$valor', $descricao, $status, '$nome')";
        $result = mysqli_query($con, $query);
        if(!$result) echo mysqli_error($con);
    }
    if (@$_REQUEST['botao'] =="Deletar")
    {
        $id = $_POST['id'];

        $query = "DELETE FROM anuncio WHERE id = '$id'";
        $result = mysqli_query($con, $query);
        if(!$result) echo mysqli_error($con);
    }
?>

<form action="#" method="POST">
        <div>
            <label><strong>Nome:</strong></label>
            <input type=text name=nome placeholder= "Digite nome do produto"><br>
        </div>
        <div>
            <label><strong>Categoria:</strong></label>
            <?php 
                $query = "SELECT id, nome FROM categoria ORDER BY nome";
                $result = mysqli_query($con, $query);
                if(!$result) echo mysqli_error($con);
            ?>
            <select name="categoria" >
                <option value=" "> ..:: selecione ::.. </option>
                <?php
                    while( $row = mysqli_fetch_assoc($result) )
                    {
                ?>
                <option value="<?php echo $row['id']; ?>" ><?php echo @$row['nome'] ?></option>
                <?php
                    }
                ?>
            </select>
        </div>
        <div>
            <label><strong>Valor:</strong></label>
            <input type=text name=valor placeholder= "Digite valor do produto"><br>
        </div>
        <div>
            <label><strong>Descrição:</strong></label>
            <input type=text name=descricao placeholder= "Descrição do produto"><br>
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