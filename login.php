<html>
	<head>
		<meta charset="utf-8" />
		<title>Login para SEFUNC BD</title>
		<script src="js/jQuery.js"></script>
		<link rel="stylesheet" href="css.css" />
		<style>
			form{
				font-size:25pt;
				color:#CCC;}
			button{
				color:#666;
				background:#CCC;}
			button:hover{
				color:#CCC;
				background:#666;}
		</style>
		<?php
			session_start();
			if(!empty($_SESSION['usuario'])||isset($_SESSION['usuario'])){
				header("location:/trabalhos/gti/bda1/");
			}
		?>
	</head>
	<body align="center">
		<div id="topo">
			<h1>SEFUNC BD</h1>
			<h3>Software para Exemplo de Funcionamento do Banco de Dados</h3>
		</div>
		<form id="logIn" action="/trabalhos/gti/bda1/php/doLogin.php" method="POST" autocomplete="off">
			<p>
				<label for="usuario">Usuário</label><br>
				<input type="text" id="usuario" name="usuario" class="field">
			</p><p>
				<label for="senha">Senha</label><br>
				<input type="password" id="senha" name="senha" class="field">
			</p>
			<input type="button" id="acao" value="Cadastre-se">
			<button>LogIn</button>
		</form>
	</body>
</html>