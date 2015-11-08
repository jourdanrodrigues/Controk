<?php
require_once("mainFunctions.php");
function __autoload($class){autoload("",$class);}
$target=post("target");
$action=post("action");
$Target=ucfirst($target);
$$target=new $Target();
$id="'id':".post("id");
$nome="'nome':'".post("nome")."'";
$idProduto="'idProduto':".post("idProduto");
$qtdProd="'qtdProd':".post("qtdProd");
$attr="{";
switch($action){
    case "buscarDados":
    case "excluir": $attr.=$id; break;
    case "atualizar": $attr.="$id,";
    case "cadastrar": 
        switch($target){
            case "fornecedor": $attr.="$nome,'cnpj':'".post("cnpj")."'"; break;
            case "funcionario": $attr.="'cargo':'".post("cargo")."',";
            case "cliente": $attr.="$nome,'cpf':'".post("cpf")."','obs':'".post("obs")."'"; break;
            case "remessa": $attr.="$idProduto,$qtdProd,'idFornecedor':".post("idFornecedor").",'dataPedido':'".post("dataPedido")."','dataPagamento':'".post("dataPagamento")."','dataEntrega':'".post("dataEntrega")."'"; break;
            case "produto": $attr="$nome,'idRemessa':".post("idRemessa").",'descricao':'".post("descricao")."','custo':'".post("custo")."','valorVenda':'".post("valorVenda")."'"; break;
        }
        break;
    case "retirar": $attr.="'idFuncionario':".post("idFuncionario").",'dataSaida':'".post("dataSaida")."',";
    case "inserir": $attr.="$idProduto,$qtdProd"; break;
}
if(($target!="remessa"&&$target!="produto"&&$target!="estoque")&&($action=="cadastrar"||$action=="atualizar")){
    $$target->setAttrContato("{'email':'".post("email")."','telCel':".post("telCel").",'telFixo':".post("telFixo")."}");
    $$target->setAttrEndereco("{'rua':'".post("rua")."','numero':".post("numero").",'complemento':'".post("complemento")."','cep':'".post("cep")."','bairro':'".post("bairro")."','cidade':'".post("cidade")."','estado':'".post("estado")."'}");
}
$$target->setAttr($attr."}");
$$target->$action();