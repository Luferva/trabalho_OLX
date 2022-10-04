<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OLX - Relátorio de Anúncios</title>
</head>
<body>
<?php
    require('config.php');
    require('verifica.php');
?>

<h1>Relatório de Anúncio</h1><br>

<form action="relatorio_anun.php?botao=gravar" method="post" name="form1">
<fieldset>
<table width="95%" border="0" align="center">
  <tr>
    <td width="18%" align="right"><strong>Nome</strong>:</td>
    <td width="26%"><input type="text" name="nome" placeholder= "Nome do anúncio" /></td>
    <td width="17%" align="right"><strong>Categoria</strong>:</td>
    <td width="18%">
                <?php 
                    $query = "SELECT id, nome FROM categoria ORDER BY nome";
                    $result = mysqli_query($con, $query);
                    if(!$result) echo mysqli_error($con);
                ?>
                <select name="categoria" >
                    <option value=""> ..:: selecione ::.. </option>
                    <?php
                        while( $row = mysqli_fetch_assoc($result) )
                        {
                    ?>
                    <option value="<?php echo $row['id']; ?>" ><?php echo @$row['nome'] ?></option>
                    <?php
                        }
                    ?>
                </select>
            </td>
    <td width="21%"><input type="submit" name="botao" value="Gerar" /></td>
  </tr>
</table>
</fieldset>
</form>
<br>

<?php if ($_REQUEST['botao'] == "Gerar") { ?>

<table width="95%" border="1" align="center">
    <tr bgcolor="#393FB8">
        <th width="5%">ID</th>
        <th width="30%">Categoria</th>
        <th width="5%">Valor</th>
        <th width="10%">Descrição</th>
    </tr>

    <?php
        $nome = $_POST['nome'];
	    $categoria = $_POST['categoria'];
	
	    $query = "SELECT *FROM anuncio WHERE id > 0 ";
        $query .= ($nome ? " AND nome LIKE '%$nome%' " : "");
        $query .= ($categoria ? " AND id_categoria = '$categoria' " : "");
        $query .= " ORDER by id";
        $result = mysqli_query($con, $query);
	    while ($coluna=mysqli_fetch_array($result)) 
	    {	
	?>

    <tr>
      <th width="5%"><?php echo $coluna['id']; ?></th>
      <th width="30%"><?php echo $coluna['nome']; ?></th>
      <th width="15%"><?php echo $coluna['idade']; ?></th>
      <th width="15%"><?php echo $coluna['sexo']; ?></th>
      <th width="30%"><?php echo $coluna['id_categoria']; ?></th>
      <th width="25%"><?php echo $coluna['email']; ?></th>
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