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
    $(".row .container").fadeTo(600,0,function(){
        $(this).html(content);
        if(typeof(someCode)!="undefined") eval(someCode);
        else $(".row>.container").removeClass("col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1").addClass("col-xs-12");
        elementProp();
        $(this).fadeTo(600,1);
    });
}
function instance(action,id){
    var Target=$(".navbar-nav li.active a").html().replace("á","a");
    loadFile("class/"+Target+".js");
    eval("var obj=new "+Target+"(); obj."+action+"("+
            (action=="atualizar"?$(".id").val():
                (typeof(id)!="undefined"?id:""))+");");
}
function elementProp(){ // Propriedades dos elementos depois de carregados
    if($(".cpf").length!=0) $(".cpf").mask("999.999.999-99");
    if($(".cnpj").length!=0) $(".cnpj").mask("99.999.999/9999-99");
    if($(".cep").length!=0) $(".cep").mask("99.999-999");
    if($(".telCel").length!=0) $(".telCel").mask("(99) 9 9999-9999");
    if($(".telFixo").length!=0) $(".telFixo").mask("(99) 9999-9999");
    if($(".ajaxForm").length!=0) $(".ajaxForm").unbind().submit(function(){
        instance($(".action").attr("data-target"));
        return false;
    });
    if($(".date").length!=0) $(".date").unbind().mask("99/99/9999").datepicker({
        format:"dd/mm/yyyy",
        todayBtn:"linked",
        language:"pt-BR",
        autoclose:true
    });
    if($(".money").length!=0) $(".money").maskMoney({
        prefix:"R$ ",
        thousands:"",
        decimal:","
    });
    if($(".edit").length!=0) $(".edit").unbind().click(function(){
        instance("buscarDados",$(this).parent().attr("data-id"));
    });
    if(window.outerWidth>768) $("[data-toggle='popover']").popover();
    if($(".moreInfo").length!=0) $(".moreInfo").unbind().click(function(){ // Elementos para exibir mais informações sobre o item
        var Target=$(".navbar-nav li.active a").html();
        if(Target=="Funcionário") Target=Target.replace("á","a");
        eval("var obj=new "+Target+"();");
        obj.mostrarDados(this);
    }).hover(function(){$(this).parent().find(".moreInfo").css("background-color","#FAFAD2");},
    function(){$(this).parent().find(".moreInfo").css("background-color","rgba(0,0,0,0)");});
    if($("input[type='checkbox']").length!=0) $("input[type='checkbox']").unbind().click(function(){ // Muda estado do botão: "Cadastrar" <-> "Excluir"
        var checks=$("input:checked").length, sets=(checks!=0?["plus","remove","excluir"]:["remove","plus","exibirCampos"]),
            color=checks!=0?"#A00":"#080";
        $(".action").css("background",color).attr({
            "data-target":sets[2],
            "data-content":(color!="#A00"?"Novo":"Excluir selecionado"+(checks>1?"s":""))
        });
        $(".action .panel-body span").removeClass("glyphicon-"+sets[0]).addClass("glyphicon-"+sets[1]);
    }).parent().hover(function(){$(this).css("background-color","#FAFAD2");},
    function(){$(this).css("background-color","rgba(0,0,0,0)");});
}
function listItems(filter,items){
    if($(".action").length==0){
        $("body").append("<div class='panel panel-default action' style='opacity:0' data-target='exibirCampos' data-toggle='popover' data-trigger='hover' data-placement='left' data-content='Novo'>"+
        "<div class='panel-body'><span class='glyphicon glyphicon-plus'></span></div></div>");
        $(".action").fadeTo(600,1);
        $(".action").click(function(){
            var a=$(this).attr("data-target");
            if(a=="cadastrar"||a=="atualizar") $(".ajaxForm input[type='submit']").click();
            else instance(a);
        });
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
function showFields(content,actionLbl){
    $(".action span").fadeTo(600,0,function(){
        $(this).parent().parent().attr({
            "data-target":actionLbl.toLowerCase(),
            "data-content":actionLbl+" "+$(".navbar-nav li.active a").html()
        });
        $(this).removeClass("glyphicon-remove glyphicon-plus").addClass("glyphicon glyphicon-ok").fadeTo(600,1);
    });
    return "<div class='panel panel-primary'><div class='panel-heading'>"+actionLbl+" "+$(".navbar-nav li.active a").html().toLowerCase()+
            "</div><div class='panel-body'><form class='ajaxForm'>"+content+"<input type='submit' style='display:none'></form></div></div>";
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
function generateFields(obj){
    if(obj=="contato")
        return generateFields({sm:6,smOf:3,xs:12,label:"E-mail",field:"email",type:"email",required:1})+
        generateFields({sm:6,xs:12,label:"Celular",field:"telCel",placeholder:"(00) 9 0000-0000",required:1})+
        generateFields({sm:6,xs:12,label:"Fixo",field:"telFixo",placeholder:"(00) 3000-0000",required:1});
    else if(obj=="endereco")
        return generateFields({lg:4,sm:4,xs:12,label:"Tipo",field:"logradouro",type:"select",
        option:[["Rua","Rua"],["Av.","Avenida"],["Tv.","Travessa"]]})+
        generateFields({lg:5,sm:5,xs:12,label:"Nome",required:1,field:"log_nome"})+
        generateFields({lg:3,sm:3,xs:12,field:"numero",type:"number",placeholder:"Número"})+
        generateFields({lg:4,sm:4,xs:12,label:"Compl.",field:"complemento",placeholder:"Casa, apartamento..."})+
        generateFields({lg:4,sm:4,xs:12,label:"Bairro",required:1,field:"bairro"})+
        generateFields({lg:4,sm:4,xs:12,label:"UF",field:"estado",type:"select",required:1,
        option:[["selected","-"],["CE","CE"],["MA","MA"]]})+
        generateFields({lg:6,sm:6,xs:12,label:"Cidade",field:"cidade",required:1,type:"select",
        option:[["selected","-"],["Fortaleza","Fortaleza"],["Juazeiro","Juazeiro"]]})+
        generateFields({lg:6,sm:6,xs:12,label:"CEP",field:"cep",required:1});
    else{
        var content="<div class='container"+
        (typeof(obj.lg)!="undefined"?" col-lg-"+obj.lg:"")+
        (typeof(obj.lgOf)!="undefined"?" col-lg-offset-"+obj.lgOf:"")+
        (typeof(obj.md)!="undefined"?" col-md-"+obj.md:"")+
        (typeof(obj.mdOf)!="undefined"?" col-md-offset-"+obj.mdOf:"")+
        (typeof(obj.sm)!="undefined"?" col-sm-"+obj.sm:"")+
        (typeof(obj.smOf)!="undefined"?" col-sm-offset-"+obj.smOf:"")+
        (typeof(obj.xs)!="undefined"?" col-xs-"+obj.xs:"")+
        (typeof(obj.xsOf)!="undefined"?" col-xs-offset-"+obj.xsOf:"")+"'>"+
        "<div class='form-group"+
        (typeof(obj.label)!="undefined"?" input-group'><span class='input-group-addon'>"+obj.label+"</span>":"'>");
        if(obj.type=="select"){
            content+="<select class='form-control "+obj.field+"'>";
            $.each(obj.option,function(i,a){
                content+="<option "+(a[0]=="selected"?"disabled "+a[0]:"value='"+a[0]+"'")+">"+a[1]+"</option>";
            });
            content+="</select>";
        }else content+="<input type='"+(obj.type||"text")+"' class='form-control"+(obj.readonly==1?" readonly":"")+" "+obj.field+"'"+
        (obj.required==1?" required":"")+(obj.readonly==1?" disabled":"")+
        (typeof(obj.placeholder)!="undefined"?" placeholder='"+obj.placeholder+"'":"")+
        (typeof(obj.value)!="undefined"?" value='"+obj.value+"'":"")+">";
        return content+"</div></div>";
    }
}