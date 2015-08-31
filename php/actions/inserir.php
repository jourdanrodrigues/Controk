<html>
	<head>
		<meta charset="utf-8" />
	</head>
	<body>
		<?php
			require_once("../funcoesBase.php");
			function __autoload($class){
				$pasta="../class";
				$ext=".php";
				$file=procurarArquivos($pasta,$class.$ext);
				if ($file!==false) require_once $file;
				else echo "<span class='retorno' data-type='error'>Não foi possível encontrar o arquivo \"$class$ext\".</span>";
			}
			$estoque=new Estoque();
			$estoque->setAttrEstoque($_POST['idProdutoEstq'],$_POST['idFuncionarioEstq'],$_POST['qtdProdEstq'],$_POST['dataSaida']);
			$estoque->inserirProduto();
		?>
	</body>
</html>