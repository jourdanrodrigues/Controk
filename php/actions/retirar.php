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
            $estoque=new Estoque();
            $estoque->setAttrEstoque("{
                'idProduto':'".post("idProdutoEstq")."',
                'idFuncionario':'".post("idFuncionarioEstq")."',
                'qtdProd':'".post("qtdProdEstq")."',
                'dataSaida':'".post("dataSaida")."'}");
            $estoque->retirarProduto();
        ?>
    </body>
</html>