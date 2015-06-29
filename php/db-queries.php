<?php
	function fornecedores($acao,$id="-",$nomeFantasia="-",$cnpj="-"){
		switch($acao){
			case 'cadastrar':
				// Pegando ID do endereço e contato
				$getIdEndereco='select id from endereco where id = (select max(id) from endereco);';
				$idEndereco=mysql_query($getIdEndereco);
				$getIdContato='select id from contato where id = (select max(id) from contato);';
				$idContato=mysql_query($getIdContato);
				$endereco=mysql_fetch_row($idEndereco);
				$contato=mysql_fetch_row($idContato);
				// Iniciando inserção de fornecedor
				$cadFornecedor='insert into fornecedor(nomeFantasia,cnpj,endereco,contato) values ("'.$nomeFantasia.'","'.$cnpj.'","'.$endereco[0].'","'.$contato[0].'");';
				if(!mysql_query($cadFornecedor)){
					die ('Não foi possível cadastrar o fornecedor: '.mysql_error());
				}else{
					echo '<script>alert("Cadastro de fornecedor finalizado com sucesso!");location.href="/trabalhos/gti/bda1/";</script>';
				}
				break;
		}
	}
	function funcionarios($acao,$id="-",$nomeFunc="-",$cpfFuncionario="-",$cargo="-",$obsFuncionario="-"){
		switch($acao){
			case 'cadastrar':
				// Pegando ID do endereço e contato
				$getIdEndereco='select id from endereco where id = (select max(id) from endereco);';
				$idEndereco=mysql_query($getIdEndereco);
				$getIdContato='select id from contato where id = (select max(id) from contato);';
				$idContato=mysql_query($getIdContato);
				$endereco=mysql_fetch_row($idEndereco);
				$contato=mysql_fetch_row($idContato);
				// Iniciando inserção de fornecedor
				$cadFuncionario='insert into funcionario(nome,cpf,cargo,obs,endereco,contato) values ("'.$nomeFunc.'","'.$cpfFuncionario.'","'.$cargo.'","'.$obsFuncionario.'","'.$endereco[0].'","'.$contato[0].'");';
				if(!mysql_query($cadFuncionario)){
					die ('Não foi possível cadastrar o funcionário: '.mysql_error());
				}else{
					echo '<script>alert("Cadastro de funcionário finalizado com sucesso!");location.href="/trabalhos/gti/bda1/";</script>';
				}
				break;
		}
	}
	function clientes($acao,$id="-",$nomeCliente="-",$cpfCliente="-",$obsCliente="-"){
		switch($acao){
			case 'cadastrar':
				// Pegando ID do endereço e contato
				$getIdEndereco='select id from endereco where id = (select max(id) from endereco);';
				$idEndereco=mysql_query($getIdEndereco);
				$getIdContato='select id from contato where id = (select max(id) from contato);';
				$idContato=mysql_query($getIdContato);
				$endereco=mysql_fetch_row($idEndereco);
				$contato=mysql_fetch_row($idContato);
				// Iniciando inserção de cliente
				$cadCliente='insert into cliente(nome,cpf,obs,endereco,contato) values ("'.$nomeCliente.'","'.$cpfCliente.'","'.$obsCliente.'","'.$endereco[0].'","'.$contato[0].'");';
				if(!mysql_query($cadCliente)){
					die ('Não foi possível cadastrar o cliente: '.mysql_error());
				}else{
					echo '<script>alert("Cadastro de cliente finalizado com sucesso!");location.href="/trabalhos/gti/bda1/";</script>';
				}
				break;
		}
	}
	function remessas($acao,$id="-",$idProdutoRem="-",$qtdProdRem="-",$idFornecedorRem="-",$dataPedido="-",$dataPagamento="-",$dataEntrega="-"){
		switch($acao){
			case 'cadastrar':
				$cadRemessa='insert into remessa(produto,fornecedor,dataEntrega,dataPagamento,dataPedido,qtdProd) 
				values ("'.$idProdutoRem.'","'.$idFornecedorRem.'","'.$dataEntrega.'","'.$dataPagamento.'","'.$dataPedido.'","'.$qtdProdRem.'");';
				if(!mysql_query($cadRemessa)){
					die ('Não foi possível cadastrar a remessa: '.mysql_error());
				}else{
					echo '<script>alert("Cadastro de remessa finalizado com sucesso!");location.href="/trabalhos/gti/bda1/";</script>';
				}
				break;
		}
	}
	function produtos($acao,$id="-",$idRemessa="-",$descrProd="-",$nomeProd="-",$custoProd="-",$valorVenda="-"){
		switch($acao){
			case 'cadastrar':
				$custoProd2=str_replace('R$ ','',$custoProd);
				$newCustoProd=str_replace(',','.',$custoProd2);
				$valorVenda2=str_replace('R$ ','',$valorVenda);
				$newValorVenda=str_replace(',','.',$valorVenda2);
				$cadProduto='insert into produto(remessa,descricao,nome,custo,valorVenda) 
				values ("'.$idRemessa.'","'.$descrProd.'","'.$nomeProd.'","'.$newCustoProd.'","'.$newValorVenda.'");';
				if(!mysql_query($cadProduto)){
					die ('Não foi possível cadastrar o produto: '.mysql_error());
				}else{
					echo '<script>alert("Cadastro de produto finalizado com sucesso!");location.href="/trabalhos/gti/bda1/";</script>';
				}
				break;
		}
	}
	function estoques($acao,$id="-",$idProdutoEstq="-",$qtdProdEstq="-",$idFuncionarioEstq="-",$dataSaida="-"){
		switch($acao){
			case 'inserir':
				$insEstoque='insert into estoque(produto,qtdProd) 
				values ("'.$idProdutoEstq.'","'.$qtdProdEstq.'");';
				if(!mysql_query($insEstoque)){
					die ('Não foi possível inserir o produto no estoque: '.mysql_error());
				}else{
					echo '<script>alert("Produto inserido no estoque com sucesso!");location.href="/trabalhos/gti/bda1/";</script>';
				}
				break;
			case 'retirar':
				break;
		}
	}
	function enderecos($rua,$numero,$compl,$cep,$bairro,$cidade,$estado){
		$cadEndereco='insert into endereco(rua,numero,complemento,cep,bairro,cidade,estado) values ("'.$rua.'",'.$numero.',"'.$compl.'","'.$cep.'","'.$bairro.'","'.$cidade.'","'.$estado.'");';
		if(!mysql_query($cadEndereco)){
			die ('Não foi possível cadastrar o endereço: '.mysql_error());
		}
	}
	function contatos($email,$telCel,$telFixo){
		$cadContato='insert into contato(email,telCel,telFixo) values ("'.$email.'","'.$telCel.'","'.$telFixo.'");';
		if(!mysql_query($cadContato)){
			die ('Não foi possível cadastrar o contato: '.mysql_error());
		}
	}
	function conexao(){
		$conn=mysql_connect('mysql.hostinger.com.br','u398318873_tj','Knowledge1') or die ('Erro na rotina de conexão: '.mysql_error());
		mysql_select_db('u398318873_bda') or die ('Erro ao selecionar o banco de dados: '.mysql_error());
	}
	/*
	$queryTeste='select campo from tabela where campo = valor;'; - Comando SQL
	$teste=mysql_query($queryTeste); - Retorna o valor na variável
	print mysql_fetch_row($teste); - Mostra na tela
	*/
?>