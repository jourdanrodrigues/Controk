<?php
require_once("mainFunctions.php");
function __autoload($class){autoload("",$class);}
$target=post("target");
$action=post("action");
$Target=ucfirst($target);
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
            case "fornecedor": $attr.="'cnpj':'".post("cnpj")."',$nome"; break;
            case "funcionario": $attr.="'cargo':'".post("cargo")."',";
            case "cliente": $attr.="'obs':'".post("obs")."','cpf':'".post("cpf")."',$nome"; break;
            case "remessa": $attr.="$idProduto,$qtdProd,'dataEntrega':'".post("dataEntrega")."','dataPedido':'".post("dataPedido")."','dataPagamento':'".post("dataPagamento")."','idFornecedor':".post("idFornecedor"); break;
            case "produto": $attr.="$nome,'valorVenda':".post("valorVenda").",'descricao':'".post("descricao")."','custo':".post("custo").",'idRemessa':".post("idRemessa"); break;
        }
        break;
    case "retirar": $attr.="'idFuncionario':".post("idFuncionario").",'dataSaida':'".post("dataSaida")."',";
    case "inserir": $attr.="$idProduto,$qtdProd"; break;
}
$$target=new $Target("$attr}");
if(($target!="remessa"&&$target!="produto"&&$target!="estoque")&&($action=="cadastrar"||$action=="atualizar")){
    $$target->setAttrContato("{'email':'".post("email")."','telCel':'".post("telCel")."','telFixo':'".post("telFixo")."'}");
    $$target->setAttrEndereco("{'rua':'".post("rua")."','numero':".post("numero").",'complemento':'".post("complemento")."','cep':'".post("cep")."','bairro':'".post("bairro")."','cidade':'".post("cidade")."','estado':'".post("estado")."'}");
}
$$target->$action();