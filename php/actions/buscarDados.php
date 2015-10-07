<html>
    <head>
        <meta charset="utf-8" />
        <meta name="author" content="Thiago Jourdan" />
        <title>Software teste de banco de dados de estoque</title>
    </head>
    <body>
        <?php
            require_once('../funcoesBase.php');
            function __autoload($class){
                autoload("../",$class);
            }
            $alvo=post("alvo");
            $Alvo=ucfirst($alvo);
            $$alvo=new $Alvo();
            $setAttr="setAttr".$Alvo;
            $$alvo->$setAttr(post("id".$Alvo));
            $buscarDados="buscarDados".$Alvo;
            $$alvo->$buscarDados();
        ?>
    </body>
</html>