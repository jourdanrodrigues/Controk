<?php
require_once("../mainFunctions.php");
function __autoload($class){autoload("../",$class);}
$alvo=post("alvo");
$Alvo=ucfirst($alvo);
$$alvo=new $Alvo();
$setAttr="setAttr".$Alvo;
$$alvo->$setAttr("{'id$Alvo':".post("id".$Alvo)."}");
$buscarDados="buscarDados".$Alvo;
$$alvo->$buscarDados();