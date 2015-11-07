<?php
require_once("../mainFunctions.php");
function __autoload($class){autoload("../",$class);}
$alvo=post("alvo");
$Alvo=ucfirst($alvo);
$$alvo=new $Alvo();
$id="id':".post("id");
$nome="nome':'".post("nome");
$cpf="cpf':'".post("cpf");
$obs="obs':'".post("obs");
if($alvo!=="produto"){
    $$alvo->setAttrContato("{'email':'".post("email")."','telCel':'".post("telCel")."','telFixo':'".post("telFixo")."'}");
    $$alvo->setAttrEndereco("{
        'rua':'".post("rua")."',
        'numero':'".post("numero")."',
        'complemento':'".post("complemento")."',
        'cep':'".post("cep")."',
        'bairro':'".post("bairro")."',
        'cidade':'".post("cidade")."',
        'estado':'".post("estado")."'}");
    switch($alvo){
        case "fornecedor": $attr="{'$id,'$nome','cnpj':'".post("cnpj")."'}"; break;
        case "cliente": $attr="{'$id,'$nome','$cpf','$obs'}"; break;
        case "funcionario": $attr="{'$id,'$nome','$cpf','cargo':'".post("cargo")."','$obs'}"; break;
    }
}else $attr="{'$id,'$nome','idRemessa':'".post("idRemessa")."','descricao':'".post("descricao")."','custo':'".post("custo")."','valorVenda':'".post("valorVenda")."'}";
$$alvo->setAttr($attr);
$$alvo->atualizar();