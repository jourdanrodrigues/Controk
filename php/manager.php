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
					$fornecedor->idFornecedor=$_POST['idFornecedor'];
					$fornecedor->nomeFantasia=$_POST['nomeFantasia'];
					$fornecedor->cnpj=$_POST['cnpj'];
					//Contatos
					$fornecedor->email=$_POST['email'];
					$fornecedor->telFixo=$_POST['telFixo'];
					$fornecedor->telCel=$_POST['telCel'];
					//Endereços
					$fornecedor->rua=$_POST['rua'];
					$fornecedor->numero=$_POST['numero'];
					$fornecedor->complemento=$_POST['compl'];
					$fornecedor->cep=$_POST['cep'];
					$fornecedor->bairro=$_POST['bairro'];
					$fornecedor->cidade=$_POST['cidade'];
					$fornecedor->estado=$_POST['estado'];
					$mysqli=$fornecedor->conectar();
					//Funções
					switch($acao){
						case 'cadastrar':
							$fornecedor->cadastrarEndereco();
							$fornecedor->cadastrarContato();
							$fornecedor->cadastrarFornecedor();
							break;
						case 'atualizar':
							if($fornecedor->verifyId('fornecedor',$fornecedor->idFornecedor)===false){
								break;
							}
							$fornecedor->atualizarFornecedor();
							$fornecedor->atualizarEndereco();
							$fornecedor->atualizarContato();
							break;
						case 'buscarDados':
							if($fornecedor->verifyId('fornecedor',$fornecedor->idFornecedor)===false){
								break;
							}
							$fornecedor->buscarDadosFornecedor();
							break;
						case 'excluir':
							if($fornecedor->verifyId('fornecedor',$fornecedor->idFornecedor)===false){
								break;
							}
							$fornecedor->excluirFornecedor();
							break;
					}
					break;
				case 'cliente':
					$cliente=new Cliente();
					$cliente->idCliente=$_POST['idCliente'];
					$cliente->nome=$_POST['nomeCliente'];
					$cliente->cpf=$_POST['cpfCliente'];
					$cliente->obs=$_POST['obsCliente'];
					//Contatos
					$cliente->email=$_POST['email'];
					$cliente->telFixo=$_POST['telFixo'];
					$cliente->telCel=$_POST['telCel'];
					//Endereços
					$cliente->rua=$_POST['rua'];
					$cliente->numero=$_POST['numero'];
					$cliente->complemento=$_POST['compl'];
					$cliente->cep=$_POST['cep'];
					$cliente->bairro=$_POST['bairro'];
					$cliente->cidade=$_POST['cidade'];
					$cliente->estado=$_POST['estado'];
					switch($acao){
						case 'cadastrar':
							$cliente->cadastrarEndereco();
							$cliente->cadastrarContato();
							$cliente->cadastrarCliente();
							break;
						case 'atualizar':
							if($cliente->verifyId('cliente',$cliente->idCliente)===false){
								break;
							}
							$cliente->atualizarCliente();
							$cliente->atualizarEndereco();
							$cliente->atualizarContato();
							break;
						case 'buscarDados':
							if($cliente->verifyId('cliente',$cliente->idCliente)===false){
								break;
							}
							$cliente->buscarDadosCliente();
							break;
						case 'excluir':
							if($cliente->verifyId('cliente',$cliente->idCliente)===false){
								break;
							}
							$cliente->excluirCliente();
							break;
					}
					break;
				case 'funcionario':
					$funcionario=new Funcionario();
					$funcionario->idFuncionario=$_POST['idFuncionario'];
					$funcionario->nome=$_POST['nomeFunc'];
					$funcionario->cpf=$_POST['cpfFuncionario'];
					$funcionario->cargo=$_POST['cargo'];
					$funcionario->obs=$_POST['obsFuncionario'];
					//Contatos
					$funcionario->email=$_POST['email'];
					$funcionario->telFixo=$_POST['telFixo'];
					$funcionario->telCel=$_POST['telCel'];
					//Endereços
					$funcionario->rua=$_POST['rua'];
					$funcionario->numero=$_POST['numero'];
					$funcionario->complemento=$_POST['compl'];
					$funcionario->cep=$_POST['cep'];
					$funcionario->bairro=$_POST['bairro'];
					$funcionario->cidade=$_POST['cidade'];
					$funcionario->estado=$_POST['estado'];
					switch($acao){
						case 'cadastrar':
							$funcionario->cadastrarEndereco();
							$funcionario->cadastrarContato();
							$funcionario->cadastrarFuncionario();
							break;
						case 'buscarDados':
							if($funcionario->verifyId('funcionario',$funcionario->idFuncionario)===false){
								break;
							}
							$funcionario->buscarDadosFuncionario();
							break;
						case 'atualizar':
							if($funcionario->verifyId('funcionario',$funcionario->idFuncionario)===false){
								break;
							}
							$funcionario->atualizarFuncionario();
							$funcionario->atualizarEndereco();
							$funcionario->atualizarContato();
							break;
						case 'excluir':
							if($funcionario->verifyId('funcionario',$funcionario->idFuncionario)===false){
								break;
							}
							$funcionario->excluirFuncionario();
							break;
					}
					break;
				case 'remessa':
					$idProdutoRem=$_POST['idProdutoRem'];
					$qtdProdRem=$_POST['qtdProdRem'];
					$idFornecedorRem=$_POST['idFornecedorRem'];
					$dataPedido=$_POST['dataPedido'];
					$dataPagamento=$_POST['dataPagamento'];
					$dataEntrega=$_POST['dataEntrega'];
					if($acao=='cadastrar'){
						remessas($acao,'',$idProdutoRem,$qtdProdRem,$idFornecedorRem,$dataPedido,$dataPagamento,$dataEntrega);
					}
					break;
				case 'produto':
					$produto->idProduto=$_POST['idProduto'];
					$produto->idRemessa=$_POST['idRemessa'];
					$produto->descricao=$_POST['descrProd'];
					$produto->nome=$_POST['nomeProd'];
					$produto->custoProd=$_POST['custoProd'];
					$produto->valorVenda=$_POST['valorVenda'];
					switch($acao){
						case 'cadastrar':
							$produto->cadastrarProduto();
							break;
						case 'buscarDados':
							if($produto->verifyId('produto',$produto->idProduto)===false){
								break;
							}
							$produto->buscarDadosProduto();
							break;
						case 'atualizar':
							if($produto->verifyId('produto',$produto->idProduto)===false){
								break;
							}
							$produto->atualizarProduto();
							break;
					}
					break;
				case 'estoque':
					$idFuncionarioEstq=$_POST['idFuncionarioEstq'];
					$idProdutoEstq=$_POST['idProdutoEstq'];
					$qtdProdEstq=$_POST['qtdProdEstq'];
					$dataSaida=$_POST['dataSaida'];
					switch($acao){
						case 'inserir':
							estoques($acao,$idProdutoEstq,$qtdProdEstq);
							break;
						case 'retirar':
							estoques($acao,$idProdutoEstq,$qtdProdEstq,$idFuncionarioEstq,$dataSaida);
							break;
					}
					break;
			}
		?>
	</body>
</html>