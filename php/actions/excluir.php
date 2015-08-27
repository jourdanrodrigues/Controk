<html>
	<head>
		<meta charset="utf-8" />
		<meta name="author" content="Thiago Jourdan" />
		<title>Software teste de banco de dados de estoque</title>
	</head>
	<body>
		<?php
			require_once('../funcoesBase.php');
			function __autoload($class){
				$pasta='../class';
				$ext='.php';
				$file=procurarArquivos($pasta,$class.$ext);
			   if ($file!==false) require_once $file;
				else echo "<span class='retorno' data-type='error'>Não foi possível encontrar o arquivo $class$ext.</span>";
			}
			$alvo=$_POST["alvo"];
			$Alvo=ucfirst($alvo);
			$$alvo=new $Alvo();
			$setAttr="setAttr".$Alvo;
			$id="id".$Alvo;
			$function='excluir'.$Alvo;
			$$alvo->$setAttr($_POST[$id]);
			$$alvo->$function();
		?>
	</body>
</html>