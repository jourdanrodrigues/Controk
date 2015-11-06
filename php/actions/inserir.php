<?php
require_once("../mainFunctions.php");
function __autoload($class){autoload("../",$class);}
$estoque=new Estoque();
$estoque->setAttrEstoque("{
    'idProduto':'".post("idProdutoEstq")."',
    'qtdProd':'".post("qtdProdEstq")."'}");
$estoque->inserirProduto();