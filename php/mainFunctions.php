<?php
function searchFiles($folder,$file,$ds="/"){
    // Função para inserção automática de classes
    if (is_dir($folder)){
        if (file_exists($folder.$ds.$file)) return $folder.$ds.$file;
        $dirs=array_diff(scandir($folder, 1), array(".",".."));
        foreach ($dirs as $dir)
            if (is_dir($folder.$ds.$dir)&&searchFiles($folder.$ds.$dir, $file, $ds)!==false)
                return searchFiles($folder.$ds.$dir, $file, $ds);
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
     * id => classe de identificação da tag <p> (opcional);
     * field => classe de idetificação do campo;
     * fieldType => tipo do campo (default: "input");
     * inputType => tipo de dado do campo (default: "text");
     * inputValue => valor inicial de campo input (opcional);
     * lblContent => Conteúdo da label de identificação do campo;
     */
    echo "<p"; if(isset($var['id'])) echo " class='campoId".$var['id']."'";
    echo "><label data-for='".$var['field']."'>".$var['lblContent']."</label><br>";
    if(isset($var['fieldType'])&&$var['fieldType']==="textarea") echo "<textarea class='".$var['field']."'></textarea></p>";
    else{
        echo "<input class='field ".$var['field'];
        if(isset($var['inputType'])) echo "' type='".$var['inputType'];
        else echo "' type='text";
        if(isset($var['inputValue'])) echo "' value='".$var['inputValue'];
        if(isset($var['required'])&&$var['required']===1) echo "' required='required";
        echo "'></p>";
    }
}
function loadFiles($type,$files){
    // Carregamento de arquivos CSS e JS
    if($type==="js") for($i=0;$i<count($files);$i++) echo "<script src='js/".$files[$i].".js'></script>";
    else if($type==="css") for($i=0;$i<count($files);$i++) echo "<link rel='stylesheet' href='css/".$files[$i].".css' />";
}