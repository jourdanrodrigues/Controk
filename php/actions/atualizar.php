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
            if($alvo!=="produto"){
                $$alvo->setAttrContato("{
                    'email':'".post("email")."',
                    'telCel':'".post("telCel")."',
                    'telFixo':'".post("telFixo")."'}");
                $$alvo->setAttrEndereco("{
                    'rua':'".post("rua")."',
                    'numero':'".post("numero")."',
                    'complemento':'".post("complemento")."',
                    'cep':'".post("cep")."',
                    'bairro':'".post("bairro")."',
                    'cidade':'".post("cidade")."',
                    'estado':'".post("estado")."'}");
                switch($alvo){
                    case "fornecedor": $$alvo->setAttrFornecedor("{
                    'idFornecedor':'".post("idFornecedor")."',
                    'nomeFantasia':'".post("nomeFantasia")."',
                    'cnpj':'".post("cnpj")."'}"); break;
                    case "cliente": $$alvo->setAttrCliente("{
                    'idCliente':'".post("idCliente")."',
                    'nome':'".post("nome")."',
                    'cpf':'".post("cpf")."',
                    'obs':'".post("obs")."'}"); break;
                    case "funcionario": $$alvo->setAttrFuncionario("{
                    'idFuncionario':'".post("idFuncionario")."',
                    'nome':'".post("nomeFuncionario")."',
                    'cpf':'".post("cpfFuncionario")."',
                    'cargo':'".post("cargo")."',
                    'obs':'".post("obsFuncionario")."'}"); break;
                }
            }else $$alvo->setAttrProduto("{
                'idProduto':'".post("idProduto")."',
                'nomeProd':'".post("nomeProd")."',
                'idRemessa':'".post("idRemessa")."',
                'descrProd':'".post("descrProd")."',
                'custoProd':'".post("custoProd")."',
                'valorVenda':'".post("valorVenda")."'}");
            $atualizar="atualizar".$Alvo;
            $$alvo->$atualizar();
        ?>
    </body>
</html>