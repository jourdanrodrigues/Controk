function content(target,action){
    var Target=upperCaseFL(target);
    loadFile("class/"+Target+".js");
    eval("var obj=new "+Target+"()");
    $(".estoque,.fornecedor,.endereco,.cliente,.funcionario,.contato,.produto,.remessa").remove();
    $("input.alvo").val(target);
    setButtons(action);
    var container="<div class='"+target+"'>"+
    "<h3>"+action+(target!="estoque"?" de ":" itens no ")+(target!="funcionario"?Target:Target.replace("a","á"))+"</h3>";
    container+=obj.genFields(action);
    container+="</div>";
    if((target=="fornecedor"||target=="cliente"||target=="funcionario")&&(action=="Cadastro"||action=="Atualização"))
        container+=contentContato()+contentEndereco();
    $(".mainForm").prepend(container);
    inputProps();
    if($(".direita").css("display")=="none") $(".direita").css("display","block");
}
function contentContato(){
    return "<div class='contato'><h3>Contatos</h3>"+
        generateField({field:"email",lblContent:"E-mail"})+
        generateField({field:"telFixo",lblContent:"Telefone Fixo"})+
        generateField({field:"telCel",lblContent:"Telefone Celular"})+
        "</div>";
}
function contentEndereco(){
    return "<div class='endereco'><h3>Endereço</h3>"+
        generateField({field:"rua",lblContent:"Rua"})+
        generateField({field:"numero",type:"number",lblContent:"Número"})+
        generateField({field:"complemento",lblContent:"Complemento"})+
        generateField({field:"cep",lblContent:"CEP"})+
        generateField({field:"bairro",lblContent:"Bairro"})+
        generateField({field:"cidade",lblContent:"Cidade"})+
        generateField({field:"estado",lblContent:"Estado (UF)"})+
        "</div>";
}
function inputProps(){
    $("input[class*='cpf']").mask("999.999.999-99");
    $(".cnpj").mask("99.999.999/9999-99");
    $(".telFixo").mask("(99) 9999-9999");
    $(".telCel").mask("(99) 9 9999-9999");
    $(".cep").mask("99.999-999");
    $(".custo,.valorVenda").priceFormat({
        prefix: "R$ ",
        centsSeparator: ",",
        thousandsSeparator: "."
    });
    $("input[class*='data']").mask("99/99/9999").datepicker({
        format: "dd/mm/yyyy",
        language: "pt-BR",
        autoclose:true
    });
    $("form label").click(function(){$("."+$(this).attr("data-for")).focus();});
}
function setButtons(action){
    switch(action){
        case "Cadastro": $("input.acao").val("cadastrar"); $(".goBtn").html("Cadastrar"); break;
        case "Busca de dados": $("input.acao").val("buscarDados"); $(".goBtn").html("Buscar dados"); break;
        case "Atualização": $("input.acao").val("atualizar"); $(".goBtn").html("Atualizar"); break;
        case "Exclusão": $("input.acao").val("excluir"); $(".goBtn").html("Excluir"); break;
        case "Inserir": $("input.acao").val("inserir"); $(".goBtn").html("Inserir"); break;
        case "Retirar": $("input.acao").val("retirar"); $(".goBtn").html("Retirar");
    }
}