<html>
    <head>
        <meta charset="utf-8" />
        <meta name="author" content="Thiago Jourdan" />
        <title>Software teste de banco de dados de estoque</title>
    </head>
    <body>
        <?php
            require_once("../funcoesBase.php");
            function __autoload($class){autoload("../",$class);}
            $estoque=new Estoque();
            $estoque->setAttrEstoque(post("idProdutoEstq"),post("idFuncionarioEstq"),post("qtdProdEstq"),post("dataSaida"));
            $estoque->retirarProduto();
        ?>
    </body>
</html>