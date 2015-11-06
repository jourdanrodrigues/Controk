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