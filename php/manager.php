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
						case 'editar':
							if($fornecedor->verifyId('fornecedor',$fornecedor->idFornecedor)===false){
								break;
							}
							$fornecedor->buscarDadosFornecedor($fornecedor->idFornecedor);
							break;
						case 'excluir':
							if($fornecedor->verifyId('fornecedor',$fornecedor->idFornecedor)===false){
								break;
							}
							$fornecedor->excluirFornecedor($fornecedor->idFornecedor);
							break;
					}
					break;
				case 'cliente':
					$idCliente=$_POST['idCliente'];
					$nomeCliente=$_POST['nomeCliente'];
					$cpfCliente=$_POST['cpfCliente'];
					$obsCliente=$_POST['obsCliente'];
					//Contatos
					$email=$_POST['email'];
					$telFixo=$_POST['telFixo'];
					$telCel=$_POST['telCel'];
					//Endereços
					$rua=$_POST['rua'];
					$numero=$_POST['numero'];
					$compl=$_POST['compl'];
					$cep=$_POST['cep'];
					$bairro=$_POST['bairro'];
					$cidade=$_POST['cidade'];
					$estado=$_POST['estado'];
					switch($acao){
						case 'cadastrar':
							enderecos($acao,'','',$rua,$numero,$compl,$cep,$bairro,$cidade,$estado);
							contatos($acao,'','',$email,$telCel,$telFixo);
							clientes($acao,'',$nomeCliente,$cpfCliente,$obsCliente);
							break;
						case 'atualizar':
							if(verifyId('cliente',$idCliente)=="nonEcziste"){
								break;
							}
							enderecos($acao,'cliente',$idCliente,$rua,$numero,$compl,$cep,$bairro,$cidade,$estado);
							contatos($acao,'cliente',$idCliente,$email,$telCel,$telFixo);
							clientes($acao,$idCliente,$nomeCliente,$cpfCliente,$obsCliente);
							break;
						case 'editar':
							if(verifyId('cliente',$idCliente)=="nonEcziste"){
								break;
							}
							clientes($acao,$idCliente);
							break;
						case 'excluir':
							if(verifyId('cliente',$idCliente)=="nonEcziste"){
								break;
							}
							clientes($acao,$idCliente);
							break;
					}
					break;
				case 'funcionario':
					$idFuncionario=$_POST['idFuncionario'];
					$nomeFunc=$_POST['nomeFunc'];
					$cpfFuncionario=$_POST['cpfFuncionario'];
					$cargo=$_POST['cargo'];
					$obsFuncionario=$_POST['obsFuncionario'];
					//Contatos
					$email=$_POST['email'];
					$telFixo=$_POST['telFixo'];
					$telCel=$_POST['telCel'];
					//Endereços
					$rua=$_POST['rua'];
					$numero=$_POST['numero'];
					$compl=$_POST['compl'];
					$cep=$_POST['cep'];
					$bairro=$_POST['bairro'];
					$cidade=$_POST['cidade'];
					$estado=$_POST['estado'];
					switch($acao){
						case 'cadastrar':
							enderecos($acao,'','',$rua,$numero,$compl,$cep,$bairro,$cidade,$estado);
							contatos($acao,'','',$email,$telCel,$telFixo);
							funcionarios($acao,'',$nomeFunc,$cpfFuncionario,$cargo,$obsFuncionario);
							break;
						case 'editar':
							if(verifyId('funcionario',$idFuncionario)=="nonEcziste"){
								break;
							}
							funcionarios($acao,$idFuncionario);
							break;
						case 'atualizar':
							if(verifyId('funcionario',$idFuncionario)=="nonEcziste"){
								break;
							}
							enderecos($acao,'funcionario',$idFuncionario,$rua,$numero,$compl,$cep,$bairro,$cidade,$estado);
							contatos($acao,'funcionario',$idFuncionario,$email,$telCel,$telFixo);
							funcionarios($acao,$idFuncionario,$nomeFunc,$cpfFuncionario,$cargo,$obsFuncionario);
							break;
						case 'excluir':
							if(verifyId('funcionario',$idFuncionario)=="nonEcziste"){
								break;
							}
							funcionarios($acao,$idFuncionario);
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
					$idProduto=$_POST['idProduto'];
					$idRemessa=$_POST['idRemessa'];
					$descrProd=$_POST['descrProd'];
					$nomeProd=$_POST['nomeProd'];
					$custoProd=$_POST['custoProd'];
					$valorVenda=$_POST['valorVenda'];
					switch($acao){
						case 'cadastrar':
							produtos($acao,'',$idRemessa,$descrProd,$nomeProd,$custoProd,$valorVenda);
							break;
						case 'atualizar':
							if(verifyId('produto',$idProduto)=="nonEcziste"){
								break;
							}
							produtos($acao,$idProduto,$idRemessa,$descrProd,$nomeProd,$custoProd,$valorVenda);
							break;
						case 'editar':
							if(verifyId('produto',$idProduto)=="nonEcziste"){
								break;
							}
							produtos($acao,$idProduto);
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