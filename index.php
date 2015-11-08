<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta name="author" content="Thiago Jourdan" />
        <title>Software teste de banco de dados de estoque</title>
        <?php
            require_once("php/mainFunctions.php");
            loadFiles("{'css':['bootstrap','sweetalert','mainStyle']}");
            loadFiles("{'js':['jQuery','frameworks/bootstrap','plugins/sweetalert','plugins/inputMasks','js','manager','content']}");
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
                <input type="hidden" class="acao">
                <input type="hidden" class="alvo">
                <button class="goBtn"></button>
                <button type="reset" class="resetBtn">Limpar campos</button>
            </form>
        </div><!-- Direita -->
    </body><!-- Body -->
</html>