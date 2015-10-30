<html>
    <head>
        <meta charset="utf-8" />
        <meta name="author" content="Thiago Jourdan" />
        <title>Software teste de banco de dados de estoque</title>
    </head>
    <body>
        <?php
            require_once("../mainFunctions.php");
            function __autoload($class){autoload("../",$class);}
            $alvo=post("alvo");
            $Alvo=ucfirst($alvo);
            $$alvo=new $Alvo();
            $setAttr="setAttr".$Alvo;
            $id="id".$Alvo;
            $function="excluir".$Alvo;
            $$alvo->$setAttr(post($id));
            $$alvo->$function();
        ?>
    </body>
</html>