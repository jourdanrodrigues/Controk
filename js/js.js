$(document).ready(function(){
    $(".navbar-nav li").click(function(){
        if(parseInt($("html").css("width").replace("px",""))+17<768) $("button.navbar-toggle").click();
        $(".navbar-nav li.active").removeClass("active");
        $(this).addClass("active");
        instance("listar"); // Função LISTAR
    });
    $("body").fadeTo(600,1,"swing");
});
function showFading(content,someCode){
    $('.row .container').fadeTo(600,0,function(){
        $(this).html(content);
        if(typeof(someCode)!="undefined") eval(someCode);
        else $(".row>.container").removeClass("col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1").addClass("col-xs-12");
        elementProp();
        $(this).fadeTo(600,1);
    });
}
function instance(action){
    var Target=$(".navbar-nav li.active a").html().replace("á","a");
    loadFile("class/"+Target+".js");
    eval("var obj=new "+Target+"(); obj."+action+"();");
}
function elementProp(){ // Propriedades dos elementos depois de carregados
    $(".cpf").mask("999.999.999-99");
    $(".cnpj").mask("99.999.999/9999-99");
    $(".cep").mask("99.999-999");
    $(".telCel").mask("(99) 9 9999-9999");
    $(".telFixo").mask("(99) 9999-9999");
    if(window.outerWidth>768) $("[data-toggle='popover']").popover();
    $(".moreInfo").click(function(){ // Elementos para exibir mais informações sobre o item
        var Target=$(".navbar-nav li.active a").html();
        if(Target=="Funcionário") Target=Target.replace("á","a");
        eval("var obj=new "+Target+"();");
        obj.mostrarDados(this);
    });
    $("input[type='checkbox']").click(function(){ // Muda estado do botão: "Cadastrar" <-> "Excluir"
        var checks=$("input:checked").length, sets=(checks!=0?["plus","remove","excluir"]:["remove","plus","exibirCampos"]),
            color=checks!=0?"#A00":"#080";
        $(".action").css("background",color).attr({
            "data-target":sets[2],
            "data-content":(color!="#A00"?"Novo":"Excluir selecionado"+(checks>1?"s":""))
        });
        $(".action .panel-body span").removeClass("glyphicon-"+sets[0]).addClass("glyphicon-"+sets[1]);
    }).parent().hover(function(){$(this).css("background-color","#FAFAD2");},
    function(){$(this).css("background-color","rgba(0,0,0,0)");});
    $(".moreInfo").hover(function(){$(this).parent().find(".moreInfo").css("background-color","#FAFAD2");},
    function(){$(this).parent().find(".moreInfo").css("background-color","rgba(0,0,0,0)");});
}
function listItems(filter,items){
    if($(".action").length==0){
        $("body").append("<div class='panel panel-default action' style='opacity:0' data-target='exibirCampos' data-toggle='popover' data-trigger='hover' data-placement='left' data-content='Novo'>"+
        "<div class='panel-body'><span class='glyphicon glyphicon-plus'></span></div></div>");
        $(".action").fadeTo(600,1);
        $(".action").click(function(){instance($(this).attr("data-target"));});
    }else{
        $(".action").css("background","green").attr({
            "data-target":"exibirCampos",
            "data-content":"Cadastrar"
        });
        $(".action .panel-body span").fadeTo(600,0,function(){
           $(this).removeClass("glyphicon-remove glyphicon-ok").addClass("glyphicon-plus").fadeTo(600,1);
        });
    }
    var itemLabel=$(".navbar-nav li.active a").html().toLowerCase(),
    content="<div class='col-lg-2 col-lg-offset-1 col-md-3'><div class='panel panel-primary filter'>"+
                "<div class='panel-heading'>Filtro</div>"+
                "<div class='panel-body'>"+filter+"</div>"+
            "</div></div>"+
            "<div class='col-md-8'><div class='panel panel-primary list'>"+
                "<div class='panel-heading'>Lista de "+itemLabel+(itemLabel=="fornecedor"?"e":"")+"s</div>"+
                "<div class='panel-body'>"+items+"</div>"+
            "</div></div>";
    return content;
}
function showFields(content){
    $(".action span").fadeTo(600,0,function(){
        $(this).parent().parent().attr({
            "data-target":"cadastrar",
            "data-content":"Cadastrar "+$(".navbar-nav li.active a").html()
        });
        $(this).removeClass(/^glyphicon\-/).addClass("glyphicon glyphicon-ok").fadeTo(600,1);
    });
    return content;
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
function relist(){
    $(".navbar-nav li.active").click();
    if(window.outerWidth>768) $("[data-toggle='popover']").popover();
}
function generateFields(obj){
    var content="<div class='container "+
    (typeof(obj.lg)!="undefined"?" col-lg-"+obj.lg:"")+
    (typeof(obj.lgOf)!="undefined"?" col-lg-offset-"+obj.lgOf:"")+
    (typeof(obj.md)!="undefined"?" col-md-"+obj.md:"")+
    (typeof(obj.mdOf)!="undefined"?" col-md-offset-"+obj.md:"")+
    (typeof(obj.xs)!="undefined"?" col-xs-"+obj.xs:"")+
    (typeof(obj.xsOf)!="undefined"?" col-xs-offset-"+obj.md:"")+"'>"+
    "<div class='form-group"+
    (typeof(obj.label)!="undefined"?" input-group'><span class='input-group-addon'>"+obj.label+"</span>":"'>");
    if(obj.type=="select"){
        content+="<select class='form-control "+obj.field+"'>";
            $.each(obj.option,function(i,a){
                content+="<option "+(a[0]=="selected"?"disabled "+a[0]:"value='"+a[0]+"'")+">"+a[1]+"</option>";
            });
        content+="</select>";
    }else content+="<input type='"+(obj.type||"text")+"' class='form-control "+obj.field+"'"+
    (obj.required==1?" required":"")+
    (typeof(obj.placeholder)!="undefined"?" placeholder='"+obj.placeholder+"'":"")+">";
    return content+"</div></div>";
}