$(document).ready(function(){
    $(".mainForm").submit(function(){
        manageAJAX();
        return false;
    });
    $(".logOut span").click(function(){
        loadFile("js/class/Sessao.js");
        logOut();
    });
});
function manageAJAX(){
    var action=$("input.acao").val(),target=$("input.alvo").val();
    loadFile("class/"+upperCaseFL(target)+".js");
    switch(target){
        case "cliente":
            var cliente=new Cliente();
            switch(action){
                case 'cadastrar': cliente.cadastrar(); break;
                case 'buscarDados': cliente.buscarDados(); break;
                case 'atualizar': cliente.atualizar(); break;
                case 'excluir': cliente.excluir();
            }
            break;
        case "funcionario":
            var funcionario=new Funcionario();
            switch(action){
                case 'cadastrar': funcionario.cadastrar(); break;
                case 'buscarDados': funcionario.buscarDados(); break;
                case 'atualizar': funcionario.atualizar(); break;
                case 'excluir': funcionario.excluir();
            }
            break;
        case 'fornecedor':
            var fornecedor=new Fornecedor();
            switch(action){
                case 'cadastrar': fornecedor.cadastrar(); break;
                case 'buscarDados': fornecedor.buscarDados(); break;
                case 'atualizar': fornecedor.atualizar(); break;
                case 'excluir': fornecedor.excluir();
            }
            break;
        case 'produto':
            var produto=new Produto();
            switch(action){
                case 'cadastrar': produto.cadastrar(); break;
                case 'buscarDados': produto.buscarDados(); break;
                case 'atualizar': produto.atualizar();
            }
            break;
        case 'remessa':
            var remessa=new Remessa();
            remessa.cadastrar();
            break;
        case 'estoque':
            var estoque=new Estoque();
            switch(action){
                case 'inserir': estoque.inserir(); break;
                case 'retirar': estoque.retirar();
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
    },function(){if(obj.type!=="error") resetFields();});
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
        else resetFields();
    });
}
function resetFields(){
    $(".resetBtn").click();
    $('.direita').css('display','none');
}
function loadFile(url){
    if(/css$/.test(url)&&$("link[href='css/"+url+"']").length===0) $("head").append("<link rel='stylesheet' href='css/"+url+"'>");
    else if(/js$/.test(url)&&$("script[src='js/"+url+"']").length===0) $("head").append("<script src='js/"+url+"'></script>");
}