<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta name="author" content="Thiago Jourdan" />
        <title>Software teste de banco de dados de estoque</title>
        <?php
            require_once("php/mainFunctions.php");
            loadFiles("css",array("bootstrap","sweetalert","mainStyle"));
            loadFiles("js",array("jQuery","frameworks/bootstrap","plugins/sweetalert","plugins/inputMasks","js","nav","AJAX/AJAXManager"));
            session_start();
            if(empty($_SESSION['usuario'])||!isset($_SESSION['usuario'])) header("location:/trabalhos/gti/bda1/login.php");
            else{
                if($_SESSION['tempo']<(time()-1000)){
                    session_unset();
                    echo
                    '<script>
                        $(document).ready(function(){
                            swal({
                                title:"Sua sessão expirou!",
                                type:"warning",
                                time:1000
                            },function(){location.href="/trabalhos/gti/bda1/login.php";});
                        });
                    </script>';
                }else{
                    $_SESSION['tempo']=time();
                    $usuario=$_SESSION['usuario'];
                }
            }
        ?>
    </head><!-- Head -->
    <body>
        <div class="topo">
            <span class="logOut"><?php if(isset($_SESSION['usuario'])) echo "$usuario, fazer <span>logout</span>."; ?></span><br>
            <span class="backToMain">Voltar à página inicial.</span>
            <h1>SEFUNC BD</h1>
            <h3>Software para Exemplo de Funcionamento do Banco de Dados</h3>
        </div>
        <div class="esquerda">
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
                    <ul><li class="cadastrar">Cadastrar</li></ul>
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
            <form class="mainForm" autocomplete="off">
                <div class="fornecedor"><!-- Fornecedor -->
                    <?php
                        generateField(array("id"=>"Fornecedor","field"=>"idFornecedor","lblContent"=>"ID do Fornecedor"));
                        generateField(array("field"=>"nomeFantasia","lblContent"=>"Nome Fantasia"));
                        generateField(array("field"=>"cnpj","lblContent"=>"CNPJ"));
                    ?>
                </div>
                <div class="cliente"><!-- Cliente -->
                    <?php
                        generateField(array("id"=>"Cliente","field"=>"idCliente","lblContent"=>"ID do Cliente"));
                        generateField(array("field"=>"nomeCliente","lblContent"=>"Nome"));
                        generateField(array("field"=>"cpfCliente","lblContent"=>"CPF"));
                        generateField(array("field"=>"obsCliente","lblContent"=>"Observação","inputValue"=>"S. Obs."));
                    ?>
                </div>
                <div class="funcionario"><!-- Funcionário -->
                    <?php
                        generateField(array("id"=>"Funcionario","field"=>"idFuncionario","lblContent"=>"ID do Funcionário"));
                        generateField(array("field"=>"nomeFuncionario","lblContent"=>"Nome"));
                        generateField(array("field"=>"cpfFuncionario","lblContent"=>"CPF"));
                        generateField(array("field"=>"cargo","lblContent"=>"Cargo"));
                        generateField(array("field"=>"obsFuncionario","lblContent"=>"Observação","inputValue"=>"S. Obs."));
                    ?>
                </div>
                <div class="contato"><!-- Contatos -->
                    <h3>Contatos</h3>
                    <?php
                        generateField(array("field"=>"email","lblContent"=>"E-mail"));
                        generateField(array("field"=>"telFixo","lblContent"=>"Telefone Fixo"));
                        generateField(array("field"=>"telCel","lblContent"=>"Telefone Celular"));
                    ?>
                </div>
                <div class="endereco"><!-- Endereço -->
                    <h3>Endereço</h3>
                    <?php
                        generateField(array("field"=>"rua","lblContent"=>"Rua"));
                        generateField(array("field"=>"numero","lblContent"=>"Número"));
                        generateField(array("field"=>"complemento","lblContent"=>"Complemento"));
                        generateField(array("field"=>"cep","lblContent"=>"CEP"));
                        generateField(array("field"=>"bairro","lblContent"=>"Bairro"));
                        generateField(array("field"=>"cidade","lblContent"=>"Cidade"));
                        generateField(array("field"=>"estado","lblContent"=>"Estado (UF)"));
                    ?>
                </div>
                <div class="remessa"><!-- Remessa -->
                    <?php
                        generateField(array("field"=>"idProdutoRem","lblContent"=>"ID do produto"));
                        generateField(array("field"=>"qtdProdRem","lblContent"=>"Quantidade do produto (un.)"));
                        generateField(array("field"=>"idFornecedorRem","lblContent"=>"ID do fornecedor"));
                        generateField(array("field"=>"dataPedido","lblContent"=>"Data do Pedido"));
                        generateField(array("field"=>"dataPagamento","lblContent"=>"Data do Pagamento"));
                        generateField(array("field"=>"dataEntrega","lblContent"=>"Data da Entrega"));
                    ?>
                </div>
                <div class="produto"><!-- Produto -->
                    <?php
                        generateField(array("id"=>"Produto","field"=>"idProduto","lblContent"=>"ID do Produto"));
                        generateField(array("field"=>"idRemessa","lblContent"=>"ID da remessa"));
                        generateField(array("field"=>"nomeProd","lblContent"=>"Nome do produto"));
                        generateField(array("fieldType"=>"textarea","field"=>"descrProd","lblContent"=>"Descrição do produto"));
                        generateField(array("field"=>"custoProd","lblContent"=>"Custo do produto"));
                        generateField(array("field"=>"valorVenda","lblContent"=>"Valor de venda do produto"));
                    ?>
                </div>
                <div class="estoque"><!-- Estoque -->
                    <?php
                        generateField(array("id"=>"FuncEstq","field"=>"idFuncionarioEstq","lblContent"=>"ID do funcionário"));
                        generateField(array("field"=>"idProdutoEstq","lblContent"=>"ID do produto"));
                        generateField(array("field"=>"qtdProdEstq","lblContent"=>"Quantidade do produto (un.)"));
                        generateField(array("id"=>"DataSaidaEstq","field"=>"dataSaida","lblContent"=>"Data Saída"));
                    ?>
                </div>
                <input type="hidden" class="acao">
                <input type="hidden" class="alvo">
                <button class="goBtn"></button>
                <button type="reset" class="resetBtn">Limpar campos</button>
            </form>
        </div><!-- Direita -->
    </body><!-- Body -->
</html>