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
					$acao=$_POST['acao'];
					// Inicia a conexão
					$conn=new Connection();
					$conn->setAttrLogin($_POST['usuario'],$_POST['senha']);
					switch($acao){
						case 'login': $conn->login(); break;
						case 'cadastrar': $conn->cadastrarUsuario(); break;
					}
				}
			}
		?>
	</head>
</html>