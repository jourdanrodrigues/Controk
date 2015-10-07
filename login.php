<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="css/sweetalert.css" />
        <title>Login para SEFUNC BD</title>
        <script src="js/jQuery.js"></script>
        <script src="js/AJAX/AJAXManager.js"></script>
        <script src="js/sweetalert.js"></script>
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
        <link rel="stylesheet" href="css/mainStyle.css" />
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
        <?php
            session_start();
            if(!empty($_SESSION['usuario'])||isset($_SESSION['usuario'])) header("location:/trabalhos/gti/bda1/");
        ?>
    </head>
    <body>
        <span class="backToMain">Voltar à página inicial.</span>
        <form class="logIn" method="POST" autocomplete="off">
            <p class="title">Login para SEFUNC BD</p>
            <p>
                <label for="usuario">Usuário</label><br>
                <input type="text" class="field usuario" required>
            </p><p>
                <label for="senha">Senha</label><br>
                <input type="password" class="field senha" required>
            </p>
            <input type="hidden" class="acaoSessao" name="acaoSessao" value="login">
            <input type="button" class="mudaAcao" name="mudaAcao" onclick="mudarAcao();" value="Cadastre-se">
            <button class="goBtn">Acessar</button>
        </form>
    </body>
</html>