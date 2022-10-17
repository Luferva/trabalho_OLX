<html lang="pt-br">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>OLX - Login</title>
	<link rel="stylesheet" href="style.css">
</head>

<body>

	<header><img src="imagens/olx.png" alt="Logo OLX"><br>
		<h1>Olá, Faça Seu Login!!!</h1>
	</header>

	<?php
	include('config.php');
	session_start();

	if (@$_REQUEST['botao'] == "Entrar") {
		$login = $_POST['login'];
		$senha = md5($_POST['senha']);

		$query = "SELECT * FROM usuario WHERE login = '$login' AND senha = '$senha' ";
		$result = mysqli_query($con, $query);
		while ($coluna = mysqli_fetch_array($result)) {
			$_SESSION["id_usuario"] = $coluna["id"];
			$_SESSION["nome_user"] = $coluna["nome"];
			$_SESSION["nome_usuario"] = $coluna["login"];
			$_SESSION["UsuarioNivel"] = $coluna["nivel"];
			$_SESSION["avatar"] = $coluna["avatar"];

			// para direcionar a páginas diferentes com base no nivel do usuário
			$niv = $coluna['nivel'];
			if ($niv == "USER") {
				header("Location: menu.php");
				exit;
			}

			if ($niv == "ADM") {
				header("Location: menu.php");
				exit;
			}
		}
	}
	?>

	<form action=# method=post>
		<fieldset>
			<div>
				<label><strong>Login:</strong></label>
				<input type=text name=login placeholder="Digite seu login"><br>
			</div>
			<div>
				<label><strong>Senha:</strong></label>
				<input type=password name=senha placeholder="Digite sua senha"><br><br>
				<input type=submit name=botao value=Entrar>
			</div>
		</fieldset>


</body>

</html>