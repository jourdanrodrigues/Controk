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
    /* Parâmetros para geração de campos
     * id - classe de identificação da tag <p> (opcional);
     * field - classe de identificação do campo;
     * fieldType - tipo do campo (default: "input");
     * type - tipo de dado do campo (default: "text");
     * value - valor inicial de campo input (opcional);
     * lblContent - Conteúdo da label de identificação do campo;
     * plcHolder - Conteúdo do placeholder (opcional);
     * required - Setar campo como requerido (opcional);
     * rows - Linhas para type "textarea" (opcional);
     * cols - Colunas para type "textarea" (opcional);
     */
    $obj=json_decode(fixJSON($var));
    echo "<p"; echo isset($obj->id)?" class='campoId$obj->id'":"";
    echo "><label data-for='$obj->field'>$obj->lblContent</label><br>";
    //Início do campo
    if(isset($obj->fieldType)&&$obj->fieldType==="textarea") echo "<textarea class='";
    else{
        echo "<input type='";
        echo isset($obj->type)?"$obj->type'":"text'";
        echo " class='field ";
    }
    echo "$obj->field";
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
    /*
     * item => Título do item e define a classe
     * label => Título do item com caractere espacial
     * cadastrar, buscarDados, excluir, inserir e retirar => Opções
     */
    $obj=json_decode(fixJSON($var));
    echo "<li class='item nav".str_replace("á","a",$obj->item)."'>$obj->item<ul>";
    if (isset($obj->cadastrar)&&$obj->cadastrar==1) echo "<li class='cadastrar'>Cadastrar</li>";
    if (isset($obj->buscarDados)&&$obj->buscarDados==1) echo "<li class='buscarDados'>Buscar Dados</li>";
    if (isset($obj->excluir)&&$obj->excluir==1) echo "<li class='excluir'>Excluir</li>";
    if (isset($obj->inserir)&&$obj->inserir==1) echo "<li class='inserir'>Inserir itens</li>";
    if (isset($obj->retirar)&&$obj->retirar==1) echo "<li class='retirar'>Retirar itens</li>";
    echo "</ul></li>";
}
function generateReturnInputs($var){
    for($i=0;$i<count($var);$i++) echo "<input type='text' class='".$var[$i][0]."' value='".$var[$i][1]."'>";
}
function loadFiles($var){
    // Carregamento de arquivos CSS e JS
    $obj=json_decode(fixJSON($var));
    if(isset($obj->js)) foreach($obj->js as $file) echo "<script src='js/$file.js'></script>";
    else if(isset($obj->css)) foreach($obj->css as $file) echo "<link rel='stylesheet' href='css/$file.css' />";
}
function swal($var){
    $obj=json_decode(fixJSON($var));
    echo "<script>$(document).ready(function(){swal({title:'$obj->title',type:'$obj->type'";
    if(isset($obj->time)) echo ",time:$obj->time";
    echo "}";
    if(isset($obj->funcScope)){
        if(!isset($obj->funcParam)) $obj->funcParam="";
        echo ",function($obj->funcParam){ $obj->funcScope}";
    }
    echo ");});</script>";
}
function AJAXReturn($var){
    $obj=json_decode(fixJSON($var));
    echo "<span class='retorno' data-type='$obj->type'>$obj->msg</span>";
}
function fixJSON($var){
    return str_replace("'","\"",$var);
}