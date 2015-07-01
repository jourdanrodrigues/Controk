<html>
	<head>
		<meta charset="utf-8" />
		<meta name="author" content="Thiago Jourdan" />
		<link rel="stylesheet" href="css.css" />
		<title>Software teste de banco de dados de estoque</title>
		<script src="js/jQuery.js"></script>
		<script src="js/maskedInput.js"></script>
		<script src="js/priceFormat.js"></script>
		<script src="js/js.js"></script>
		<?php
			session_start();
			if(empty($_SESSION['usuario'])||!isset($_SESSION['usuario'])){
				header("location:/trabalhos/gti/bda1/login.php");
			}else{
				$usuario=$_SESSION['usuario'];
				require_once('php/edicao.php');
			}
		?>
	</head><!-- Head -->
	<body align="center">
		<div id="topo">
			<form id="logOut" action="php/logout.php" method="POST">
				<input type="hidden" name="logout" value="logout">
				<?php if(!empty($_SESSION['usuario'])||isset($_SESSION['usuario'])){echo $usuario;} ?>, fazer <a onclick="$('#logOut').submit();">logout</a>.
			</form>
			<h1>SEFUNC BD</h1>
			<h3>Software para Exemplo de Funcionamento do Banco de Dados</h3>
		</div>
		<div id="esquerda" align="left">
			<ul>
				<li id="navFuncionario" class="item" onclick="opcoes('navFuncionario')">Funcionário
					<ul>
						<li onclick="dbManage('funcionario','Cadastro')">Cadastrar</li>
						<li onclick="dbManage('funcionario','Edição')">Editar</li>
						<li onclick="dbManage('funcionario','Exclusão')">Excluir</li>
					</ul>
				</li>
				<li id="navCliente" class="item" onclick="opcoes('navCliente')">Cliente
					<ul>
						<li onclick="dbManage('cliente','Cadastro')">Cadastrar</li>
						<li onclick="dbManage('cliente','Edição')">Editar</li>
						<li onclick="dbManage('cliente','Exclusão')">Excluir</li>
					</ul>
				</li>
				<li id="navFornecedor" class="item" onclick="opcoes('navFornecedor')">Fornecedor
					<ul>
						<li onclick="dbManage('fornecedor','Cadastro')">Cadastrar</li>
						<li onclick="dbManage('fornecedor','Edição')">Editar</li>
						<li onclick="dbManage('fornecedor','Exclusão')">Excluir</li>
					</ul>
				</li>
				<li id="navRemessa" class="item" onclick="opcoes('navRemessa')">Remessa
					<ul>
						<li onclick="dbManage('remessa','Cadastro')">Cadastrar</li>
					</ul>
				</li>
				<li id="navProduto" class="item" onclick="opcoes('navProduto')">Produto
					<ul>
						<li onclick="dbManage('produto','Cadastro')">Cadastrar</li>
						<li onclick="dbManage('produto','Edição')">Editar</li>
					</ul>
				</li>
				<li id="navEstoque" class="item" onclick="opcoes('navEstoque')">Estoque
					<ul>
						<li onclick="dbManage('estoque','Inserir')">Inserir itens</li>
						<li onclick="dbManage('estoque','Retirar')">Retirar itens</li>
					</ul>
				</li>
			</ul>
		</div><!-- Esquerda -->
		<div id="direita">
			<form id="mainForm" action="php/manager.php" method="POST" autocomplete="off">
				<div id="fornecedor"><!-- Fornecedor -->
					<h3></h3>
					<p id="campoIdFornecedor">
						<label for="idFornecedor">ID do Fornecedor</label><br>
						<input id="idFornecedor" name="idFornecedor" class="field" type="text">
					</p><p>
						<label for="nomeFantasia">Nome Fantasia</label><br>
						<input id="nomeFantasia" name="nomeFantasia" class="field" type="text">
					</p><p>
						<label for="cnpj">CNPJ</label><br>
						<input id="cnpj" name="cnpj" class="field" type="text">
					</p>
				</div>
				<div id="cliente"><!-- Cliente -->
					<h3></h3>
					<p id="campoIdCliente">
						<label for="idCliente">ID do Cliente</label><br>
						<input id="idCliente" name="idCliente" class="field" type="text">
					</p><p>
						<label for="nomeCliente">Nome</label><br>
						<input id="nomeCliente" name="nomeCliente" class="field" type="text">
					</p><p>
						<label for="cpfCliente">CPF</label><br>
						<input id="cpfCliente" name="cpfCliente" class="field" type="text">
					</p><p>
						<label for="obsCliente">Observação</label><br>
						<input id="obsCliente" name="obsCliente" class="field" type="text" value="S. Obs.">
					</p>
				</div>
				<div id="funcionario"><!-- Funcionário -->
					<h3></h3>
					<p id="campoIdFuncionario">
						<label for="idFuncionario">ID do Funcionário</label><br>
						<input id="idFuncionario" name="idFuncionario" class="field" type="text">
					</p><p>
						<label for="nomeFunc">Nome</label><br>
						<input id="nomeFunc" name="nomeFunc" class="field" type="text">
					</p><p>
						<label for="cpfFuncionario">CPF</label><br>
						<input id="cpfFuncionario" name="cpfFuncionario" class="field" type="text">
					</p><p>
						<label for="cargo">Cargo</label><br>
						<input id="cargo" name="cargo" class="field" type="text">
					</p><p>
						<label for="obsFuncionario">Observação</label><br>
						<input id="obsFuncionario" name="obsFuncionario" class="field" type="text" value="S. Obs.">
					</p>
				</div>
				<div id="contato"><!-- Contatos -->
					<h3>Contatos</h3>
					<p>
						<label for="email">E-mail</label><br>
						<input id="email" name="email" class="field" type="email">
					</p><p>
						<label for="telFixo">Telefone Fixo</label><br>
						<input id="telFixo" name="telFixo" class="field" type="text">
					</p><p>
						<label for="telCel">Telefone Celular</label><br>
						<input id="telCel" name="telCel" class="field" type="text">
					</p>
				</div>
				<div id="remessa"><!-- Remessa -->
					<h3></h3>
					<p>
						<label for="idProdutoRem">ID do produto</label><br>
						<input id="idProdutoRem" name="idProdutoRem" class="field" type="text">
					</p><p>
						<label for="qtdProdRem">Quantidade do produto (un.)</label><br>
						<input id="qtdProdRem" name="qtdProdRem" class="field" type="text">
					</p><p>
						<label for="idFornecedorRem">ID do fornecedor</label><br>
						<input id="idFornecedorRem" name="idFornecedorRem" class="field" type="text">
					</p><p>
						<label for="dataPedido">Data do Pedido</label><br>
						<input id="dataPedido" name="dataPedido" class="field" type="date">
					</p><p>
						<label for="dataPagamento">Data do Pagamento</label><br>
						<input id="dataPagamento" name="dataPagamento" class="field" type="date">
					</p><p>
						<label for="dataEntrega">Data da Entrega</label><br>
						<input id="dataEntrega" name="dataEntrega" class="field" type="date">
					</p>
				</div>
				<div id="produto"><!-- Produto -->
					<h3></h3>
					<p id="campoIdProduto">
						<label for="idProduto">ID do produto</label><br>
						<input id="idProduto" name="idProduto" class="field" type="text">
					</p><p>
						<label for="idRemessa">ID da remessa</label><br>
						<input id="idRemessa" name="idRemessa" class="field" type="text">
					</p><p>
						<label for="nomeProd">Nome do produto</label><br>
						<input id="nomeProd" name="nomeProd" class="field" type="text">
					</p><p>
						<label for="descrProd">Descrição do produto</label><br>
						<textarea id="descrProd" name="descrProd"></textarea>
					</p><p>
						<label for="custoProd">Custo do produto</label><br>
						<input id="custoProd" name="custoProd" class="field" type="text">
					</p><p>
						<label for="valorVenda">Valor de venda do produto</label><br>
						<input id="valorVenda" name="valorVenda" class="field" type="text">
					</p>
				</div>
				<div id="endereco"><!-- Endereço -->
					<h3>Endereço</h3>
					<p>
						<label for="rua">Rua</label><br>
						<input id="rua" name="rua" class="field" type="text">
					</p><p>
						<label for="numero">Número</label><br>
						<input id="numero" name="numero" class="field" type="text">
					</p><p>
						<label for="compl">Complemento</label><br>
						<input id="compl" name="compl" class="field" type="text" value="S. Comp.">
					</p><p>
						<label for="cep">CEP</label><br>
						<input id="cep" name="cep" class="field" type="text">
					</p><p>
						<label for="bairro">Bairro</label><br>
						<input id="bairro" name="bairro" class="field" type="text">
					</p><p>
						<label for="cidade">Cidade</label><br>
						<input id="cidade" name="cidade" class="field" type="text">
					</p><p>
						<label for="estado">Estado (UF)</label><br>
						<input id="estado" name="estado" class="field" type="text">
					</p>
				</div>
				<div id="estoque"><!-- Estoque -->
					<h3></h3>
					<p id="campoIdFuncEstq">
						<label for="idFuncionarioEstq">ID do funcionário</label><br>
						<input id="idFuncionarioEstq" name="idFuncionarioEstq" class="field" type="text">
					</p><p>
						<label for="idProdutoEstq">ID do produto</label><br>
						<input id="idProdutoEstq" name="idProdutoEstq" class="field" type="text">
					</p><p>
						<label for="qtdProdEstq">Quantidade do produto (un.)</label><br>
						<input id="qtdProdEstq" name="qtdProdEstq" class="field" type="text">
					</p><p id="campoDataSaidaEstq">
						<label for="dataSaida">Data Saída</label><br>
						<input id="dataSaida" name="dataSaida" class="field" type="date">
					</p>
				</div>
				<input type="hidden" name="acao" value="">
				<input type="hidden" name="alvo" value="">
				<button type="submit"></button>
			</form>
		</div><!-- Direita -->
		<div id="creditos">
			<ul><li><h3>Equipe Sensacional de BDA</h3>
				<li class="integrante">Jean Rodrigues</li>
				<li class="integrante">Jéssica Freires</li>
				<li class="integrante">Joseph Rodrigues</li>
				<li class="integrante">Rômulo Cordeiro</li>
				<li class="integrante">Thiago Jourdan</li>
			</li></ul>
		</div>
	</body><!-- Body -->
</html>