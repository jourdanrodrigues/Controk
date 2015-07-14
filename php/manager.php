<html>
	<head>
		<meta charset="utf-8" />
		<meta name="author" content="Thiago Jourdan" />
		<title>Software teste de banco de dados de estoque</title>
	</head>
	<body>
		<?php
			require_once('db-queries.php');
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
			function procurarArquivos($pasta,$arquivo,$ds='/'){
				if (is_dir($pasta)){
					if (file_exists($pasta.$ds.$arquivo)){
						return $pasta.$ds.$arquivo;
					}
					$dirs=array_diff(scandir($pasta, 1), array('.','..'));
					foreach ($dirs as $dir) {
						if (!is_dir($pasta.$ds.$dir)){
							continue;
						}else{
							$f=procurarArquivos($pasta.$ds.$dir, $arquivo, $ds);
							if ($f!==false){
								return $f;
							}
						}
					}
				}else{
					return false;
				}
			}
			$acao=$_POST['acao'];
			$alvo=$_POST['alvo'];
			switch($alvo){
				case 'fornecedor':
					$fornecedor=new Fornecedor();
					$idFornecedor=$_POST['idFornecedor'];
					$fornecedor->setAttrFornecedor($idFornecedor,$_POST['nomeFantasia'],$_POST['cnpj']);
					$fornecedor->setAttrContato($_POST['email'],$_POST['telCel'],$_POST['telFixo']);
					$fornecedor->setAttrEndereco($_POST['rua'],$_POST['numero'],$_POST['compl'],$_POST['cep'],$_POST['bairro'],$_POST['cidade'],$_POST['estado']);
					//Funções
					switch($acao){
						case 'cadastrar':
							$fornecedor->cadastrarEndereco();
							$fornecedor->cadastrarContato();
							$fornecedor->cadastrarFornecedor();
							break;
						case 'atualizar':
							if($fornecedor->verificarExistencia('fornecedor','id',$idFornecedor)!==false){
								$fornecedor->atualizarFornecedor();
								$fornecedor->atualizarEndereco();
								$fornecedor->atualizarContato();
							}
							break;
						case 'buscarDados':
							if($fornecedor->verificarExistencia('fornecedor','id',$idFornecedor)!==false){
								$fornecedor->buscarDadosFornecedor();
							}
							break;
						case 'excluir':
							if($fornecedor->verificarExistencia('fornecedor','id',$idFornecedor)!==false){
								$fornecedor->excluirFornecedor();
							}
							break;
					}
					break;
				case 'cliente':
					$cliente=new Cliente();
					$idCliente=$_POST['idCliente'];
					$cliente->setAttrCliente($idCliente,$_POST['nomeCliente'],$_POST['cpfCliente'],$_POST['obsCliente']);
					$cliente->setAttrContato($_POST['email'],$_POST['telCel'],$_POST['telFixo']);
					$cliente->setAttrEndereco($_POST['rua'],$_POST['numero'],$_POST['compl'],$_POST['cep'],$_POST['bairro'],$_POST['cidade'],$_POST['estado']);
					switch($acao){
						case 'cadastrar':
							$cliente->cadastrarEndereco();
							$cliente->cadastrarContato();
							$cliente->cadastrarCliente();
							break;
						case 'atualizar':
							if($cliente->verificarExistencia('cliente','id',$idCliente)!==false){
								$cliente->atualizarCliente();
								$cliente->atualizarEndereco();
								$cliente->atualizarContato();
							}
							break;
						case 'buscarDados':
							if($cliente->verificarExistencia('cliente','id',$idCliente)!==false){
								$cliente->buscarDadosCliente();
							}
							break;
						case 'excluir':
							if($cliente->verificarExistencia('cliente','id',$idCliente)!==false){
								$cliente->excluirCliente();
							}
							break;
					}
					break;
				case 'funcionario':
					$funcionario=new Funcionario();
					$idFuncionario=$_POST['idFuncionario'];
					$funcionario->setAttrFuncionario($idFuncionario,$_POST['nomeFunc'],$_POST['cpfFuncionario'],$_POST['cargo'],$_POST['obsFuncionario']);
					$funcionario->setAttrContato($_POST['email'],$_POST['telCel'],$_POST['telFixo']);
					$funcionario->setAttrEndereco($_POST['rua'],$_POST['numero'],$_POST['compl'],$_POST['cep'],$_POST['bairro'],$_POST['cidade'],$_POST['estado']);
					switch($acao){
						case 'cadastrar':
							$funcionario->cadastrarEndereco();
							$funcionario->cadastrarContato();
							$funcionario->cadastrarFuncionario();
							break;
						case 'buscarDados':
							if($funcionario->verificarExistencia('funcionario','id',$idFuncionario)!==false){
								$funcionario->buscarDadosFuncionario();
							}
							break;
						case 'atualizar':
							if($funcionario->verificarExistencia('funcionario','id',$idFuncionario)!==false){
								$funcionario->atualizarFuncionario();
								$funcionario->atualizarEndereco();
								$funcionario->atualizarContato();
							}
							break;
						case 'excluir':
							if($funcionario->verificarExistencia('funcionario','id',$idFuncionario)!==false){
								$funcionario->excluirFuncionario();
							}
							break;
					}
					break;
				case 'remessa':
					$remessa=new Remessa();
					$idProduto=$_POST['idProdutoRem'];
					$remessa->setAttrRemessa($idProduto,$_POST['qtdProdRem'],$_POST['idFornecedorRem'],$_POST['dataPedido'],$_POST['dataPagamento'],$_POST['dataEntrega']);
					if($acao=='cadastrar'){
						if($remessa->verificarExistencia('produto','id',$idProduto)!==false){
							$remessa->cadastrarRemessa();
						}
					}
					break;
				case 'produto':
					$produto=new Produto();
					$idProduto=$_POST['idProduto'];
					$produto->setAttrProduto($idProduto,$_POST['nomeProd'],$_POST['idRemessa'],$_POST['descrProd'],$_POST['custoProd'],$_POST['valorVenda']);
					switch($acao){
						case 'cadastrar':
							$produto->cadastrarProduto();
							break;
						case 'buscarDados':
							if($produto->verificarExistencia('produto','id',$idProduto)!==false){
								$produto->buscarDadosProduto();
							}
							break;
						case 'atualizar':
							if($produto->verificarExistencia('produto','id',$idProduto)!==false){
								$produto->atualizarProduto();
							}
							break;
					}
					break;
				case 'estoque':
					$entradaEstoque=new Estoque();
					$idProduto=$_POST['idProdutoEstq'];
					$idFuncionario=$_POST['idFuncionarioEstq'];
					$entradaEstoque->setAttrEstoque($idProduto,$idFuncionario,$_POST['qtdProdEstq'],$_POST['dataSaida']);
					switch($acao){
						case 'inserir':
							if($entradaEstoque->verificarExistencia('produto','id',$idProduto)!==false){
								$entradaEstoque->inserirProduto();
							}
							break;
						case 'retirar':
							if($entradaEstoque->verificarExistencia('funcionario','id',$idFuncionario)!==false){
								if($entradaEstoque->verificarExistencia('produto','id',$idProduto)!==false){
									$entradaEstoque->retirarProduto();
								}
							}
							break;
					}
					break;
			}
		?>
	</body>
</html>