<!DOCTYPE html>
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
            if($alvo==="fornecedor"||$alvo==="funcionario"||$alvo==="cliente"){
                $$alvo->setAttrContato(post("email"),post("telCel"),post("telFixo"));
                $$alvo->setAttrEndereco(post("rua"),post("numero"),post("complemento"),post("cep"),post("bairro"),post("cidade"),post("estado"));
                if($alvo==="fornecedor") $$alvo->setAttrFornecedor(post("idFornecedor"),post("nomeFantasia"),post("cnpj"));
                elseif($alvo==="cliente") $$alvo->setAttrCliente(post("idCliente"),post("nomeCliente"),post("cpfCliente"),post("obsCliente"));
                elseif($alvo==="funcionario") $$alvo->setAttrFuncionario(post("idFuncionario"),post("nomeFuncionario"),post("cpfFuncionario"),post("cargo"),post("obsFuncionario"));
            }elseif($alvo==="produto") $$alvo->setAttrProduto(post("idProduto"),post("nomeProd"),post("idRemessa"),post("descrProd"),post("custoProd"),post("valorVenda"));
            $atualizar="atualizar".$Alvo;
            $$alvo->$atualizar();
        ?>
    </body>
</html>