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
				$endereco=mysqli_fetch_row($idEndereco);
				$getIdContato='select id from contato where id = (select max(id) from contato);';
				$idContato=mysqli_query($mysqli,$getIdContato);
				$contato=mysqli_fetch_row($idContato);
				// Iniciando inserção de fornecedor
				$cadFornecedor='insert into fornecedor(nomeFantasia,cnpj,endereco,contato) values ("'.$nomeFantasia.'","'.$cnpj.'","'.$endereco[0].'","'.$contato[0].'");';
				if(!mysqli_query($mysqli,$cadFornecedor)){
					die ('
					<script>
						alert("Não foi possível cadastrar o fornecedor: '.mysqli_error($mysqli).'");
						location.href="/trabalhos/gti/bda1/";
					</script>');
				}else{
					echo '<script>alert("Cadastro de fornecedor finalizado com sucesso!");location.href="/trabalhos/gti/bda1/";</script>';
				}
			// Finaliza a conexão
				mysqli_close($mysqli);
				break;
			case 'atualizar':
			// Algoritmo
				$updFornecedor='update fornecedor set cnpj="'.$cnpj.'",nomeFantasia="'.$nomeFantasia.'" where id='.$id.';';
				if(!mysqli_query($mysqli,$updFornecedor)){
					die ('
					<script>
						alert("Não foi possível atualizar o fornecedor: '.mysqli_error($mysqli).'");
						location.href="/trabalhos/gti/bda1/";
					</script>');
				}else{
					echo '<script>alert("Atualização de fornecedor finalizada com sucesso!");location.href="/trabalhos/gti/bda1/";</script>';
				}
			// Finaliza a conexão
				mysqli_close($mysqli);
				break;
			case 'editar':
				echo '<form id="phpForm" action="/trabalhos/gti/bda1/" method="POST">';
			//Fornecedor
				echo '<input type="hidden" name="idFornecedor" value="'.$id.'">';
				//Pega Nome do fornecedor
				$queryNome='select nomeFantasia from fornecedor where id='.$id.';';
				$getNome=mysqli_query($mysqli,$queryNome);
				$nome=mysqli_fetch_row($getNome);
				echo '<input type="hidden" name="nomeFantasia" value="'.$nome[0].'">';
				//Pega CNPJ do fornecedor
				$queryCNPJ='select cnpj from fornecedor where id='.$id.';';
				$getCNPJ=mysqli_query($mysqli,$queryCNPJ);
				$cnpj=mysqli_fetch_row($getCNPJ);
				echo '<input type="hidden" name="cnpj" value="'.$cnpj[0].'">';
			//Endereço
				//Pega ID do endereco
				$queryIdEndereco='select endereco from fornecedor where id='.$id.';';
				$getIdEndereco=mysqli_query($mysqli,$queryIdEndereco);
				$endereco=mysqli_fetch_row($getIdEndereco);
				//Rua
				$queryRua='select rua from endereco where id='.$endereco[0].';';
				$getRua=mysqli_query($mysqli,$queryRua); $rua=mysqli_fetch_row($getRua);
				echo '<input type="hidden" name="rua" value="'.$rua[0].'">';
				//Numero
				$queryNumero='select numero from endereco where id='.$endereco[0].';';
				$getNumero=mysqli_query($mysqli,$queryNumero); $numero=mysqli_fetch_row($getNumero);
				echo '<input type="hidden" name="numero" value="'.$numero[0].'">';
				//Complemento
				$queryComplemento='select complemento from endereco where id='.$endereco[0].';';
				$getComplemento=mysqli_query($mysqli,$queryComplemento); $complemento=mysqli_fetch_row($getComplemento);
				echo '<input type="hidden" name="compl" value="'.$complemento[0].'">';
				//CEP
				$queryCEP='select cep from endereco where id='.$endereco[0].';';
				$getCEP=mysqli_query($mysqli,$queryCEP); $cep=mysqli_fetch_row($getCEP);
				echo '<input type="hidden" name="cep" value="'.$cep[0].'">';
				//Bairro
				$queryBairro='select bairro from endereco where id='.$endereco[0].';';
				$getBairro=mysqli_query($mysqli,$queryBairro); $bairro=mysqli_fetch_row($getBairro);
				echo '<input type="hidden" name="bairro" value="'.$bairro[0].'">';
				//Cidade
				$queryCidade='select cidade from endereco where id='.$endereco[0].';';
				$getCidade=mysqli_query($mysqli,$queryCidade); $cidade=mysqli_fetch_row($getCidade);
				echo '<input type="hidden" name="cidade" value="'.$cidade[0].'">';
				//Estado
				$queryEstado='select estado from endereco where id='.$endereco[0].';';
				$getEstado=mysqli_query($mysqli,$queryEstado); $estado=mysqli_fetch_row($getEstado);
				echo '<input type="hidden" name="estado" value="'.$estado[0].'">';
			//Contato
				//Pega ID do endereco
				$queryIdContato='select contato from fornecedor where id='.$id.';';
				$getIdContato=mysqli_query($mysqli,$queryIdContato);
				$contato=mysqli_fetch_row($getIdContato);
				//Email
				$queryEmail='select email from contato where id='.$contato[0].';';
				$getEmail=mysqli_query($mysqli,$queryEmail); $email=mysqli_fetch_row($getEmail);
				echo '<input type="hidden" name="email" value="'.$email[0].'">';
				//Celular
				$queryTelCel='select telCel from contato where id='.$contato[0].';';
				$getTelCel=mysqli_query($mysqli,$queryTelCel); $telCel=mysqli_fetch_row($getTelCel);
				echo '<input type="hidden" name="telCel" value="'.$telCel[0].'">';
				//Fixo
				$queryTelFixo='select telFixo from contato where id='.$contato[0].';';
				$getTelFixo=mysqli_query($mysqli,$queryTelFixo); $telFixo=mysqli_fetch_row($getTelFixo);
				echo '<input type="hidden" name="telFixo" value="'.$telFixo[0].'">';
				echo '</form>';
				echo '<script src="/trabalhos/gti/bda1/js/jQuery.js"></script>';
				echo "<script>$('#phpForm').submit();</script>";
				// Finaliza a conexão
				mysqli_close($mysqli);
				break;
			case 'excluir':
			// Algoritmo
				//Pega ID do endereco
				$getIdEndereco='select endereco from fornecedor where id='.$id.';';
				$idEndereco=mysqli_query($mysqli,$getIdEndereco);
				$endereco=mysqli_fetch_row($idEndereco);
				//Pega ID do contato
				$getIdContato='select endereco from fornecedor where id='.$id.';';
				$idContato=mysqli_query($mysqli,$getIdContato);
				$contato=mysqli_fetch_row($idContato);
				//Pega Nome do fornecedor
				$getNome='select nome from fornecedor where id='.$id.';';
				$nomeFunc=mysqli_query($mysqli,$getNome);
				$nome=mysqli_fetch_row($nomeFunc);
				//Estabelece funções de exclusão
				$delFornecedor='delete from fornecedor where id='.$id.';';
				$delEndereco='delete from endereco where id='.$endereco[0].';';
				$delContato='delete from contato where id='.$contato[0].';';
				if(!mysqli_query($mysqli,$delContato)){
					die ('
					<script>
						alert("Não foi possível excluir o contato fornecedor: '.mysqli_error($mysqli).'");
						location.href="/trabalhos/gti/bda1/";
					</script>');
				}
				if(!mysqli_query($mysqli,$delEndereco)){
					die ('
					<script>
						alert("Não foi possível excluir o endereço fornecedor: '.mysqli_error($mysqli).'");
						location.href="/trabalhos/gti/bda1/";
					</script>');
				}
				if(!mysqli_query($mysqli,$delFornecedor)){
					die ('
					<script>
						alert("Não foi possível excluir o fornecedor: '.mysqli_error($mysqli).'");
						location.href="/trabalhos/gti/bda1/";
					</script>');
				}else{
					echo '<script>alert("Exclusão do fornecedor \"'.$nome[0].'\" finalizada com sucesso!");location.href="/trabalhos/gti/bda1/";</script>';
				}
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
				// Pega ID do endereço
				$getIdEndereco='select id from endereco where id = (select max(id) from endereco);';
				$idEndereco=mysqli_query($mysqli,$getIdEndereco);
				$endereco=mysqli_fetch_row($idEndereco);
				// Pega ID do contato
				$getIdContato='select id from contato where id = (select max(id) from contato);';
				$idContato=mysqli_query($mysqli,$getIdContato);
				$contato=mysqli_fetch_row($idContato);
				// Iniciando inserção de fornecedor
				$cadFuncionario='insert into funcionario(nome,cpf,cargo,obs,endereco,contato) values ("'.$nomeFunc.'","'.$cpfFuncionario.'","'.$cargo.'","'.$obsFuncionario.'","'.$endereco[0].'","'.$contato[0].'");';
				if(!mysqli_query($mysqli,$cadFuncionario)){
					die ('
					<script>
						alert("Não foi possível cadastrar o funcionário:\n\n'.mysqli_error($mysqli).'");
						location.href="/trabalhos/gti/bda1/";
					</script>');
				}else{
					echo '<script>alert("Cadastro de funcionário finalizado com sucesso!");location.href="/trabalhos/gti/bda1/";</script>';
				}
			// Finaliza a conexão
				mysqli_close($mysqli);
				break;
			case 'atualizar':
			// Algoritmo
				$updFuncionario='update funcionario set nome="'.$nomeFunc.'",cpf="'.$cpfFuncionario.'",obs="'.$obsFuncionario.'",cargo="'.$cargo.'" where id='.$id.';';
				if(!mysqli_query($mysqli,$updFuncionario)){
					die ('
					<script>
						alert("Não foi possível atualizar o funcionário: '.mysqli_error($mysqli).'");
						location.href="/trabalhos/gti/bda1/";
					</script>');
				}else{
					echo '<script>alert("Atualização de funcionário finalizada com sucesso!");location.href="/trabalhos/gti/bda1/";</script>';
				}
			// Finaliza a conexão
				mysqli_close($mysqli);
				break;
			case 'editar':
				echo '<form id="phpForm" action="/trabalhos/gti/bda1/" method="POST">';
			//Funcionário
				echo '<input type="hidden" name="idFuncionario" value="'.$id.'">';
				//Pega Nome do funcionário
				$queryNome='select nome from funcionario where id='.$id.';';
				$getNome=mysqli_query($mysqli,$queryNome);
				$nome=mysqli_fetch_row($getNome);
				echo '<input type="hidden" name="nomeFunc" value="'.$nome[0].'">';
				//Pega CPF do funcionário
				$queryCPF='select cpf from funcionario where id='.$id.';';
				$getCPF=mysqli_query($mysqli,$queryCPF);
				$cpf=mysqli_fetch_row($getCPF);
				echo '<input type="hidden" name="cpf" value="'.$cpf[0].'">';
				//Pega Cargo do funcionário
				$queryCargo='select cargo from funcionario where id='.$id.';';
				$getCargo=mysqli_query($mysqli,$queryCargo);
				$cargo=mysqli_fetch_row($getCargo);
				echo '<input type="hidden" name="cargo" value="'.$cargo[0].'">';
				//Pega Observação do funcionário
				$queryObs='select obs from funcionario where id='.$id.';';
				$getObs=mysqli_query($mysqli,$queryObs);
				$obs=mysqli_fetch_row($getObs);
				echo '<input type="hidden" name="obs" value="'.$obs[0].'">';
			//Endereço
				//Pega ID do endereco
				$queryIdEndereco='select endereco from funcionario where id='.$id.';';
				$getIdEndereco=mysqli_query($mysqli,$queryIdEndereco);
				$endereco=mysqli_fetch_row($getIdEndereco);
				//Rua
				$queryRua='select rua from endereco where id='.$endereco[0].';';
				$getRua=mysqli_query($mysqli,$queryRua); $rua=mysqli_fetch_row($getRua);
				echo '<input type="hidden" name="rua" value="'.$rua[0].'">';
				//Numero
				$queryNumero='select numero from endereco where id='.$endereco[0].';';
				$getNumero=mysqli_query($mysqli,$queryNumero); $numero=mysqli_fetch_row($getNumero);
				echo '<input type="hidden" name="numero" value="'.$numero[0].'">';
				//Complemento
				$queryComplemento='select complemento from endereco where id='.$endereco[0].';';
				$getComplemento=mysqli_query($mysqli,$queryComplemento); $complemento=mysqli_fetch_row($getComplemento);
				echo '<input type="hidden" name="compl" value="'.$complemento[0].'">';
				//CEP
				$queryCEP='select cep from endereco where id='.$endereco[0].';';
				$getCEP=mysqli_query($mysqli,$queryCEP); $cep=mysqli_fetch_row($getCEP);
				echo '<input type="hidden" name="cep" value="'.$cep[0].'">';
				//Bairro
				$queryBairro='select bairro from endereco where id='.$endereco[0].';';
				$getBairro=mysqli_query($mysqli,$queryBairro); $bairro=mysqli_fetch_row($getBairro);
				echo '<input type="hidden" name="bairro" value="'.$bairro[0].'">';
				//Cidade
				$queryCidade='select cidade from endereco where id='.$endereco[0].';';
				$getCidade=mysqli_query($mysqli,$queryCidade); $cidade=mysqli_fetch_row($getCidade);
				echo '<input type="hidden" name="cidade" value="'.$cidade[0].'">';
				//Estado
				$queryEstado='select estado from endereco where id='.$endereco[0].';';
				$getEstado=mysqli_query($mysqli,$queryEstado); $estado=mysqli_fetch_row($getEstado);
				echo '<input type="hidden" name="estado" value="'.$estado[0].'">';
			//Contato
				//Pega ID do endereco
				$queryIdContato='select contato from funcionario where id='.$id.';';
				$getIdContato=mysqli_query($mysqli,$queryIdContato);
				$contato=mysqli_fetch_row($getIdContato);
				//Email
				$queryEmail='select email from contato where id='.$contato[0].';';
				$getEmail=mysqli_query($mysqli,$queryEmail); $email=mysqli_fetch_row($getEmail);
				echo '<input type="hidden" name="email" value="'.$email[0].'">';
				//Celular
				$queryTelCel='select telCel from contato where id='.$contato[0].';';
				$getTelCel=mysqli_query($mysqli,$queryTelCel); $telCel=mysqli_fetch_row($getTelCel);
				echo '<input type="hidden" name="telCel" value="'.$telCel[0].'">';
				//Fixo
				$queryTelFixo='select telFixo from contato where id='.$contato[0].';';
				$getTelFixo=mysqli_query($mysqli,$queryTelFixo); $telFixo=mysqli_fetch_row($getTelFixo);
				echo '<input type="hidden" name="telFixo" value="'.$telFixo[0].'">';
				echo '</form>';
				echo '<script src="/trabalhos/gti/bda1/js/jQuery.js"></script>';
				echo "<script>$('#phpForm').submit();</script>";
				break;
			case 'excluir':
			// Algoritmo
				//Pega ID do endereco
				$getIdEndereco='select endereco from funcionario where id='.$id.';';
				$idEndereco=mysqli_query($mysqli,$getIdEndereco);
				$endereco=mysqli_fetch_row($idEndereco);
				//Pega ID do contato
				$getIdContato='select endereco from funcionario where id='.$id.';';
				$idContato=mysqli_query($mysqli,$getIdContato);
				$contato=mysqli_fetch_row($idContato);
				//Pega Nome do funcionário
				$getNome='select nome from funcionario where id='.$id.';';
				$nomeFunc=mysqli_query($mysqli,$getNome);
				$nome=mysqli_fetch_row($nomeFunc);
				//Estabelece funções de exclusão
				$delFuncionario='delete from funcionario where id='.$id.';';
				$delEndereco='delete from endereco where id='.$endereco[0].';';
				$delContato='delete from contato where id='.$contato[0].';';
				if(!mysqli_query($mysqli,$delEndereco)){
					die ('
					<script>
						alert("Não foi possível excluir o endereço do funcionário:\n\n'.mysqli_error($mysqli).'");
						location.href="/trabalhos/gti/bda1/";
					</script>');
				}
				if(!mysqli_query($mysqli,$delContato)){
					die ('
					<script>
						alert("Não foi possível excluir o contato do funcionário:\n\n'.mysqli_error($mysqli).'");
						location.href="/trabalhos/gti/bda1/";
					</script>');
				}
				if(!mysqli_query($mysqli,$delFuncionario)){
					die ('
					<script>
						alert("Não foi possível excluir o funcionário:\n\n'.mysqli_error($mysqli).'");
						location.href="/trabalhos/gti/bda1/";
					</script>');
				}else{
					echo '<script>alert("Exclusão do funcionário \"'.$nome[0].'\" finalizada com sucesso!");location.href="/trabalhos/gti/bda1/";</script>';
				}
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
				$queryIdEndereco='select id from endereco where id = (select max(id) from endereco);';
				$getIdEndereco=mysqli_query($mysqli,$queryIdEndereco);
				$endereco=mysqli_fetch_row($getIdEndereco);
				$queryIdContato='select id from contato where id = (select max(id) from contato);';
				$getIdContato=mysqli_query($mysqli,$queryIdContato);
				$contato=mysqli_fetch_row($getIdContato);
				// Iniciando inserção de cliente
				$cadCliente='insert into cliente(nome,cpf,obs,endereco,contato) values ("'.$nomeCliente.'","'.$cpfCliente.'","'.$obsCliente.'","'.$endereco[0].'","'.$contato[0].'");';
				if(!mysqli_query($mysqli,$cadCliente)){
					die ('
					<script>
						alert("Não foi possível cadastrar o cliente:\n\n'.mysqli_error($mysqli).'");
						location.href="/trabalhos/gti/bda1/";
					</script>');
				}else{
					echo '<script>alert("Cadastro de cliente finalizado com sucesso!");location.href="/trabalhos/gti/bda1/";</script>';
				}
			// Finaliza a conexão
				mysqli_close($mysqli);
				break;
			case 'atualizar':
			// Algoritmo
				$updCliente='update cliente set nome="'.$nomeCliente.'",cpf="'.$cpfCliente.'",obs="'.$obsCliente.'" where id='.$id.';';
				if(!mysqli_query($mysqli,$updCliente)){
					die ('
					<script>
						alert("Não foi possível atualizar o cliente: '.mysqli_error($mysqli).'");
						location.href="/trabalhos/gti/bda1/";
					</script>');
				}else{
					echo '<script>alert("Atualização de cliente finalizada com sucesso!");location.href="/trabalhos/gti/bda1/";</script>';
				}
			// Finaliza a conexão
				mysqli_close($mysqli);
				break;
			case 'editar':
				echo '<form id="phpForm" action="/trabalhos/gti/bda1/" method="POST">';
			//Cliente
				echo '<input type="hidden" name="idCliente" value="'.$id.'">';
				//Pega Nome do cliente
				$queryNome='select nome from cliente where id='.$id.';';
				$getNome=mysqli_query($mysqli,$queryNome);
				$nome=mysqli_fetch_row($getNome);
				echo '<input type="hidden" name="nomeCliente" value="'.$nome[0].'">';
				//Pega CPF do funcionário
				$queryCPF='select cpf from cliente where id='.$id.';';
				$getCPF=mysqli_query($mysqli,$queryCPF);
				$cpf=mysqli_fetch_row($getCPF);
				echo '<input type="hidden" name="cpf" value="'.$cpf[0].'">';
				//Pega Observação do funcionário
				$queryObs='select obs from cliente where id='.$id.';';
				$getObs=mysqli_query($mysqli,$queryObs);
				$obs=mysqli_fetch_row($getObs);
				echo '<input type="hidden" name="obs" value="'.$obs[0].'">';
			//Endereço
				//Pega ID do endereco
				$queryIdEndereco='select endereco from cliente where id='.$id.';';
				$getIdEndereco=mysqli_query($mysqli,$queryIdEndereco);
				$endereco=mysqli_fetch_row($getIdEndereco);
				//Rua
				$queryRua='select rua from endereco where id='.$endereco[0].';';
				$getRua=mysqli_query($mysqli,$queryRua); $rua=mysqli_fetch_row($getRua);
				echo '<input type="hidden" name="rua" value="'.$rua[0].'">';
				//Numero
				$queryNumero='select numero from endereco where id='.$endereco[0].';';
				$getNumero=mysqli_query($mysqli,$queryNumero); $numero=mysqli_fetch_row($getNumero);
				echo '<input type="hidden" name="numero" value="'.$numero[0].'">';
				//Complemento
				$queryComplemento='select complemento from endereco where id='.$endereco[0].';';
				$getComplemento=mysqli_query($mysqli,$queryComplemento); $complemento=mysqli_fetch_row($getComplemento);
				echo '<input type="hidden" name="compl" value="'.$complemento[0].'">';
				//CEP
				$queryCEP='select cep from endereco where id='.$endereco[0].';';
				$getCEP=mysqli_query($mysqli,$queryCEP); $cep=mysqli_fetch_row($getCEP);
				echo '<input type="hidden" name="cep" value="'.$cep[0].'">';
				//Bairro
				$queryBairro='select bairro from endereco where id='.$endereco[0].';';
				$getBairro=mysqli_query($mysqli,$queryBairro); $bairro=mysqli_fetch_row($getBairro);
				echo '<input type="hidden" name="bairro" value="'.$bairro[0].'">';
				//Cidade
				$queryCidade='select cidade from endereco where id='.$endereco[0].';';
				$getCidade=mysqli_query($mysqli,$queryCidade); $cidade=mysqli_fetch_row($getCidade);
				echo '<input type="hidden" name="cidade" value="'.$cidade[0].'">';
				//Estado
				$queryEstado='select estado from endereco where id='.$endereco[0].';';
				$getEstado=mysqli_query($mysqli,$queryEstado); $estado=mysqli_fetch_row($getEstado);
				echo '<input type="hidden" name="estado" value="'.$estado[0].'">';
			//Contato
				//Pega ID do endereco
				$queryIdContato='select contato from cliente where id='.$id.';';
				$getIdContato=mysqli_query($mysqli,$queryIdContato);
				$contato=mysqli_fetch_row($getIdContato);
				//Email
				$queryEmail='select email from contato where id='.$contato[0].';';
				$getEmail=mysqli_query($mysqli,$queryEmail); $email=mysqli_fetch_row($getEmail);
				echo '<input type="hidden" name="email" value="'.$email[0].'">';
				//Celular
				$queryTelCel='select telCel from contato where id='.$contato[0].';';
				$getTelCel=mysqli_query($mysqli,$queryTelCel); $telCel=mysqli_fetch_row($getTelCel);
				echo '<input type="hidden" name="telCel" value="'.$telCel[0].'">';
				//Fixo
				$queryTelFixo='select telFixo from contato where id='.$contato[0].';';
				$getTelFixo=mysqli_query($mysqli,$queryTelFixo); $telFixo=mysqli_fetch_row($getTelFixo);
				echo '<input type="hidden" name="telFixo" value="'.$telFixo[0].'">';
				echo '</form>';
				echo '<script src="/trabalhos/gti/bda1/js/jQuery.js"></script>';
				echo "<script>$('#phpForm').submit();</script>";
				break;
			case 'excluir':
			// Algoritmo
				//Pega ID do endereco
				$getIdEndereco='select endereco from cliente where id='.$id.';';
				$idEndereco=mysqli_query($mysqli,$getIdEndereco);
				$endereco=mysqli_fetch_row($idEndereco);
				//Pega ID do contato
				$getIdContato='select endereco from cliente where id='.$id.';';
				$idContato=mysqli_query($mysqli,$getIdContato);
				$contato=mysqli_fetch_row($idContato);
				//Pega Nome do cliente
				$getNome='select nome from cliente where id='.$id.';';
				$nomeFunc=mysqli_query($mysqli,$getNome);
				$nome=mysqli_fetch_row($nomeFunc);
				//Estabelece funções de exclusão
				$delCliente='delete from cliente where id='.$id.';';
				$delEndereco='delete from endereco where id='.$endereco[0].';';
				$delContato='delete from contato where id='.$contato[0].';';
				if(!mysqli_query($mysqli,$delEndereco)){
					die ('
					<script>
						alert("Não foi possível excluir o endereço cliente:\n\n'.mysqli_error($mysqli).'");
						location.href="/trabalhos/gti/bda1/";
					</script>');
				}
				if(!mysqli_query($mysqli,$delContato)){
					die ('
					<script>
						alert("Não foi possível excluir o contato cliente:\n\n'.mysqli_error($mysqli).'");
						location.href="/trabalhos/gti/bda1/";
					</script>');
				}
				if(!mysqli_query($mysqli,$delCliente)){
					die ('
					<script>
						alert("Não foi possível excluir o cliente:\n\n'.mysqli_error($mysqli).'");
						location.href="/trabalhos/gti/bda1/";
					</script>');
				}else{
					echo '<script>alert("Exclusão do cliente \"'.$nome[0].'\" finalizada com sucesso!");location.href="/trabalhos/gti/bda1/";</script>';
				}
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
					die ('
					<script>
						alert("Não foi possível cadastrar a remessa: '.mysqli_error($mysqli).'");
						location.href="/trabalhos/gti/bda1/";
					</script>');
				}else{
					echo '<script>alert("Cadastro de remessa finalizado com sucesso!");location.href="/trabalhos/gti/bda1/";</script>';
				}
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
					die ('
					<script>
						alert("Não foi possível cadastrar o produto: '.mysqli_error($mysqli).'");
						location.href="/trabalhos/gti/bda1/";
					</script>');
				}else{
					echo '<script>alert("Cadastro de produto finalizado com sucesso!");location.href="/trabalhos/gti/bda1/";</script>';
				}
			// Finaliza a conexão
				mysqli_close($mysqli);
				break;
			case 'atualizar':
			// Algoritmo
				$custoProd2=str_replace('R$ ','',$custoProd);
				$newCustoProd=str_replace(',','.',$custoProd2);
				$valorVenda2=str_replace('R$ ','',$valorVenda);
				$newValorVenda=str_replace(',','.',$valorVenda2);
				$updProduto='update produto set descricao="'.$descrProd.'",nome="'.$nomeProd.'",custo="'.$newCustoProd.'",valorVenda="'.$newValorVenda.'" where id='.$id.';';
				if(!mysqli_query($mysqli,$updProduto)){
					die ('
					<script>
						alert("Não foi possível atualizar o produto: '.mysqli_error($mysqli).'");
						location.href="/trabalhos/gti/bda1/";
					</script>');
				}else{
					echo '<script>alert("Atualização de produto finalizada com sucesso!");location.href="/trabalhos/gti/bda1/";</script>';
				}
			// Finaliza a conexão
				mysqli_close($mysqli);
				break;
			case 'editar':
				echo '<form id="phpForm" action="/trabalhos/gti/bda1/" method="POST">';
			//Cliente
				echo '<input type="hidden" name="idProduto" value="'.$id.'">';
				//Pega Nome do produto
				$queryNome='select nome from produto where id='.$id.';';
				$getNome=mysqli_query($mysqli,$queryNome);
				$nome=mysqli_fetch_row($getNome);
				echo '<input type="hidden" name="nomeProd" value="'.$nome[0].'">';
				//Pega ID da remessa
				$queryIdRemessa='select remessa from produto where id='.$id.';';
				$getIdRemessa=mysqli_query($mysqli,$queryIdRemessa);
				$remessa=mysqli_fetch_row($getIdRemessa);
				echo '<input type="hidden" name="idRemessa" value="'.$remessa[0].'">';
				//Pega Descrição do produto
				$queryDescr='select descricao from produto where id='.$id.';';
				$getDescr=mysqli_query($mysqli,$queryDescr);
				$descr=mysqli_fetch_row($getDescr);
				echo '<input type="hidden" name="descrProd" value="'.$descr[0].'">';
				//Pega Custo do produto
				$queryCusto='select custo from produto where id='.$id.';';
				$getCusto=mysqli_query($mysqli,$queryCusto);
				$custo=mysqli_fetch_row($getCusto);
				$valorCusto=str_replace('.',',',$custo[0]);
				echo '<input type="hidden" name="custoProd" value="R$ '.$valorCusto.'">';
				//Pega Valor de Venda do produto
				$queryValorV='select valorVenda from produto where id='.$id.';';
				$getValorV=mysqli_query($mysqli,$queryValorV);
				$valorV=mysqli_fetch_row($getValorV);
				$valorVenda=str_replace('.',',',$valorV[0]);
				echo '<input type="hidden" name="valorVenda" value="R$ '.$valorVenda.'">';
				echo '</form>';
				echo '<script src="/trabalhos/gti/bda1/js/jQuery.js"></script>';
				echo "<script>$('#phpForm').submit();</script>";
				break;
		}
	}
	function estoques($acao,$idProdutoEstq="-",$qtdProdEstq="-",$idFuncionarioEstq="-",$dataSaida="-"){
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
					die ('
					<script>
						alert("Não foi possível inserir o produto no estoque:\n'.mysqli_error($mysqli).'");
						location.href="/trabalhos/gti/bda1/";
					</script>');
				}else{
					echo '<script>alert("Produto inserido no estoque com sucesso!");location.href="/trabalhos/gti/bda1/";</script>';
				}
			// Finaliza a conexão
				mysqli_close($mysqli);
				break;
			case 'retirar':
			// Algoritmo
				$queryQtdEstoque='select qtdProd from estoque where produto='.$idProdutoEstq.';';
				$getQtdEstoque=mysqli_query($mysqli,$queryQtdEstoque);
				$qtdEstoque=mysqli_fetch_row($getQtdEstoque);
				if($qtdProdEstq>$qtdEstoque[0]){
					echo '
					<script>
						alert("Retirada não pode ser realizada porque não há essa quantidade do produto no estoque!");
						location.href="/trabalhos/gti/bda1/";
					</script>';
				}
				$valQtdEstq=$qtdEstoque[0]-$qtdProdEstq;
				$newQtdEstoque='update estoque set qtdProd='.$valQtdEstq.' where produto='.$idProdutoEstq.';';
				if(!mysqli_query($mysqli,$newQtdEstoque)){
					die ('
					<script>
						alert("Não foi possível retirar o produto do estoque:\n'.mysqli_error($mysqli).'");
						location.href="/trabalhos/gti/bda1/";
					</script>');
				}
				$insHistorico='insert into historico(produtoEstq,funcionario,qtdRetProd,dataSaida) values ("'.$idProdutoEstq.'","'.$idFuncionarioEstq.'","'.$qtdProdEstq.'","'.$dataSaida.'");';
				if(!mysqli_query($mysqli,$insHistorico)){
					die ('
					<script>
						alert("Não foi possível cadastrar o histórico:\n'.mysqli_error($mysqli).'");
						location.href="/trabalhos/gti/bda1/";
					</script>');
				}else{
					echo '<script>alert("Produto retirado do estoque com sucesso!");location.href="/trabalhos/gti/bda1/";</script>';
				}
			// Finaliza a conexão
				mysqli_close($mysqli);
				break;
		}
	}
	function enderecos($acao,$alvo="-",$id="-",$rua="-",$numero="-",$compl="-",$cep="-",$bairro="-",$cidade="-",$estado="-"){
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
				$cadEndereco='insert into endereco(rua,numero,complemento,cep,bairro,cidade,estado) values ("'.$rua.'",'.$numero.',"'.$compl.'","'.$cep.'","'.$bairro.'","'.$cidade.'","'.$estado.'");';
				if(!mysqli_query($mysqli,$cadEndereco)){
					die ('
					<script>
						alert("Não foi possível cadastrar o endereço: '.mysqli_error($mysqli).'");
						location.href="/trabalhos/gti/bda1/";
					</script>');
				}
			// Finaliza a conexão
				mysqli_close($mysqli);
				break;
			case 'atualizar':
				switch($alvo){
					case 'fornecedor':
					// Algoritmo
						$queryEndForn='select endereco from fornecedor where id='.$id.';';
						$getEndForn=mysqli_query($mysqli,$queryEndForn);
						$endForn=mysqli_fetch_row($getEndForn);
						$updEndereco='update endereco set
						rua="'.$rua.'",
						numero='.$numero.',
						complemento="'.$compl.'",
						cep="'.$cep.'",
						bairro="'.$bairro.'",
						cidade="'.$cidade.'",
						estado="'.$estado.'" where id='.$endForn[0].';';
						if(!mysqli_query($mysqli,$updEndereco)){
							die ('
							<script>
								alert("Não foi possível atualizar o endereço do fornecedor: '.mysqli_error($mysqli).'");
								location.href="/trabalhos/gti/bda1/";
							</script>');
						}
					// Finaliza a conexão
						mysqli_close($mysqli);
						break;
					case 'cliente':
					// Algoritmo
						$queryEndCli='select endereco from cliente where id='.$id.';';
						$getEndCli=mysqli_query($mysqli,$queryEndCli);
						$endCli=mysqli_fetch_row($getEndCli);
						$updEndereco='update endereco set
						rua="'.$rua.'",
						numero='.$numero.',
						complemento="'.$compl.'",
						cep="'.$cep.'",
						bairro="'.$bairro.'",
						cidade="'.$cidade.'",
						estado="'.$estado.'" where id='.$endCli[0].';';
						if(!mysqli_query($mysqli,$updEndereco)){
							die ('
							<script>
								alert("Não foi possível atualizar o enderecõ do cliente: '.mysqli_error($mysqli).'");
								location.href="/trabalhos/gti/bda1/";
							</script>');
						}
					// Finaliza a conexão
						mysqli_close($mysqli);
						break;
					case 'funcionario':
					// Algoritmo
						$queryEndFunc='select endereco from funcionario where id='.$id.';';
						$getEndFunc=mysqli_query($mysqli,$queryEndFunc);
						$endFunc=mysqli_fetch_row($getEndFunc);
						$updEndereco='update endereco set
						rua="'.$rua.'",
						numero='.$numero.',
						complemento="'.$compl.'",
						cep="'.$cep.'",
						bairro="'.$bairro.'",
						cidade="'.$cidade.'",
						estado="'.$estado.'" where id='.$endFunc[0].';';
						if(!mysqli_query($mysqli,$updEndereco)){
							die ('
							<script>
								alert("Não foi possível atualizar o endereço do funcionário: '.mysqli_error($mysqli).'");
								location.href="/trabalhos/gti/bda1/";
							</script>');
						}
					// Finaliza a conexão
						mysqli_close($mysqli);
						break;
				}
				break;
		}
	}
	function contatos($acao,$alvo="-",$id="-",$email="-",$telCel="-",$telFixo="-"){
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
		switch($alvo){
			case 'cadastrar':
			// Algoritmo
				$cadContato='insert into contato(email,telCel,telFixo) values ("'.$email.'","'.$telCel.'","'.$telFixo.'");';
				if(!mysqli_query($mysqli,$cadContato)){
					die ('
					<script>
						alert("Não foi possível cadastrar o contato: '.mysqli_error($mysqli).'");
						location.href="/trabalhos/gti/bda1/";
					</script>');
				}
			// Finaliza a conexão
				mysqli_close($mysqli);
				break;
			case 'atualizar':
				switch($alvo){
					case 'fornecedor':
					// Algoritmo
						$queryConForn='select contato from fornecedor where id='.$id.';';
						$getConForn=mysqli_query($mysqli,$queryConForn);
						$conForn=mysqli_fetch_row($getConForn);
						$updContato='update contato set email='.$email.',telCel="'.$telCel.'",telFixo="'.$telFixo.'" where id='.$conForn[0].';';
						if(!mysqli_query($mysqli,$updContato)){
							die ('
							<script>
								alert("Não foi possível atualizar o contato do fornecedor: '.mysqli_error($mysqli).'");
								location.href="/trabalhos/gti/bda1/";
							</script>');
						}
					// Finaliza a conexão
						mysqli_close($mysqli);
						break;
					case 'cliente':
					// Algoritmo
						$queryConCli='select contato from cliente where id='.$id.';';
						$getConCli=mysqli_query($mysqli,$queryConCli);
						$conCli=mysqli_fetch_row($getConCli);
						$updContato='update contato set email='.$email.',telCel="'.$telCel.'",telFixo="'.$telFixo.'" where id='.$conCli[0].';';
						if(!mysqli_query($mysqli,$updContato)){
							die ('
							<script>
								alert("Não foi possível atualizar o contato do cliente: '.mysqli_error($mysqli).'");
								location.href="/trabalhos/gti/bda1/";
							</script>');
						}
					// Finaliza a conexão
						mysqli_close($mysqli);
						break;
					case 'funcionario':
					// Algoritmo
						$queryConFunc='select contato from funcionario where id='.$id.';';
						$getConFunc=mysqli_query($mysqli,$queryConFunc);
						$conFunc=mysqli_fetch_row($getConFunc);
						$updContato='update contato set email='.$email.',telCel="'.$telCel.'",telFixo="'.$telFixo.'" where id='.$conFunc[0].';';
						if(!mysqli_query($mysqli,$updContato)){
							die ('
							<script>
								alert("Não foi possível atualizar o contato do funcionário: '.mysqli_error($mysqli).'");
								location.href="/trabalhos/gti/bda1/";
							</script>');
						}
					// Finaliza a conexão
						mysqli_close($mysqli);
						break;
				}
				break;
		}
	}
?>