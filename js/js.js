$(document).ready(function(){
//Sub-itens
    var target=[
        ["Funcionario","funcionario"],//0
        ["Cliente","cliente"],//1
        ["Fornecedor","fornecedor"],//2
        ["Remessa","remessa"],//3
        ["Produto","produto"],//4
        ["Estoque","estoque"]//5
    ];
    var action=[
        ["cadastrar","Cadastro"],//0
        ["buscarDados","Busca de dados"],//1
        ["excluir","Exclusão"],//2
        ["inserir","Inserir"],//3
        ["retirar","Retirar"]//4
    ];
// Itens principais
    $(".nav"+target[0][0]).click(function(){ddMenu("nav"+target[0][0]);});
    $(".nav"+target[1][0]).click(function(){ddMenu("nav"+target[1][0]);});
    $(".nav"+target[2][0]).click(function(){ddMenu("nav"+target[2][0]);});
    $(".nav"+target[3][0]).click(function(){ddMenu("nav"+target[3][0]);});
    $(".nav"+target[4][0]).click(function(){ddMenu("nav"+target[4][0]);});
    $(".nav"+target[5][0]).click(function(){ddMenu("nav"+target[5][0]);});
    //Funcionário
    $(".nav"+target[0][0]+" ."+action[0][0]).click(function(){content(target[0][1],action[0][1]);});
    $(".nav"+target[0][0]+" ."+action[1][0]).click(function(){content(target[0][1],action[1][1]);});
    $(".nav"+target[0][0]+" ."+action[2][0]).click(function(){content(target[0][1],action[2][1]);});
    //Cliente
    $(".nav"+target[1][0]+" ."+action[0][0]).click(function(){content(target[1][1],action[0][1]);});
    $(".nav"+target[1][0]+" ."+action[1][0]).click(function(){content(target[1][1],action[1][1]);});
    $(".nav"+target[1][0]+" ."+action[2][0]).click(function(){content(target[1][1],action[2][1]);});
    //Fornecedor
    $(".nav"+target[2][0]+" ."+action[0][0]).click(function(){content(target[2][1],action[0][1]);});
    $(".nav"+target[2][0]+" ."+action[1][0]).click(function(){content(target[2][1],action[1][1]);});
    $(".nav"+target[2][0]+" ."+action[2][0]).click(function(){content(target[2][1],action[2][1]);});
    //Remessa
    $(".nav"+target[3][0]+" ."+action[0][0]).click(function(){content(target[3][1],action[0][1]);});
    //Produto
    $(".nav"+target[4][0]+" ."+action[0][0]).click(function(){content(target[4][1],action[0][1]);});
    $(".nav"+target[4][0]+" ."+action[1][0]).click(function(){content(target[4][1],action[1][1]);});
    //Estoque
    $(".nav"+target[5][0]+" ."+action[3][0]).click(function(){content(target[5][1],action[3][1]);});
    $(".nav"+target[5][0]+" ."+action[4][0]).click(function(){content(target[5][1],action[4][1]);});
    $("body").fadeTo(600,1,"swing");
    $(".backToMain").click(function(){location.href="/";});
});
function upperCaseFL(string){return string.replace(string[0],string[0].toUpperCase());}
function ddMenu(item){
    if($("."+item+" ul").css("display")==="block") $("."+item+" ul").css("display","none");
    else $("."+item+" ul").css("display","block");
}
function format(value,type){
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
function generateField(obj){
    var content="<p"+(typeof(obj.id)!="undefined"?" class='campoId"+obj.id+"'":"")+
        "><label data-for='"+obj.field+"'>"+obj.lblContent+"</label><br>"+
        (typeof(obj.fieldTag)!="undefined"&&obj.fieldTag=="textarea"?"<textarea class='":
            "<input type='"+(typeof(obj.type)!="undefined"?obj.type+"'":"text'")+" class='field ")+obj.field;
    if(typeof(obj.classes)!="undefined") for(var i=0;i<obj.classes.length;i++) content+=" "+obj.classes[i];
    //Atributos
    return content+"'"+(typeof(obj.rows)!="undefined"?" row="+obj.rows:"")+
            (typeof(obj.readonly)!="undefined"?" readonly=true":"")+
            (typeof(obj.cols)!="undefined"?" cols="+obj.cols:"")+
            (typeof(obj.value)!="undefined"?" value='"+obj.value+"'":"")+
            (typeof(obj.plcHolder)!="undefined"?" placeholder='"+obj.plcHolder+"'":"")+
            " required='required'"+
            //(typeof(obj.required)!="undefined"&&obj.required===1?" required='required'":"")+
            (typeof(obj.fieldTag)!="undefined"&&obj.fieldTag==="textarea"?"></textarea></p>":"></p>");
}