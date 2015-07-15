<html>
	<head>
		<meta charset="utf-8" />
		<title>Software teste de banco de dados de estoque</title>
		<?php
			require_once('funcoesBase.php');
			function __autoload($class){
				$pasta='./class';
				$ext='.php';
				$file=procurarArquivos($pasta,$class.$ext);
			   if ($file!==false ){
				   require_once $file;
				}else{
					$msg='Não foi possível encontrar o arquivo "'.$class.$ext.'".';
					exit('<script>alert("'.$msg.'");</script>');
				}
			}
			if(isset($_SESSION['usuario'])){
				if(!empty($_SESSION['usuario'])){
					header("location:/trabalhos/gti/bda1/");
				}
			}else{
				if(isset($_POST)){
					$usuario=$_POST['usuario'];
					$senha=$_POST['senha'];
					$acao=$_POST['acao'];
					// Inicia a conexão
					$mysqli=Connection::conectar();
					$queryCheck='select * from usuario where nome="'.$usuario.'";';
					$getCheck=mysqli_query($mysqli,$queryCheck);
					$check=mysqli_num_rows($getCheck);
					switch($acao){
						case 'login':
							if($check==0){
								echo '
								<script>
									alert("O usuário '.$usuario.' não está cadastrado no sistema.");
									location.href="/trabalhos/gti/bda1/login.php";
								</script>';
							}else{
								$queryId='select id from usuario where nome="'.$usuario.'";';
								$getId=mysqli_query($mysqli,$queryId);
								$id=mysqli_fetch_row($getId);
								$queryNome='select nome from usuario where id='.$id[0].';';
								$getNome=mysqli_query($mysqli,$queryNome);
								$nome=mysqli_fetch_row($getNome);
								$queryPw='select senha from usuario where id='.$id[0].';';
								$getPw=mysqli_query($mysqli,$queryPw);
								$pw=mysqli_fetch_row($getPw);
								if($usuario!=$nome[0]||$senha!=$pw[0]){
									echo '
									<script>
										alert("Não foi possível realizar o login.\n\nVerifique se e-mail e senha estão corretos.");
										location.href="/trabalhos/gti/bda1/login.php";
									</script>';
								}else{
									session_start();
									$_SESSION['usuario']=$usuario;
									$_SESSION['tempo']=time();
									echo '
									<script>
										alert("Seja bem vindo, '.$usuario.'.");
										location.href="/trabalhos/gti/bda1/";
									</script>';
								}
							}
							break;
						case 'cadastrar':
							if($check!=0){
								echo '
								<script>
									alert("O usuário '.$usuario.' já está cadastrado no sistema.");
									location.href="/trabalhos/gti/bda1/login.php";
								</script>';
							}else{
								$cadUsuario='insert into usuario(nome,senha) values ("'.$usuario.'","'.$senha.'");';
								if(!mysqli_query($mysqli,$cadUsuario)){
									die ('
									<script>
										alert("Não foi possível cadastrar o usuário '.$usuario.':\n\n'.mysqli_error($mysqli).'");
										location.href="/trabalhos/gti/bda1/login.php";
									</script>');
								}else{
									echo '<script>alert("O usuário '.$usuario.' foi cadastrado com sucesso!");</script>';
									session_start();
									$_SESSION['usuario']=$usuario;
									$_SESSION['tempo']=time();
									echo '<script>alert("Seja bem vindo, '.$usuario.'.");location.href="/trabalhos/gti/bda1/";</script>';
								}
							}
							break;
					}
				}
			}
		?>
	</head>
</html>