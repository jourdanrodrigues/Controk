<?php
require_once("../mainFunctions.php");
function __autoload($class){autoload("../",$class);}
$estoque=new Estoque();
$estoque->setAttr("{'idProduto':'".post("idProduto")."','qtdProd':'".post("qtdProd")."'}");
$estoque->inserirProduto();