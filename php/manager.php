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
					if($acao=='cadastrar'){
						enderecos($rua,$numero,$compl,$cep,$bairro,$cidade,$estado);
						contatos($email,$telCel,$telFixo);
						fornecedores($acao,'',$nomeFantasia,$cnpj);
					}elseif($acao=='editar'){
						fornecedores($acao,$idFornecedor);
					}elseif($acao=='excluir'){
						fornecedores($acao,$idFornecedor);
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
							enderecos($rua,$numero,$compl,$cep,$bairro,$cidade,$estado);
							contatos($email,$telCel,$telFixo);
							clientes($acao,'',$nomeCliente,$cpfCliente,$obsCliente);
							break;
						case 'editar':
							clientes($acao,$idCliente);
							break;
						case 'excluir':
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
							enderecos($rua,$numero,$compl,$cep,$bairro,$cidade,$estado);
							contatos($email,$telCel,$telFixo);
							funcionarios($acao,'',$nomeFunc,$cpfFuncionario,$cargo,$obsFuncionario);
							break;
						case 'editar':
							funcionarios($acao,$idFuncionario);
							break;
						case 'excluir':
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
						case 'editar':
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