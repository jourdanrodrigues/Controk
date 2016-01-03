<?php
function searchFiles($folder,$file){
    // Função para inserção automática de classes
    if (is_dir($folder)){
        if (file_exists("$folder/$file")) return "$folder/$file";
        $dirs=array_diff(scandir($folder,1),array(".",".."));
        foreach ($dirs as $dir)
            if (is_dir("$folder/$dir")&&searchFiles("$folder/$dir",$file)!==false)
                return searchFiles("$folder/$dir",$file);
    }else return false;
}
function autoload($path,$class){
    // Conteúdo da função "__autoload"
    $folder=$path."class";
    $class.=".php";
    $file=searchFiles($folder,$class);
    if ($file!==false) require_once $file;
    else AJAXReturn("{'type':'error','message':'Não foi possível encontrar o arquivo \'$class\'.'}");
}
function post($var){return filter_input(INPUT_POST,$var);} // Filtro para variáveis $_POST
function server($var){return filter_input(INPUT_SERVER,$var);} // Filtro para variáveis $_SERVER
function generateField($var){
    $obj=json_decode(fixJSON($var));
    echo "<p".(isset($obj->id)?" class='campoId$obj->id'":"")."><label data-for='$obj->field'>$obj->lblContent</label><br>";
    //Início do campo
    echo isset($obj->fieldType)&&$obj->fieldType==="textarea"?"<textarea class='":
            "<input type='".(isset($obj->type)?"$obj->type'":"text'")." class='field $obj->field";
    if(isset($obj->classes)) foreach($obj->classes as $class) echo " $class";
    echo "'";
    //Atributos
    echo isset($obj->rows)?" row=$obj->rows":"";
    echo isset($obj->cols)?" cols=$obj->cols":"";
    echo isset($obj->value)?" value='$obj->value'":"";
    echo isset($obj->plcHolder)?" placeholder='$obj->plcHolder'":"";
    echo isset($obj->required)&&$obj->required===1?" required='required'":"";
    //Fechamento do campo
    echo isset($obj->fieldType)&&$obj->fieldType==="textarea"?"></textarea></p>":"></p>";
}
function generateItemMenu($var){
    $obj=json_decode(fixJSON($var));
    echo "<li class='item nav".str_replace("á","a",$obj->item)."'>$obj->item<ul>".
        (isset($obj->cadastrar)&&$obj->cadastrar==1?"<li class='cadastrar'>Cadastrar</li>":"").
        (isset($obj->buscarDados)&&$obj->buscarDados==1?"<li class='buscarDados'>Buscar Dados</li>":"").
        (isset($obj->excluir)&&$obj->excluir==1?"<li class='excluir'>Excluir</li>":"").
        (isset($obj->inserir)&&$obj->inserir==1?"<li class='inserir'>Inserir itens</li>":"").
        (isset($obj->retirar)&&$obj->retirar==1?"<li class='retirar'>Retirar itens</li>":"").
        "</ul></li>";
}
function loadFiles($var){
    // Carregamento de arquivos CSS e JS
    $obj=json_decode(fixJSON($var));
    if(isset($obj->js)) foreach($obj->js as $file) echo "<script src='js/$file.js'></script>";
    else if(isset($obj->css)) foreach($obj->css as $file) echo "<link rel='stylesheet' href='css/$file.css' />";
}
function swal($var){
    $obj=json_decode(fixJSON($var));
    echo "<script>$(document).ready(function(){swal({title:'$obj->title',type:'$obj->type'".
    (isset($obj->time)?",time:$obj->time":"")."}";
    if(isset($obj->funcScope)){
        if(!isset($obj->funcParam)) $obj->funcParam="";
        echo ",function($obj->funcParam){ $obj->funcScope}";
    }
    echo ");});</script>";
}
function sessionBegin(){
    session_start();
    if(empty($_SESSION["usuario"])||!isset($_SESSION["usuario"]))
        header("location:/trabalhos/gti/bda1/login.php");
    else{
        if($_SESSION['tempo']<(time()-180)){
            session_unset();
            swal("{'title':'Sua sessão expirou!','type':'warning','time':1000,'funcScope':'location.href=\'/trabalhos/gti/bda1/login.php\';'}");
        }else{
            $_SESSION["tempo"]=time();
            $usuario=$_SESSION["usuario"];
        }
    }
}
function AJAXReturn($type,$msg){
    echo fixJSON("{'type':'$type','msg':'".str_replace('"',"'",$msg)."'}");
}
function fixJSON($var){return str_replace("'","\"",$var);}