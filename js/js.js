$(document).ready(function(){
    $(".navbar-nav li").click(function(){
        if(parseInt($("html").css("width").replace("px",""))+17<768) $("button.navbar-toggle").click();
        $(".navbar-nav li.active").removeClass("active");
        $(this).addClass("active");
        instance("listar"); // Função LISTAR
    });
    $("body").fadeTo(600,1,"swing");
});
function showFading(content){
    $('.row .container').fadeTo(600,0,function(){
        $(this).html(content).fadeTo(600,1,function(){elementProp();});
    });
}
function instance(action){
    var Target=$(".navbar-nav li.active a").html().replace("á","a");
    loadFile("class/"+Target+".js");
    eval("var obj=new "+Target+"(); obj."+action+"();");
}
function elementProp(){ // Propriedades dos elementos depois de carregados
    $(".action").click(function(){
        instance($(this).attr("data-content").toLowerCase().split(" ")[0]);
    });
    if(window.outerWidth>768) $("[data-toggle='popover']").popover();
    $(".maisInfo").click(function(){ // Botão para exibir mais informações sobre o item
        var Target=$(".navbar-nav li.active a").html();
        if(Target=="Funcionário") Target=Target.replace("á","a");
        eval("var obj=new "+Target+"();");
        obj.mostrarDados(this);
    });
    $("input[type='checkbox']").click(function(){ // Muda estado do botão: "Cadastrar" <-> "Excluir"
        var checks=$("input:checked").length, classes=(checks!=0?["plus","minus"]:["minus","plus"]),
            color=checks!=0?"#A00":"#080";
        $(".action").css("background",color).attr("data-content",(color!="#A00"?"Cadastrar":"Excluir selecionado"+(checks>1?"s":"")));
        $(".action .panel-body span").removeClass("glyphicon-"+classes[0]).addClass("glyphicon-"+classes[1]);
    });
}
function listItems(filter,items){
    if($(".action").length==0){
        $("body").append("<div class='panel panel-default action' style='opacity:0' data-toggle='popover' data-trigger='hover' data-placement='top' data-content='Cadastrar'>"+
        "<div class='panel-body'><span class='glyphicon glyphicon-plus'></span></div></div>");
        $(".action").fadeTo(600,1);
    }else{
        $(".action").css("background","green").attr("data-content","Cadastrar");
        $(".action .panel-body span").removeClass("glyphicon-minus").addClass("glyphicon-plus");
    }
    var itemLabel=$(".navbar-nav li.active a").html().toLowerCase(),
    content="<div class='col-lg-2 col-lg-offset-1'><div class='panel panel-primary filter'>"+
                "<div class='panel-heading'>Filtro</div>"+
                "<div class='panel-body'>"+filter+"</div>"+
            "</div></div>"+
            "<div class='col-lg-6'><div class='panel panel-primary list'>"+
                "<div class='panel-heading'>Lista de "+itemLabel+(itemLabel=="fornecedor"?"e":"")+"s</div>"+
                "<div class='panel-body'>"+items+"</div>"+
            "</div></div>";
    return content;
}
function format(value,type){
    if(value=="") return "-";
    var formated="";
    value=value.toString();
    if(type!="money"){
        if(/\W/.test(value)) while(/\W/.test(value)) formated=value=value.replace(/\W/,"");
        else for(var i=(type=="cpf"||type=="telCel"?11:(type=="cnpj"?14:(type=="telFixo"?10:8)))-1,a=value.length-1;i>=0;i--,a--)
            formated=(type=="cpf"?(i==9?"-"+value[a]:(i==6||i==3?"."+value[a]:value[a])):
            (type=="cnpj"?(i==12?"-"+value[a]:(i==8?"/"+value[a]:(i==5||i==2?"."+value[a]:value[a]))):
                (type=="telCel"?(i==7?"-"+value[a]:(i==3||i==2?" "+value[a]:(i==1?value[a]+")":(i==0?"("+value[a]:value[a])))):
                    (type=="telFixo"?(i==6?"-"+value[a]:(i==2?" "+value[a]:(i==1?value[a]+")":(i==0?"("+value[a]:value[a])))):
                        (i==5?"-"+value[a]:(i==2?"."+value[a]:value[a]))))))+formated;
    }else formated=(/^R/g.test(value))?value.replace(",",".").replace("R$ ",""):"R$ "+value.replace(".",",");
    return formated;
}
function successCase(data){
    var obj=JSON.parse(data);
    swal({
        title:obj.msg,
        type:obj.type,
        html:true
    });
}
function errorCase(textStatus,errorThrown){
    swal({
        title: "Ocorreu um erro!",
        text: "<p>Descrição do erro: \""+textStatus+" "+errorThrown+"\".</p><p>Gostaria de tentar novamente?</p>",
        type: "error",
        html: true
    });
}