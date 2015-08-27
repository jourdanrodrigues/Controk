<html>
	<head>
		<meta charset="utf-8" />
		<meta name="author" content="Thiago Jourdan" />
		<title>Software teste de banco de dados de estoque</title>
	</head>
	<body>
		<?php
			require_once('funcoesBase.php');
			function __autoload($class){
				$pasta='./class';
				$ext='.php';
				$file=procurarArquivos($pasta,$class.$ext);
				if ($file!==false ) require_once $file;
				else{
					$msg='Não foi possível encontrar o arquivo "'.$class.$ext.'".';
					exit('<script>alert("'.$msg.'");</script>');
				}
			}
			$acao=$_POST['acao'];
			$alvo=$_POST['alvo'];
			switch($alvo){
				case 'fornecedor':
					$fornecedor=new Fornecedor();
					$fornecedor->setAttrFornecedor($_POST['idFornecedor'],$_POST['nomeFantasia'],$_POST['cnpj']);
					$fornecedor->setAttrContato($_POST['email'],$_POST['telCel'],$_POST['telFixo']);
					$fornecedor->setAttrEndereco($_POST['rua'],$_POST['numero'],$_POST['compl'],$_POST['cep'],$_POST['bairro'],$_POST['cidade'],$_POST['estado']);
					//Funções
					switch($acao){
						case 'cadastrar': $fornecedor->cadastrarFornecedor(); break;
						case 'buscarDados': $fornecedor->buscarDadosFornecedor(); break;
						case 'atualizar': $fornecedor->atualizarFornecedor(); break;
						case 'excluir': $fornecedor->excluirFornecedor(); break;
					}
					break;
				case 'cliente':
					$cliente=new Cliente();
					$cliente->setAttrCliente($_POST['idCliente'],$_POST['nomeCliente'],$_POST['cpfCliente'],$_POST['obsCliente']);
					$cliente->setAttrContato($_POST['email'],$_POST['telCel'],$_POST['telFixo']);
					$cliente->setAttrEndereco($_POST['rua'],$_POST['numero'],$_POST['compl'],$_POST['cep'],$_POST['bairro'],$_POST['cidade'],$_POST['estado']);
					switch($acao){
						case 'cadastrar': $cliente->cadastrarCliente(); break;
						case 'buscarDados': $cliente->buscarDadosCliente(); break;
						case 'atualizar': $cliente->atualizarCliente(); break;
						case 'excluir': $cliente->excluirCliente(); break;
					}
					break;
				case 'funcionario':
					$funcionario=new Funcionario();
					$funcionario->setAttrFuncionario($_POST['idFuncionario'],$_POST['nomeFunc'],$_POST['cpfFuncionario'],$_POST['cargo'],$_POST['obsFuncionario']);
					$funcionario->setAttrContato($_POST['email'],$_POST['telCel'],$_POST['telFixo']);
					$funcionario->setAttrEndereco($_POST['rua'],$_POST['numero'],$_POST['compl'],$_POST['cep'],$_POST['bairro'],$_POST['cidade'],$_POST['estado']);
					switch($acao){
						case 'cadastrar': $funcionario->cadastrarFuncionario(); break;
						case 'buscarDados': $funcionario->buscarDadosFuncionario(); break;
						case 'atualizar': $funcionario->atualizarFuncionario(); break;
						case 'excluir': $funcionario->excluirFuncionario(); break;
					}
					break;
				case 'remessa':
					$remessa=new Remessa();
					$remessa->setAttrRemessa($_POST['idProdutoRem'],$_POST['qtdProdRem'],$_POST['idFornecedorRem'],$_POST['dataPedido'],$_POST['dataPagamento'],$_POST['dataEntrega']);
					switch($acao){
						case 'cadastrar': $remessa->cadastrarRemessa(); break;
						case 'buscarDados': break;
					}
					break;
				case 'produto':
					$produto=new Produto();
					$produto->setAttrProduto($_POST['idProduto'],$_POST['nomeProd'],$_POST['idRemessa'],$_POST['descrProd'],$_POST['custoProd'],$_POST['valorVenda']);
					switch($acao){
						case 'cadastrar': $produto->cadastrarProduto(); break;
						case 'buscarDados': $produto->buscarDadosProduto(); break;
						case 'atualizar': $produto->atualizarProduto(); break;
					}
					break;
				case 'estoque':
					$entradaEstoque=new Estoque();
					$entradaEstoque->setAttrEstoque($_POST['idProdutoEstq'],$_POST['idFuncionarioEstq'],$_POST['qtdProdEstq'],$_POST['dataSaida']);
					switch($acao){
						case 'inserir': $entradaEstoque->inserirProduto(); break;
						case 'retirar': $entradaEstoque->retirarProduto(); break;
					}
					break;
			}
		?>
	</body>
</html>