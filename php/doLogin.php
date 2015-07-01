<html>
	<head>
		<meta charset="utf-8" />
		<?php
			if(isset($_SESSION['usuario'])){
				if(!empty($_SESSION['usuario'])){
					header("location:/trabalhos/gti/bda1/");
				}
			}else{
				if(isset($_POST)){
					$usuario=$_POST['usuario'];
					$senha=$_POST['senha'];
					if(!empty($usuario)&&!empty($senha)){
					// Inicia a conexão
						$mysqli=mysqli_connect('mysql.hostinger.com.br', 'u398318873_tj', 'Knowledge1', 'u398318873_bda');
						if (mysqli_connect_errno()) {
							echo '
							<script>
								alert("Falha ao se conectar ao MySQL:\n\n('.$mysqli->connect_errno.')\n\n'.$mysqli->connect_error.'");
								location.href="/trabalhos/gti/bda1/";
							</script>';
						}
						$queryId='select id from usuario where nome="'.$usuario.'";';
						$getId=mysqli_query($mysqli,$queryId);
						$id=mysqli_fetch_row($getId);
						$queryCheck='select * from usuario where id='.$id[0].';';
						$getCheck=mysqli_query($mysqli,$queryCheck);
						$check=mysqli_num_rows($getCheck);
						if($check==0){
							echo '
							<script>
								alert("O usuário '.$usuario.' não está cadastrado no sistema.");
								location.href="/trabalhos/gti/bda1/login.php";
							</script>';
						}else{
							$queryNome='select nome from usuario where id='.$id[0].';';
							$getNome=mysqli_query($mysqli,$queryNome);
							$nome=mysqli_fetch_row($getNome);
							$querySenha='select senha from usuario where id='.$id[0].';';
							$getSenha=mysqli_query($mysqli,$querySenha);
							$senha=mysqli_fetch_row($getSenha);
							if($usuario!=$nome[0]&&$senha!=$senha[0]){
								echo '
								<script>
									alert("Não foi possível realizar o login.\n\nVerifique se e-mail e senha estão corretos.");
									location.href="/trabalhos/gti/bda1/login.php";
								</script>';
							}else{
								session_start();
								$_SESSION['usuario']=$usuario;
								echo '
								<script>
									alert("Seja bem vindo, '.$_SESSION['usuario'].'.");
									location.href="/trabalhos/gti/bda1/";
								</script>';
							}
						}
					}
				}
			}
		?>
	</head>
</html>