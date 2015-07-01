<html>
	<head>
		<meta charset="utf-8" />
		<title>Software teste de banco de dados de estoque</title>
		<?php
			session_start();
			session_unset();
			session_destroy();
			echo '
				<script>
					alert("Logout efetuado com sucesso!");
					location.href="/trabalhos/gti/bda1/login.php";
				</script>'
		?>
	</head>
</html>