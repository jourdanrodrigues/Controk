<?php
function searchFiles($folder,$file){
    // Função para inserção automática de classes
    if (is_dir($folder)){
        if (file_exists($folder."/".$file)) return $folder."/".$file;
        $dirs=array_diff(scandir($folder,1),array(".",".."));
        foreach ($dirs as $dir)
            if (is_dir($folder."/".$dir)&&searchFiles($folder."/".$dir,$file)!==false)
                return searchFiles($folder."/".$dir,$file);
    }else return false;
}
function autoload($path,$class){
    // Conteúdo da função "__autoload"
    $folder=$path."class";
    $class.=".php";
    $file=searchFiles($folder,$class);
    if ($file!==false) require_once $file;
    else echo "<span class='retorno' data-type='error'>Não foi possível encontrar o arquivo \"$class\".</span>";
}
function post($var){return filter_input(INPUT_POST,$var);} // Filtro para variáveis $_POST
function server($var){return filter_input(INPUT_SERVER,$var);} // Filtro para variáveis $_SERVER
function generateField($var){
    /* Parâmetros para geração de campos
     * id - classe de identificação da tag <p> (opcional);
     * field - classe de idetificação do campo;
     * fieldType - tipo do campo (default: "input");
     * inputType - tipo de dado do campo (default: "text");
     * inputValue - valor inicial de campo input (opcional);
     * lblContent - Conteúdo da label de identificação do campo;
     */
    $obj=json_decode($var);
    echo "<p"; if(isset($obj->id)) echo " class='campoId$obj->id'";
    echo "><label data-for='$obj->field'>$obj->lblContent</label><br>";
    if(isset($obj->fieldType)&&$obj->fieldType==="textarea") echo "<textarea class='$obj->field'></textarea></p>";
    else{
        echo "<input class='field $obj->field";
        if(isset($obj->inputType)) echo "' type='$obj->inputType";
        else echo "' type='text";
        if(isset($obj->inputValue)) echo "' value='$obj->inputValue";
        if(isset($obj->required)&&$obj->required===1) echo "' required='required";
        echo "'></p>";
    }
}
function generateItemMenu($var){
    /*
     * item => Título do item e define a classe
     * label => Título do item com caractere espacial
     * cadastrar, buscarDados, excluir, inserir e retirar => Opções
     */
    $obj=json_decode($var);
    echo "<li class='item nav".str_replace("á","a",$obj->item)."'>$obj->item<ul>";
    if (isset($obj->cadastrar)&&$obj->cadastrar==1) echo "<li class='cadastrar'>Cadastrar</li>";
    if (isset($obj->buscarDados)&&$obj->buscarDados==1) echo "<li class='buscarDados'>Buscar Dados</li>";
    if (isset($obj->excluir)&&$obj->excluir==1) echo "<li class='excluir'>Excluir</li>";
    if (isset($obj->inserir)&&$obj->inserir==1) echo "<li class='inserir'>Inserir itens</li>";
    if (isset($obj->retirar)&&$obj->retirar==1) echo "<li class='retirar'>Retirar itens</li>";
    echo "</ul></li>";
}
function loadFiles($type,$files){
    // Carregamento de arquivos CSS e JS
    if($type==="js") for($i=0;$i<count($files);$i++) echo "<script src='js/".$files[$i].".js'></script>";
    else if($type==="css") for($i=0;$i<count($files);$i++) echo "<link rel='stylesheet' href='css/".$files[$i].".css' />";
}
function swal($var){
    $obj=json_decode($var);
    echo "<script>$(document).ready(function(){swal({title:'$obj->title',type:'$obj->type'";
    if(isset($obj->time)) echo ",time:$obj->time";
    echo "}";
    if(isset($obj->funcScope)){
        if(!isset($obj->funcParam)) $obj->funcParam="";
        echo ",function($obj->funcParam){ $obj->funcScope}";
    }
    echo ");});</script>";
}