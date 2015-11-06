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
    'nome':'".post("nome")."',
    'idRemessa':'".post("idRemessa")."',
    'descricao':'".post("descricao")."',
    'custoProd':'".post("custoProd")."',
    'valorVenda':'".post("valorVenda")."'}");
$atualizar="atualizar".$Alvo;
$$alvo->$atualizar();