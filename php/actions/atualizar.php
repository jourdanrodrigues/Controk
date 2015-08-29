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
			$alvo=$_POST['alvo'];
			$Alvo=ucfirst($alvo);
			$$alvo=new $Alvo();
			if($alvo=="fornecedor"||$alvo=="funcionario"||$alvo=="cliente"){
				$$alvo->setAttrContato($_POST['email'],$_POST['telCel'],$_POST['telFixo']);
				$$alvo->setAttrEndereco($_POST['rua'],$_POST['numero'],$_POST['complemento'],$_POST['cep'],$_POST['bairro'],$_POST['cidade'],$_POST['estado']);
				if($alvo=="fornecedor") $$alvo->setAttrFornecedor($_POST['idFornecedor'],$_POST['nomeFantasia'],$_POST['cnpj']);
				elseif($alvo=="cliente") $$alvo->setAttrCliente($_POST['idCliente'],$_POST['nomeCliente'],$_POST['cpfCliente'],$_POST['obsCliente']);
				elseif($alvo=="funcionario") $$alvo->setAttrFuncionario($_POST['idFuncionario'],$_POST['nomeFunc'],$_POST['cpfFuncionario'],$_POST['cargo'],$_POST['obsFuncionario']);
			}elseif($alvo=="produto") $$alvo->setAttrProduto($_POST['idProduto'],$_POST['nomeProd'],$_POST['idRemessa'],$_POST['descrProd'],$_POST['custoProd'],$_POST['valorVenda']);
			$atualizar="atualizar".$Alvo;
			$$alvo->$atualizar();
		?>
	</body>
</html>