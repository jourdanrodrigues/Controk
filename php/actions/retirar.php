<?php
require_once("../mainFunctions.php");
function __autoload($class){autoload("../",$class);}
$estoque=new Estoque();
$estoque->setAttr("{'idProduto':'".post("idProduto")."','idFuncionario':'".post("idFuncionario")."','qtdProd':'".post("qtdProd")."','dataSaida':'".post("dataSaida")."'}");
$estoque->retirarProduto();