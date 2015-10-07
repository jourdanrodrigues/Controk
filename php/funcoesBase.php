<?php
function procurarArquivos($pasta,$arquivo,$ds="/"){
    if (is_dir($pasta)){
        if (file_exists($pasta.$ds.$arquivo)) return $pasta.$ds.$arquivo;
        $dirs=array_diff(scandir($pasta, 1), array(".",".."));
        foreach ($dirs as $dir) {
            if (!is_dir($pasta.$ds.$dir)) continue;
            else{
                $f=procurarArquivos($pasta.$ds.$dir, $arquivo, $ds);
                if ($f!==false) return $f;
            }
        }
    }else return false;
}
function autoload($path,$class){
    $folder=$path."class";
    $ext=".php";
    $file=procurarArquivos($folder,$class.$ext);
    if ($file!==false) require_once $file;
    else echo "<span class='retorno' data-type='error'>Não foi possível encontrar o arquivo $class$ext.</span>";
}
function post($var){return filter_input(INPUT_POST,$var);}
function server($var){return filter_input(INPUT_SERVER,$var);}