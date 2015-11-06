<?php
require_once("mainFunctions.php");
function __autoload($class){autoload("./",$class);}
$acao=post("acaoSessao");
$sessao=new Sessao();
if($acao=="logout") $sessao->logout();
else{
    $sessao->setAttrSessao(post("usuario"),post("senha"));
    switch($acao){
        case "login": $sessao->login(); break;
        case "cadastrar": $sessao->cadastrarUsuario(); break;
    }
}