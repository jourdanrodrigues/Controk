<?php
require_once("../mainFunctions.php");
function __autoload($class){autoload("../",$class);}
$alvo=post("alvo");
$Alvo=ucfirst($alvo);
$$alvo=new $Alvo();
$nome="nome':'".post("nome");
$cpf="cpf':'".post("cpf");
$obs="obs':'".post("obs");
switch($alvo){
    case "fornecedor": $attr="{'$nome','cnpj':'".post("cnpj")."'}"; break;
    case "cliente": $attr="{'$nome','$cpf','$obs'}"; break;
    case "funcionario": $attr="{'$nome','$cpf','$cargo','$obs'}"; break;
    case "remessa": $attr="{
    'idProduto':".post("idProduto").",
    'qtdProd':".post("qtdProd").",
    'idFornecedor':".post("idFornecedor").",
    'dataPedido':'".post("dataPedido")."',
    'dataPagamento':'".post("dataPagamento")."',
    'dataEntrega':'".post("dataEntrega")."'}"; break;
    case "produto": $attr="{'$nome','idRemessa':".post("idRemessa").",'descricao':'".post("descricao")."','custo':'".post("custo")."','valorVenda':'".post("valorVenda")."'}"; break;
}
if($alvo!="remessa"&&$alvo!="produto"){
    $$alvo->setAttrContato("{'email':'".post("email")."','telCel':'".post("telCel")."','telFixo':'".post("telFixo")."'}");
    $$alvo->setAttrEndereco("{
        'rua':'".post("rua")."',
        'numero':".post("numero").",
        'complemento':'".post("complemento")."',
        'cep':'".post("cep")."',
        'bairro':'".post("bairro")."',
        'cidade':'".post("cidade")."',
        'estado':'".post("estado")."'}");
}
$$alvo->setAttr($attr);
$$alvo->cadastrar();