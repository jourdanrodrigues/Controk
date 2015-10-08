<html>
    <head>
        <meta charset="utf-8" />
        <meta name="author" content="Thiago Jourdan" />
        <title>Software teste de banco de dados de estoque</title>
    </head>
    <body>
        <?php
            require_once("../mainFunctions.php");
            function __autoload($class){autoload("../",$class);}
            $alvo=post("alvo");
            $Alvo=ucfirst($alvo);
            $$alvo=new $Alvo();
            if($alvo=="fornecedor") $fornecedor->setAttrFornecedor("",post("nomeFantasia"),post("cnpj"));
            elseif($alvo=="cliente") $cliente->setAttrCliente("",post("nome"),post("cpf"),post("obs"));
            elseif($alvo=="funcionario") $funcionario->setAttrFuncionario("",post("nome"),post("cpf"),post("cargo"),post("obs"));
            elseif($alvo=="remessa") $remessa->setAttrRemessa(post("idProdutoRem"),post("qtdProdRem"),post("idFornecedorRem"),post("dataPedido"),post("dataPagamento"),post("dataEntrega"));
            elseif($alvo=="produto") $produto->setAttrProduto("",post("nomeProd"),post("idRemessa"),post("descrProd"),post("custoProd"),post("valorVenda"));
            if($alvo!="remessa"&&$alvo!="produto"){
                $$alvo->setAttrContato(post("email"),post("telCel"),post("telFixo"));
                $$alvo->setAttrEndereco(post("rua"),post("numero"),post("complemento"),post("cep"),post("bairro"),post("cidade"),post("estado"));
            }
            $function='cadastrar'.$Alvo;
            $$alvo->$function();
        ?>
    </body>
</html>