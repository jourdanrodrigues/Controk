$(document).ready(function(){
    $(".mainForm").submit(function(){
        manageAJAX();
        return false;
    });
    $(".logOut span").click(function(){
        loadFile("class/Sessao.js"); var sessao=new Sessao();
        sessao.logOut();
    });
});
function manageAJAX(){
    var Target=upperCaseFL($("input.alvo").val());
    loadFile("class/"+Target+".js");
    eval("var obj=new "+Target+"(); obj."+$("input.acao").val()+"();");
}
function successCase(data,btnText){
    var obj=JSON.parse(data);
    $(".goBtn").html(btnText);
    swal({
        title:obj.msg,
        type:obj.type,
        html:true
    },function(){if(obj.type!=="error") resetFields();});
}
function errorCase(textStatus,errorThrown,btnText,thisFunction){
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