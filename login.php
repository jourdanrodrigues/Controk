<?php
	if(isset($session['usuario'])){
		header("location:index.php");
	}
?>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Login para SEFUNC BD</title>
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
		<script src="js/jQuery.js"></script>
		<script>
			$.ajax({
				url:'index.php',
				success: function(topo){topo=$(topo).find('#topo');$('#body').prepend(topo);},
				error: function(){alert("O topo não carregou!");}
			})
		</script>
	</head>
	<body align="center">
		<div id="topo">
			<h1>SEFUNC BD</h1>
			<h3>Software para Exemplo de Funcionamento do Banco de Dados</h3>
		</div>
		<form id="logIn" action="login.php">
			<p>
				<label for="emailLi">Email</label><br>
				<input type="text" id="emailLi" name="emailLi" class="field">
			</p><p>
				<label for="senha">Senha</label><br>
				<input type="password" id="senha" name="senha" class="field">
			</p>
			<button>LogIn</button>
		</form>
	</body>
</html>