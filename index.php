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
		<script src="js/nav.js"></script>
		<script src="js/AJAX/AJAX.js"></script>
		<script src="js/bPopup.js"></script>
		<?php
			session_start();
			if(empty($_SESSION['usuario'])||!isset($_SESSION['usuario'])){
				header("location:/trabalhos/gti/bda1/login.php");
			}else{
				if($_SESSION['tempo']<(time()-3000)){
					session_unset();
					echo '<script>alert("Sua sessão expirou!");location.href="/trabalhos/gti/bda1/login.php";</script>';
				}else{
					$usuario=$_SESSION['usuario'];
					require_once('php/edicao.php');
				}
			}
		?>
	</head><!-- Head -->
	<body>
		<div class="mensagem">
			<div class="x">X</div>
			<span class="titulo"></span>
			<p></p>
			<div class="options">
				<button class="cancelar">Cancelar</button>
				<button class="ok">Ok</button>
				<button class="tentarNovamente">Tentar novamente</button>
			</div>
		</div>
		<div class="topo">
			<form class="logOut" action="php/sessionManager.php" method="POST">
				<input type="hidden" id="acaoSessao" name="acaoSessao" value="logout">
				<?php echo $usuario; ?>, fazer <span onclick="$('.logOut').submit();">logout</span>.
			</form>
			<h1>SEFUNC BD</h1>
			<h3>Software para Exemplo de Funcionamento do Banco de Dados</h3>
		</div>
		<div class="esquerda" align="left">
			<ul>
				<li class="item navFuncionario">Funcionário
					<ul>
						<li class="cadastrar">Cadastrar</li>
						<li class="buscarDados">Buscar Dados</li>
						<li class="excluir">Excluir</li>
					</ul>
				</li>
				<li class="item navCliente">Cliente
					<ul>
						<li class="cadastrar">Cadastrar</li>
						<li class="buscarDados">Buscar Dados</li>
						<li class="excluir">Excluir</li>
					</ul>
				</li>
				<li class="item navFornecedor">Fornecedor
					<ul>
						<li class="cadastrar">Cadastrar</li>
						<li class="buscarDados">Buscar Dados</li>
						<li class="excluir">Excluir</li>
					</ul>
				</li>
				<li class="item navRemessa">Remessa
					<ul>
						<li class="cadastrar">Cadastrar</li>
					</ul>
				</li>
				<li class="item navProduto">Produto
					<ul>
						<li class="cadastrar">Cadastrar</li>
						<li class="buscarDados">Buscar Dados</li>
					</ul>
				</li>
				<li class="item navEstoque">Estoque
					<ul>
						<li class="inserir">Inserir itens</li>
						<li class="retirar">Retirar itens</li>
					</ul>
				</li>
			</ul>
		</div><!-- Esquerda -->
		<div class="direita">
			<form id="mainForm" method="POST" autocomplete="off">
				<div class="fornecedor"><!-- Fornecedor -->
					<h3></h3>
					<p class="campoIdFornecedor">
						<label for="idFornecedor">ID do Fornecedor</label><br>
						<input id="idFornecedor" class="field" type="text">
					</p><p>
						<label for="nomeFantasia">Nome Fantasia</label><br>
						<input id="nomeFantasia" class="field" type="text">
					</p><p>
						<label for="cnpj">CNPJ</label><br>
						<input id="cnpj" class="field" type="text">
					</p>
				</div>
				<div class="cliente"><!-- Cliente -->
					<h3></h3>
					<p class="campoIdCliente">
						<label for="idCliente">ID do Cliente</label><br>
						<input id="idCliente" name="idCliente" class="field" type="text">
					</p><p>
						<label for="nomeCliente">Nome</label><br>
						<input id="nomeCliente" class="field" type="text">
					</p><p>
						<label for="cpfCliente">CPF</label><br>
						<input id="cpfCliente" class="field" type="text">
					</p><p>
						<label for="obsCliente">Observação</label><br>
						<input id="obsCliente" class="field" type="text" value="S. Obs.">
					</p>
				</div>
				<div class="funcionario"><!-- Funcionário -->
					<h3></h3>
					<p class="campoIdFuncionario">
						<label for="idFuncionario">ID do Funcionário</label><br>
						<input id="idFuncionario" class="field" type="text">
					</p><p>
						<label for="nomeFuncionario">Nome</label><br>
						<input id="nomeFuncionario" class="field" type="text">
					</p><p>
						<label for="cpfFuncionario">CPF</label><br>
						<input id="cpfFuncionario" class="field" type="text">
					</p><p>
						<label for="cargo">Cargo</label><br>
						<input id="cargo" class="field" type="text">
					</p><p>
						<label for="obsFuncionario">Observação</label><br>
						<input id="obsFuncionario" class="field" type="text" value="S. Obs.">
					</p>
				</div>
				<div class="contato"><!-- Contatos -->
					<h3>Contatos</h3>
					<p>
						<label for="email">E-mail</label><br>
						<input id="email" class="field" type="email">
					</p><p>
						<label for="telFixo">Telefone Fixo</label><br>
						<input id="telFixo" class="field" type="text">
					</p><p>
						<label for="telCel">Telefone Celular</label><br>
						<input id="telCel" class="field" type="text">
					</p>
				</div>
				<div class="endereco"><!-- Endereço -->
					<h3>Endereço</h3>
					<p>
						<label for="rua">Rua</label><br>
						<input id="rua" class="field" type="text">
					</p><p>
						<label for="numero">Número</label><br>
						<input id="numero" class="field" type="text">
					</p><p>
						<label for="complemento">Complemento</label><br>
						<input id="complemento" class="field" type="text" value="S. Comp.">
					</p><p>
						<label for="cep">CEP</label><br>
						<input id="cep" class="field" type="text">
					</p><p>
						<label for="bairro">Bairro</label><br>
						<input id="bairro" class="field" type="text">
					</p><p>
						<label for="cidade">Cidade</label><br>
						<input id="cidade" class="field" type="text">
					</p><p>
						<label for="estado">Estado (UF)</label><br>
						<input id="estado" class="field" type="text">
					</p>
				</div>
				<div class="remessa"><!-- Remessa -->
					<h3></h3>
					<p>
						<label for="idProdutoRem">ID do produto</label><br>
						<input id="idProdutoRem" class="field" type="text">
					</p><p>
						<label for="qtdProdRem">Quantidade do produto (un.)</label><br>
						<input id="qtdProdRem" class="field" type="text">
					</p><p>
						<label for="idFornecedorRem">ID do fornecedor</label><br>
						<input id="idFornecedorRem" class="field" type="text">
					</p><p>
						<label for="dataPedido">Data do Pedido</label><br>
						<input id="dataPedido" class="field" type="date">
					</p><p>
						<label for="dataPagamento">Data do Pagamento</label><br>
						<input id="dataPagamento" class="field" type="date">
					</p><p>
						<label for="dataEntrega">Data da Entrega</label><br>
						<input id="dataEntrega" class="field" type="date">
					</p>
				</div>
				<div class="produto"><!-- Produto -->
					<h3></h3>
					<p class="campoIdProduto">
						<label for="idProduto">ID do produto</label><br>
						<input id="idProduto" class="field" type="text">
					</p><p>
						<label for="idRemessa">ID da remessa</label><br>
						<input id="idRemessa" class="field" type="text">
					</p><p>
						<label for="nomeProd">Nome do produto</label><br>
						<input id="nomeProd" class="field" type="text">
					</p><p>
						<label for="descrProd">Descrição do produto</label><br>
						<textarea id="descrProd"></textarea>
					</p><p>
						<label for="custoProd">Custo do produto</label><br>
						<input id="custoProd" class="field" type="text">
					</p><p>
						<label for="valorVenda">Valor de venda do produto</label><br>
						<input id="valorVenda" class="field" type="text">
					</p>
				</div>
				<div class="estoque"><!-- Estoque -->
					<h3></h3>
					<p class="campoIdFuncEstq">
						<label for="idFuncionarioEstq">ID do funcionário</label><br>
						<input id="idFuncionarioEstq" class="field" type="text">
					</p><p>
						<label for="idProdutoEstq">ID do produto</label><br>
						<input id="idProdutoEstq" class="field" type="text">
					</p><p>
						<label for="qtdProdEstq">Quantidade do produto (un.)</label><br>
						<input id="qtdProdEstq" class="field" type="text">
					</p><p class="campoDataSaidaEstq">
						<label for="dataSaida">Data Saída</label><br>
						<input id="dataSaida" class="field" type="date">
					</p>
				</div>
				<input type="hidden" name="acao">
				<input type="hidden" name="alvo">
				<button type="submit"></button>
			</form>
		</div><!-- Direita -->
	</body><!-- Body -->
</html>