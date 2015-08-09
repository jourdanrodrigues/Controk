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
				if ($file!==false)
				   require_once $file;
				else
					exit("<span class='retorno'>Não foi possível encontrar o arquivo \"$class$ext\".</span>");
			}
			$alvo=$_POST["alvo"];
			$Alvo=ucfirst($alvo);
			$$alvo=new $Alvo();
			switch($alvo){
				case "fornecedor":
					$fornecedor->setAttrFornecedor(
						$_POST["idFornecedor"],
						$_POST["nome"],
						$_POST["cnpj"]
					);
					break;
				case "cliente":
					$cliente->setAttrCliente(
						$_POST["idCliente"],
						$_POST["nome"],
						$_POST["cpf"],
						$_POST["obs"]
					);
					break;
				case "funcionario":
					$funcionario->setAttrFuncionario(
						$_POST["idFuncionario"],
						$_POST["nome"],
						$_POST["cpf"],
						$_POST["cargo"],
						$_POST["obs"]
					);
					break;
				case "remessa":
					$remessa->setAttrRemessa(
						$_POST["idProdutoRem"],
						$_POST["qtdProdRem"],
						$_POST["idFornecedorRem"],
						$_POST["dataPedido"],
						$_POST["dataPagamento"],
						$_POST["dataEntrega"]
					);
					break;
				case "produto":
					$produto->setAttrProduto(
						$_POST["idProduto"],
						$_POST["nomeProd"],
						$_POST["idRemessa"],
						$_POST["descrProd"],
						$_POST["custoProd"],
						$_POST["valorVenda"]
					);
					break;
			}
			if($alvo!="remessa"&&$alvo!="produto"){
				$$alvo->setAttrContato(
					$_POST["email"],
					$_POST["telCel"],
					$_POST["telFixo"]
				);
				$$alvo->setAttrEndereco(
					$_POST["rua"],
					$_POST["numero"],
					$_POST["complemento"],
					$_POST["cep"],
					$_POST["bairro"],
					$_POST["cidade"],
					$_POST["estado"]
				);
			}
			$function='cadastrar'.$Alvo;
			$$alvo->$function();
		?>
	</body>
</html>