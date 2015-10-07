<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="author" content="Thiago Jourdan" />
        <title>Software teste de banco de dados de estoque</title>
    </head>
    <body>
        <?php
            require_once('funcoesBase.php');
            function __autoload($class){autoload("./",$class);}
            $acao=post("acaoSessao");
            $sessao=new Sessao();
            if($acao=='logout') $sessao->logout();
            else{
                $sessao->setAttrSessao(post("usuario"),post("senha"));
                switch($acao){
                    case 'login': $sessao->login(); break;
                    case 'cadastrar': $sessao->cadastrarUsuario(); break;
                }
            }
        ?>
    </body>
</html>