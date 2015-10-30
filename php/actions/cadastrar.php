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
            switch($alvo){
                case "fornecedor": $$alvo->setAttrFornecedor("{
                'nomeFantasia':'".post("nomeFantasia")."',
                'cnpj':'".post("cnpj")."'}"); break;
                case "cliente": $$alvo->setAttrCliente("{
                'nome':'".post("nome")."',
                'cpf':'".post("cpf")."',
                'obs':'".post("obs")."'}"); break;
                case "funcionario": $$alvo->setAttrFuncionario("{
                'nome':'".post("nome")."',
                'cpf':'".post("cpf")."',
                'cargo':'".post("cargo")."',
                'obs':'".post("obs")."'}"); break;
                case "remessa": $$alvo->setAttrRemessa("{
                'idProdutoRem':'".post("idProdutoRem")."',
                'qtdProdRem':'".post("qtdProdRem")."',
                'idFornecedorRem':'".post("idFornecedorRem")."',
                'dataPedido':'".post("dataPedido")."',
                'dataPagamento':'".post("dataPagamento")."',
                'dataEntrega':'".post("dataEntrega")."'}"); break;
                case "produto": $$alvo->setAttrProduto("{
                'nomeProd':'".post("nomeProd")."',
                'idRemessa':'".post("idRemessa")."',
                'descrProd':'".post("descrProd")."',
                'custoProd':'".post("custoProd")."',
                'valorVenda':'".post("valorVenda")."'}"); break;
            }
            if($alvo!="remessa"&&$alvo!="produto"){
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
            }
            $function='cadastrar'.$Alvo;
            $$alvo->$function();
        ?>
    </body>
</html>