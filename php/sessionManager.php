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
			$acao=$_POST['acao'];
			if($acao=='logout'){
				session_start();
				session_unset();
				echo '<script>alert("Logout efetuado com sucesso!");location.href="/trabalhos/gti/bda1/login.php";</script>';
			}else{
				$conn=new Connection();
				$conn->setAttrLogin($_POST['usuario'],$_POST['senha']);
				switch($acao){
					case 'login': $conn->login(); break;
					case 'cadastrar': $conn->cadastrarUsuario(); break;
				}
			}
		?>
	</head>
</html>