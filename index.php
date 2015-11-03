<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta name="author" content="Thiago Jourdan" />
        <title>Software teste de banco de dados de estoque</title>
        <?php
            require_once("php/mainFunctions.php");
            loadFiles("{'css':['bootstrap','sweetalert','mainStyle']}");
            loadFiles("{'js':['jQuery','frameworks/bootstrap','plugins/sweetalert','plugins/inputMasks','js','nav','AJAX/AJAXManager']}");
            session_start();
            if(empty($_SESSION["usuario"])||!isset($_SESSION["usuario"])) header("location:/trabalhos/gti/bda1/login.php");
            else{
                if($_SESSION['tempo']<(time()-1000)){
                    session_unset();
                    swal("{'title':'Sua sessão expirou!','type':'warning','time':1000,'funcScope':'location.href=\'/trabalhos/gti/bda1/login.php\';'}");
                }else{
                    $_SESSION["tempo"]=time();
                    $usuario=$_SESSION["usuario"];
                }
            }
        ?>
    </head><!-- Head -->
    <body>
        <div class="topo">
            <span class="logOut"><?php if(isset($_SESSION["usuario"])) echo "$usuario, fazer <span>logout</span>."; ?></span><br>
            <span class="backToMain">Voltar à página inicial.</span>
            <h1>SEFUNC BD</h1>
            <h3>Software para Exemplo de Funcionamento do Banco de Dados</h3>
        </div>
        <div class="esquerda">
            <ul>
                <?php
                    generateItemMenu("{'item':'Funcionário','cadastrar':1,'buscarDados':1,'excluir':1}");
                    generateItemMenu("{'item':'Cliente','cadastrar':1,'buscarDados':1,'excluir':1}");
                    generateItemMenu("{'item':'Fornecedor','cadastrar':1,'buscarDados':1,'excluir':1}");
                    generateItemMenu("{'item':'Remessa','cadastrar':1}");
                    generateItemMenu("{'item':'Produto','cadastrar':1,'buscarDados':1}");
                    generateItemMenu("{'item':'Estoque','inserir':1,'retirar':1}");
                ?>
            </ul>
        </div><!-- Esquerda -->
        <div class="direita">
            <form class="mainForm" autocomplete="off">
                <div class="fornecedor"><!-- Fornecedor -->
                    <?php
                        generateField("{'id':'Fornecedor','field':'idFornecedor','lblContent':'ID do Fornecedor'}");
                        generateField("{'field':'nomeFantasia','lblContent':'Nome Fantasia'}");
                        generateField("{'field':'cnpj','lblContent':'CNPJ'}");
                    ?>
                </div>
                <div class="cliente"><!-- Cliente -->
                    <?php
                        generateField("{'id':'Cliente','field':'idCliente','lblContent':'ID do Cliente'}");
                        generateField("{'field':'nomeCliente','lblContent':'Nome'}");
                        generateField("{'field':'cpfCliente','lblContent':'CPF'}");
                        generateField("{'field':'obsCliente','lblContent':'Observação','value':'S. Obs.'}");
                    ?>
                </div>
                <div class="funcionario"><!-- Funcionário -->
                    <?php
                        generateField("{'id':'Funcionario','field':'idFuncionario','lblContent':'ID do Funcionário'}");
                        generateField("{'field':'nomeFuncionario','lblContent':'Nome'}");
                        generateField("{'field':'cpfFuncionario','lblContent':'CPF'}");
                        generateField("{'field':'cargo','lblContent':'Cargo'}");
                        generateField("{'field':'obsFuncionario','lblContent':'Observação','value':'S. Obs.'}");
                    ?>
                </div>
                <div class="contato"><!-- Contatos -->
                    <h3>Contatos</h3>
                    <?php
                        generateField("{'field':'email','lblContent':'E-mail'}");
                        generateField("{'field':'telFixo','lblContent':'Telefone Fixo'}");
                        generateField("{'field':'telCel','lblContent':'Telefone Celular'}");
                    ?>
                </div>
                <div class="endereco"><!-- Endereço -->
                    <h3>Endereço</h3>
                    <?php
                        generateField("{'field':'rua','lblContent':'Rua'}");
                        generateField("{'field':'numero','lblContent':'Número'}");
                        generateField("{'field':'complemento','lblContent':'Complemento'}");
                        generateField("{'field':'cep','lblContent':'CEP'}");
                        generateField("{'field':'bairro','lblContent':'Bairro'}");
                        generateField("{'field':'cidade','lblContent':'Cidade'}");
                        generateField("{'field':'estado','lblContent':'Estado (UF)'}");
                    ?>
                </div>
                <div class="remessa"><!-- Remessa -->
                    <?php
                        generateField("{'field':'idProdutoRem','lblContent':'ID do produto'}");
                        generateField("{'field':'qtdProdRem','lblContent':'Quantidade do produto (un.)'}");
                        generateField("{'field':'idFornecedorRem','lblContent':'ID do fornecedor'}");
                        generateField("{'field':'dataPedido','lblContent':'Data do Pedido'}");
                        generateField("{'field':'dataPagamento','lblContent':'Data do Pagamento'}");
                        generateField("{'field':'dataEntrega','lblContent':'Data da Entrega'}");
                    ?>
                </div>
                <div class="produto"><!-- Produto -->
                    <?php
                        generateField("{'id':'Produto','field':'idProduto','lblContent':'ID do Produto'}");
                        generateField("{'field':'idRemessa','lblContent':'ID da remessa'}");
                        generateField("{'field':'nomeProd','lblContent':'Nome do produto'}");
                        generateField("{'fieldType':'textarea','field':'descrProd','lblContent':'Descrição do produto'}");
                        generateField("{'field':'custoProd','lblContent':'Custo do produto'}");
                        generateField("{'field':'valorVenda','lblContent':'Valor de venda do produto'}");
                    ?>
                </div>
                <div class="estoque"><!-- Estoque -->
                    <?php
                        generateField("{'id':'FuncEstq','field':'idFuncionarioEstq','lblContent':'ID do funcionário'}");
                        generateField("{'field':'idProdutoEstq','lblContent':'ID do produto'}");
                        generateField("{'field':'qtdProdEstq','lblContent':'Quantidade do produto (un.)'}");
                        generateField("{'id':'DataSaidaEstq','field':'dataSaida','lblContent':'Data Saída'}");
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