$(document).ready(function(){
    $(".mainForm").submit(function(){
        manageAJAX();
        return false;
    });
    $(".logOut span").click(function(){
        loadFile("js/AJAX/Sessao.js");
        logOut();
    });
});
function manageAJAX(){
    var acao=$("input.acao").val(), alvo=$("input.alvo").val();
    switch(alvo){
        case 'cliente':
            loadFile("js/AJAX/Cliente.js");
            switch(acao){
                case 'cadastrar': cadastrarCliente(); break;
                case 'buscarDados': buscarDadosCliente(); break;
                case 'atualizar': atualizarCliente(); break;
                case 'excluir': excluirCliente();
            }
            break;
        case 'funcionario':
            loadFile("js/AJAX/Funcionario.js");
            switch(acao){
                case 'cadastrar': cadastrarFuncionario(); break;
                case 'buscarDados': buscarDadosFuncionario(); break;
                case 'atualizar': atualizarFuncionario(); break;
                case 'excluir': excluirFuncionario();
            }
            break;
        case 'fornecedor':
            loadFile("js/AJAX/Fornecedor.js");
            switch(acao){
                case 'cadastrar': cadastrarFornecedor(); break;
                case 'buscarDados': buscarDadosFornecedor(); break;
                case 'atualizar': atualizarFornecedor(); break;
                case 'excluir': excluirFornecedor();
            }
            break;
        case 'produto':
            loadFile("js/AJAX/Produto.js");
            switch(acao){
                case 'cadastrar': cadastrarProduto(); break;
                case 'buscarDados': buscarDadosProduto(); break;
                case 'atualizar': atualizarProduto();
            }
            break;
        case 'remessa':
            loadFile("js/AJAX/Remessa.js");
            cadastrarRemessa();
            break;
        case 'estoque':
            loadFile("js/AJAX/Estoque.js");
            switch(acao){
                case 'inserir': inserirEstoque(); break;
                case 'retirar': retirarEstoque();
            }
    }
}
function successCase(dados, btnText){
    var obj=JSON.parse(dados);
    $(".goBtn").html(btnText);
    swal({
        title:obj.msg,
        type:obj.type,
        html:true
    },function(){if(obj.type!=="error") limparCampos();});
}
function errorCase(textStatus, errorThrown, btnText, thisFunction){
    $(".goBtn").html(btnText);
    swal({
        title: "Ocorreu um erro!",
        text: "<p>Descrição do erro: \""+textStatus+" "+errorThrown+"\".</p><p>Gostaria de tentar novamente?</p>",
        type: "error",
        html: true,
        showCancelButton: true,
        confirmButtonText: "Sim, tente!",
        cancelButtonText: "Não, tudo bem.",
        closeOnConfirm: false
    },function(isConfirm){
        if(isConfirm) thisFunction.call();
        else limparCampos();
    });
}
function limparCampos(){
    $(".resetBtn").click();
    $('.direita').css('display','none').find('input,textarea').removeAttr('required');
}
function loadFile(url){
    if(/css$/.test(url)&&$("link[href='"+url+"']").length===0) $("head").append("<link rel='stylesheet' href='"+url+"'>");
    else if(/js$/.test(url)&&$("script[src='"+url+"']").length===0) $("head").append("<script src='"+url+"'></script>");
}