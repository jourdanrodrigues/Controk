<html>
    <head>
        <meta charset="utf-8" />
        <meta name="author" content="Thiago Jourdan" />
        <title>Software teste de banco de dados de estoque</title>
    </head>
    <body>
        <?php
            require_once("../funcoesBase.php");
            function __autoload($class){
                $pasta="../class";
                $ext=".php";
                $file=procurarArquivos($pasta,$class.$ext);
                if ($file!==false) require_once $file;
                else echo "<span class='retorno' data-type='error'>Não foi possível encontrar o arquivo \"$class$ext\".</span>";
            }
            $alvo=$_POST["alvo"];
            $Alvo=ucfirst($alvo);
            $$alvo=new $Alvo();
            if($alvo=="fornecedor") $fornecedor->setAttrFornecedor("",$_POST["nomeFantasia"],$_POST["cnpj"]);
            elseif($alvo=="cliente") $cliente->setAttrCliente("",$_POST["nome"],$_POST["cpf"],$_POST["obs"]);
            elseif($alvo=="funcionario") $funcionario->setAttrFuncionario("",$_POST["nome"],$_POST["cpf"],$_POST["cargo"],$_POST["obs"]);
            elseif($alvo=="remessa") $remessa->setAttrRemessa($_POST["idProdutoRem"],$_POST["qtdProdRem"],$_POST["idFornecedorRem"],$_POST["dataPedido"],$_POST["dataPagamento"],$_POST["dataEntrega"]);
            elseif($alvo=="produto") $produto->setAttrProduto("",$_POST["nomeProd"],$_POST["idRemessa"],$_POST["descrProd"],$_POST["custoProd"],$_POST["valorVenda"]);
            if($alvo!="remessa"&&$alvo!="produto"){
                $$alvo->setAttrContato($_POST["email"],$_POST["telCel"],$_POST["telFixo"]);
                $$alvo->setAttrEndereco($_POST["rua"],$_POST["numero"],$_POST["complemento"],$_POST["cep"],$_POST["bairro"],$_POST["cidade"],$_POST["estado"]);
            }
            $function='cadastrar'.$Alvo;
            $$alvo->$function();
        ?>
    </body>
</html>