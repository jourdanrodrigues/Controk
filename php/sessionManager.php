<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
	</head>
	<body>
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
			$acao=$_POST['acaoSessao'];
			$sessao=new Sessao();
			if($acao=='logout'){
				$sessao->logout();
			}else{
				$sessao->setAttrSessao($_POST['usuario'],$_POST['senha']);
				switch($acao){
					case 'login': $sessao->login(); break;
					case 'cadastrar': $sessao->cadastrarUsuario(); break;
				}
			}
		?>
	</body>
</html>