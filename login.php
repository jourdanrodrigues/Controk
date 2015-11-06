<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Login para SEFUNC BD</title>
        <?php
            session_start();
            if(!empty($_SESSION['usuario'])||isset($_SESSION['usuario'])) header("location:/trabalhos/gti/bda1/");
            require_once("php/mainFunctions.php");
            loadFiles("{'css':['sweetalert','mainStyle']}");
            loadFiles("{'js':['jQuery','plugins/sweetalert','AJAX/AJAXManager']}");
        ?>
        <script>
            $(document).ready(function (){
                $('body').css('opacity', '0').fadeTo(600, 1,'swing');
                $(".logIn").submit(function(){
                    loadFile("js/AJAX/Sessao.js");
                    logIn();
                    return false;
                });
                $(".backToMain").click(function(){location.href="/";});
                $(".usuario").focus();
            });
            function mudarAcao(){
                switch($('.mudaAcao').val()){
                    case "Cadastre-se":
                        $('.acaoSessao').val("cadastrar");
                        $('.mudaAcao').val("Fazer LogIn");
                        $('button').html("Cadastrar");
                        break;
                    case "Fazer LogIn":
                        $('.acaoSessao').val("login");
                        $('.mudaAcao').val("Cadastre-se");
                        $('button').html("Fazer LogIn");
                        break;
                }
            }
        </script>
        <style>
            body{
                padding:2% 0;
                overflow:hidden;
                background:#CCC;
                text-align:center}
            form{
                font-size:25pt;
                color:#CCC;}
            .goBtn{
                color:#666;
                background:#CCC;
                width:50%}
            .mudaAcao{
                cursor:pointer;
                position:absolute;
                margin-top:110px; padding:5px;
                border:none;
                color:#666;
                background:#CCC;
                border-radius:5px;
                transition:.3s}
            .mudaAcao:hover,.goBtn:hover{
                color:#CCC;
                background:#666;
                box-shadow:0 0 15px #CCC;}
            .title{
                background:#CCC;
                color:#666;
                padding:2px 0}
        </style>
    </head>
    <body>
        <span class="backToMain">Voltar à página inicial.</span>
        <form class="logIn" method="POST" autocomplete="off">
            <p class="title">Login para SEFUNC BD</p>
            <?php
                generateField("{'field':'usuario','lblContent':'Usuário','required':1}");
                generateField("{'field':'senha','lblContent':'Senha','type':'password','required':1}");
            ?>
            <input type="hidden" class="acaoSessao" name="acaoSessao" value="login">
            <input type="button" class="mudaAcao" name="mudaAcao" onclick="mudarAcao();" value="Cadastre-se">
            <button class="goBtn">Acessar</button>
        </form>
    </body>
</html>