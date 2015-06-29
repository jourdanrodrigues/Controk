<?php
	function fornecedores($acao,$id="-",$nomeFantasia="-",$cnpj="-"){
	// Inicia a conexão
		$mysqli=mysqli_connect('mysql.hostinger.com.br', 'u398318873_tj', 'Knowledge1', 'u398318873_bda');
		if (mysqli_connect_errno()) {
			echo '
			<script>
				alert("Falha ao se conectar ao MySQL:\n('.$mysqli->connect_errno.')\n'.$mysqli->connect_error.'");
				location.href="/trabalhos/gti/bda1/";
			</script>';
			return null;
		}
		switch($acao){
			case 'cadastrar':
			// Algoritmo
				// Pegando ID do endereço e contato
				$getIdEndereco='select id from endereco where id = (select max(id) from endereco);';
				$idEndereco=mysqli_query($mysqli,$getIdEndereco);
				$getIdContato='select id from contato where id = (select max(id) from contato);';
				$idContato=mysqli_query($mysqli,$getIdContato);
				$endereco=mysqli_fetch_row($idEndereco);
				$contato=mysqli_fetch_row($idContato);
				// Iniciando inserção de fornecedor
				$cadFornecedor='insert into fornecedor(nomeFantasia,cnpj,endereco,contato) values ("'.$nomeFantasia.'","'.$cnpj.'","'.$endereco[0].'","'.$contato[0].'");';
				if(!mysqli_query($mysqli,$cadFornecedor)){
					die ('<script>alert("Não foi possível cadastrar o fornecedor: '.mysqli_error($mysqli).'");</script>');
				}else{
					echo '<script>alert("Cadastro de fornecedor finalizado com sucesso!");</script>';
				}
				echo '<script>location.href="/trabalhos/gti/bda1/";</script>';
			// Finaliza a conexão
				mysqli_close($mysqli);
				break;
			case 'excluir':
			// Algoritmo
			// Finaliza a conexão
				mysqli_close($mysqli);
				break;
		}
	}
	function funcionarios($acao,$id="-",$nomeFunc="-",$cpfFuncionario="-",$cargo="-",$obsFuncionario="-"){
	// Inicia a conexão
		$mysqli=mysqli_connect('mysql.hostinger.com.br', 'u398318873_tj', 'Knowledge1', 'u398318873_bda');
		if (mysqli_connect_errno()) {
			echo '
			<script>
				alert("Falha ao se conectar ao MySQL:\n('.$mysqli->connect_errno.')\n'.$mysqli->connect_error.'");
				location.href="/trabalhos/gti/bda1/";
			</script>';
			return null;
		}
		switch($acao){
			case 'cadastrar':
			// Algoritmo
				// Pegando ID do endereço e contato
				$getIdEndereco='select id from endereco where id = (select max(id) from endereco);';
				$idEndereco=mysqli_query($mysqli,$getIdEndereco);
				$getIdContato='select id from contato where id = (select max(id) from contato);';
				$idContato=mysqli_query($mysqli,$getIdContato);
				$endereco=mysqli_fetch_row($idEndereco);
				$contato=mysqli_fetch_row($idContato);
				// Iniciando inserção de fornecedor
				$cadFuncionario='insert into funcionario(nome,cpf,cargo,obs,endereco,contato) values ("'.$nomeFunc.'","'.$cpfFuncionario.'","'.$cargo.'","'.$obsFuncionario.'","'.$endereco[0].'","'.$contato[0].'");';
				if(!mysqli_query($mysqli,$cadFuncionario)){
					die (echo '<script>alert("Não foi possível cadastrar o funcionário: '.mysqli_error($mysqli).'");</script>');
				}else{
					echo '<script>alert("Cadastro de funcionário finalizado com sucesso!");</script>';
				}
				echo '<script>location.href="/trabalhos/gti/bda1/";</script>';
			// Finaliza a conexão
				mysqli_close($mysqli);
				break;
		}
	}
	function clientes($acao,$id="-",$nomeCliente="-",$cpfCliente="-",$obsCliente="-"){
	// Inicia a conexão
		$mysqli=mysqli_connect('mysql.hostinger.com.br', 'u398318873_tj', 'Knowledge1', 'u398318873_bda');
		if (mysqli_connect_errno()) {
			echo '
			<script>
				alert("Falha ao se conectar ao MySQL:\n('.$mysqli->connect_errno.')\n'.$mysqli->connect_error.'");
				location.href="/trabalhos/gti/bda1/";
			</script>';
			return null;
		}
		switch($acao){
			case 'cadastrar':
			// Algoritmo
				// Pegando ID do endereço e contato
				$getIdEndereco='select id from endereco where id = (select max(id) from endereco);';
				$idEndereco=mysqli_query($mysqli,$getIdEndereco);
				$getIdContato='select id from contato where id = (select max(id) from contato);';
				$idContato=mysqli_query($mysqli,$getIdContato);
				$endereco=mysqli_fetch_row($idEndereco);
				$contato=mysqli_fetch_row($idContato);
				// Iniciando inserção de cliente
				$cadCliente='insert into cliente(nome,cpf,obs,endereco,contato) values ("'.$nomeCliente.'","'.$cpfCliente.'","'.$obsCliente.'","'.$endereco[0].'","'.$contato[0].'");';
				if(!mysqli_query($mysqli,$cadCliente)){
					die (echo '<script>alert("Não foi possível cadastrar o cliente: '.mysqli_error($mysqli).'");</script>');
				}else{
					echo '<script>alert("Cadastro de cliente finalizado com sucesso!");</script>';
				}
				echo '<script>location.href="/trabalhos/gti/bda1/";</script>';
			// Finaliza a conexão
				mysqli_close($mysqli);
				break;
			case 'excluir':
			// Finaliza a conexão
				mysqli_close($mysqli);
				break;
		}
	}
	function remessas($acao,$id="-",$idProdutoRem="-",$qtdProdRem="-",$idFornecedorRem="-",$dataPedido="-",$dataPagamento="-",$dataEntrega="-"){
	// Inicia a conexão
		$mysqli=mysqli_connect('mysql.hostinger.com.br', 'u398318873_tj', 'Knowledge1', 'u398318873_bda');
		if (mysqli_connect_errno()) {
			echo '
			<script>
				alert("Falha ao se conectar ao MySQL:\n('.$mysqli->connect_errno.')\n'.$mysqli->connect_error.'");
				location.href="/trabalhos/gti/bda1/";
			</script>';
			return null;
		}
		switch($acao){
			case 'cadastrar':
			// Algoritmo
				$cadRemessa='insert into remessa(produto,fornecedor,dataEntrega,dataPagamento,dataPedido,qtdProd) 
				values ("'.$idProdutoRem.'","'.$idFornecedorRem.'","'.$dataEntrega.'","'.$dataPagamento.'","'.$dataPedido.'","'.$qtdProdRem.'");';
				if(!mysqli_query($mysqli,$cadRemessa)){
					die (echo '<script>alert("Não foi possível cadastrar a remessa: '.mysqli_error($mysqli).'");</script>');
				}else{
					echo '<script>alert("Cadastro de remessa finalizado com sucesso!");</script>';
				}
				echo '<script>location.href="/trabalhos/gti/bda1/";</script>';
			// Finaliza a conexão
				mysqli_close($mysqli);
				break;
		}
	}
	function produtos($acao,$id="-",$idRemessa="-",$descrProd="-",$nomeProd="-",$custoProd="-",$valorVenda="-"){
	// Inicia a conexão
		$mysqli=mysqli_connect('mysql.hostinger.com.br', 'u398318873_tj', 'Knowledge1', 'u398318873_bda');
		if (mysqli_connect_errno()) {
			echo '
			<script>
				alert("Falha ao se conectar ao MySQL:\n('.$mysqli->connect_errno.')\n'.$mysqli->connect_error.'");
				location.href="/trabalhos/gti/bda1/";
			</script>';
			return null;
		}
		switch($acao){
			case 'cadastrar':
			// Algoritmo
				$custoProd2=str_replace('R$ ','',$custoProd);
				$newCustoProd=str_replace(',','.',$custoProd2);
				$valorVenda2=str_replace('R$ ','',$valorVenda);
				$newValorVenda=str_replace(',','.',$valorVenda2);
				$cadProduto='insert into produto(remessa,descricao,nome,custo,valorVenda) 
				values ("'.$idRemessa.'","'.$descrProd.'","'.$nomeProd.'","'.$newCustoProd.'","'.$newValorVenda.'");';
				if(!mysqli_query($mysqli,$cadProduto)){
					die (echo '<script>alert("Não foi possível cadastrar o produto: '.mysqli_error($mysqli).'");</script>');
				}else{
					echo '<script>alert("Cadastro de produto finalizado com sucesso!");</script>';
				}
				echo '<script>location.href="/trabalhos/gti/bda1/";</script>';
			// Finaliza a conexão
				mysqli_close($mysqli);
				break;
		}
	}
	function estoques($acao,$id="-",$idProdutoEstq="-",$qtdProdEstq="-",$idFuncionarioEstq="-",$dataSaida="-"){
	// Inicia a conexão
		$mysqli=mysqli_connect('mysql.hostinger.com.br', 'u398318873_tj', 'Knowledge1', 'u398318873_bda');
		if (mysqli_connect_errno()) {
			echo '
			<script>
				alert("Falha ao se conectar ao MySQL:\n('.$mysqli->connect_errno.')\n'.$mysqli->connect_error.'");
				location.href="/trabalhos/gti/bda1/";
			</script>';
			return null;
		}
		switch($acao){
			case 'inserir':
			// Algoritmo
				$insEstoque='insert into estoque(produto,qtdProd) 
				values ("'.$idProdutoEstq.'","'.$qtdProdEstq.'");';
				if(!mysqli_query($mysqli,$insEstoque)){
					die (echo '<script>alert("Não foi possível inserir o produto no estoque: '.mysqli_error($mysqli).'");</script>');
				}else{
					echo '<script>alert("Produto inserido no estoque com sucesso!");</script>';
				}
				echo '<script>location.href="/trabalhos/gti/bda1/";</script>';
			// Finaliza a conexão
				mysqli_close($mysqli);
				break;
			case 'retirar':
			// Finaliza a conexão
				mysqli_close($mysqli);
				break;
		}
	}
	function enderecos($rua,$numero,$compl,$cep,$bairro,$cidade,$estado){
	// Inicia a conexão
		$mysqli=mysqli_connect('mysql.hostinger.com.br', 'u398318873_tj', 'Knowledge1', 'u398318873_bda');
		if (mysqli_connect_errno()) {
			echo '
			<script>
				alert("Falha ao se conectar ao MySQL:\n('.$mysqli->connect_errno.')\n'.$mysqli->connect_error.'");
				location.href="/trabalhos/gti/bda1/";
			</script>';
			return null;
		}
	// Algoritmo
		$cadEndereco='insert into endereco(rua,numero,complemento,cep,bairro,cidade,estado) values ("'.$rua.'",'.$numero.',"'.$compl.'","'.$cep.'","'.$bairro.'","'.$cidade.'","'.$estado.'");';
		if(!mysqli_query($mysqli,$cadEndereco)){
			die (echo '
			<script>
				alert("Não foi possível cadastrar o endereço: '.mysqli_error($mysqli).'");
				location.href="/trabalhos/gti/bda1/";
			</script>');
		}
	// Finaliza a conexão
		mysqli_close($mysqli);
	}
	function contatos($email,$telCel,$telFixo){
	// Inicia a conexão
		$mysqli=mysqli_connect('mysql.hostinger.com.br', 'u398318873_tj', 'Knowledge1', 'u398318873_bda');
		if (mysqli_connect_errno()) {
			echo '
			<script>
				alert("Falha ao se conectar ao MySQL:\n('.$mysqli->connect_errno.')\n'.$mysqli->connect_error.'");
				location.href="/trabalhos/gti/bda1/";
			</script>';
			return null;
		}
	// Algoritmo
		$cadContato='insert into contato(email,telCel,telFixo) values ("'.$email.'","'.$telCel.'","'.$telFixo.'");';
		if(!mysqli_query($mysqli,$cadContato)){
			die (echo '
			<script>
				alert("Não foi possível cadastrar o contato: '.mysqli_error($mysqli).'");
				location.href="/trabalhos/gti/bda1/";
			</script>');
		}
	// Finaliza a conexão
		mysqli_close($mysqli);
	}
?>