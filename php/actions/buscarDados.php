<html>
    <head><meta charset="utf-8" /></head>
    <body>
        <?php
            require_once('../funcoesBase.php');
            function __autoload($class){
                $pasta='../class';
                $ext='.php';
                $file=procurarArquivos($pasta,$class.$ext);
                if ($file!==false) require_once $file;
                else echo "<span class='retorno' data-type='error'>Não foi possível encontrar o arquivo $class$ext.</span>";
            }
            $alvo=$_POST["alvo"];
            $Alvo=ucfirst($alvo);
            $$alvo=new $Alvo();
            $setAttr="setAttr".$Alvo;
            $$alvo->$setAttr($_POST['id'.$Alvo]);
            $buscarDados="buscarDados".$Alvo;
            $$alvo->$buscarDados();
        ?>
    </body>
</html>