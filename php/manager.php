<html>
	<head>
		<meta charset="utf-8" />
		<meta name="author" content="Thiago Jourdan" />
		<title>Software teste de banco de dados de estoque</title>
	</head>
	<body>
		<?php
			require_once('db-queries.php');
			$acao=$_POST['acao'];
			$alvo=$_POST['alvo'];
			switch($alvo){
				case 'fornecedor':
					$idFornecedor=$_POST['idFornecedor'];
					$nomeFantasia=$_POST['nomeFantasia'];
					$cnpj=$_POST['cnpj'];
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
					//Funções
					switch($acao){
						case 'cadastrar':
							enderecos($acao,'','',$rua,$numero,$compl,$cep,$bairro,$cidade,$estado);
							contatos($acao,'','',$email,$telCel,$telFixo);
							fornecedores($acao,'',$nomeFantasia,$cnpj);
							break;
						case 'atualizar':
							verifyId('fornecedor',$idFornecedor);
							enderecos($acao,'fornecedor',$idFornecedor,$rua,$numero,$compl,$cep,$bairro,$cidade,$estado);
							contatos($acao,'fornecedor',$idFornecedor,$email,$telCel,$telFixo);
							fornecedores($acao,$idFornecedor,$nomeFantasia,$cnpj);
							break;
						case 'editar':
							verifyId('fornecedor',$idFornecedor);
							fornecedores($acao,$idFornecedor);
							break;
						case 'excluir':
							verifyId('fornecedor',$idFornecedor);
							fornecedores($acao,$idFornecedor);
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
							verifyId('cliente',$idCliente);
							enderecos($acao,'cliente',$idCliente,$rua,$numero,$compl,$cep,$bairro,$cidade,$estado);
							contatos($acao,'cliente',$idCliente,$email,$telCel,$telFixo);
							clientes($acao,$idCliente,$nomeCliente,$cpfCliente,$obsCliente);
							break;
						case 'editar':
							verifyId('cliente',$idCliente);
							clientes($acao,$idCliente);
							break;
						case 'excluir':
							verifyId('cliente',$idCliente);
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
							verifyId('funcionario',$idFuncionario);
							funcionarios($acao,$idFuncionario);
							break;
						case 'atualizar':
							verifyId('funcionario',$idFuncionario);
							enderecos($acao,'funcionario',$idFuncionario,$rua,$numero,$compl,$cep,$bairro,$cidade,$estado);
							contatos($acao,'funcionario',$idFuncionario,$email,$telCel,$telFixo);
							funcionarios($acao,$idFuncionario,$nomeFunc,$cpfFuncionario,$cargo,$obsFuncionario);
							break;
						case 'excluir':
							verifyId('funcionario',$idFuncionario);
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
							verifyId('produto',$idProduto);
							produtos($acao,$idProduto,$idRemessa,$descrProd,$nomeProd,$custoProd,$valorVenda);
							break;
						case 'editar':
							verifyId('produto',$idProduto);
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