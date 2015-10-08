$(document).ready(function(){
    $("input.cpfFuncionario,input.cpfCliente").mask("999.999.999-99");
    $("input.cnpj").mask("99.999.999/9999-99");
    $("input.telFixo").mask("(99) 9999-9999");
    $("input.telCel").mask("(99) 9 9999-9999");
    $("input.cep").mask("99.999-999");
    $(".custoProd,.valorVenda").priceFormat({
        prefix: "R$ ",
        centsSeparator: ",",
        thousandsSeparator: "."
    });
    $("input[class*='data'").mask("99/99/9999").datepicker({
        format: "dd/mm/yyyy",
        language: "pt-BR",
        autoclose:true
    });
    $("body").fadeTo(600, 1,"swing");
    $("form label").click(function(){$("."+$(this).attr("data-for")).focus();});
    $(".backToMain").click(function(){location.href="/";});
});
function endDateConfig(){$("input.endDate").datepicker("setStartDate", $("startDate").val());}
function opcoes(item){
    if($("."+item+" ul").css("display")==="block") $("."+item+" ul").css("display","none");
    else $("."+item+" ul").css("display","block");
}
function setTitle(target,content){
    if($(target+" h3").length===0) $(target).prepend(content);
    else $(target+" h3").html($(content).filter("h3").html());
}
function escondeTudo(){$(".remessa,.produto,.fornecedor,.cliente,.funcionario,.estoque,.contato,.endereco").css("display","none").find("input,textarea").removeAttr("required");}
function dbManage(item,proc){
    if($(".direita").css("display")==="none") $(".direita").css("display","block");
    switch(proc){
        case "Cadastro":
            $("input.acao").val("cadastrar");
            $(".goBtn").html("Cadastrar");
            break;
        case "Busca de Dados":
            $("input.acao").val("buscarDados");
            $(".goBtn").html("Buscar dados");
            break;
        case "Exclusão":
            $("input.acao").val("excluir");
            $(".goBtn").html("Excluir");
            break;
        case "Inserir":
            $("input.acao").val("inserir");
            $(".goBtn").html("Inserir");
            break;
        case "Retirar":
            $("input.acao").val("retirar");
            $(".goBtn").html("Retirar");
    }
    switch(item){
        case "fornecedor":
            $("input.alvo").val("fornecedor");
            setTitle(".fornecedor","<h3>"+proc+" de Fornecedor</h3>");
            escondeTudo();
            switch(proc){
                case "Cadastro":
                    $(".fornecedor,.contato,.endereco").css("display","block").find("input,textarea").attr("required",true);
                    $(".fornecedor p").css("display","block").find("input,textarea").attr("required",true);
                    $(".campoIdFornecedor").css("display","none").find("input").removeAttr("required");
                    break;
                case "Busca de Dados":
                    $(".fornecedor").css("display","block");
                    $(".fornecedor p").css("display","none").find("input,textarea").removeAttr("required");
                    $(".campoIdFornecedor").css("display","block").find("input").attr("required",true).removeAttr("readonly").removeClass("readonly");
                    break;
                case "Exclusão":
                    $(".fornecedor").css("display","block");
                    $(".fornecedor p").css("display","none").find("input,textarea").removeAttr("required");
                    $(".campoIdFornecedor").css("display","block").find("input").attr("required",true).removeAttr("readonly").removeClass("readonly");
            }
            break;
        case "cliente":
            $("input.alvo").val("cliente");
            setTitle(".cliente","<h3>"+proc+" de Cliente</h3>");
            escondeTudo();
            switch(proc){
                case "Cadastro":
                    $(".cliente,.contato,.endereco").css("display","block").find("input,textarea").attr("required",true);
                    $(".cliente p").css("display","block").find("input,textarea").attr("required",true);
                    $(".campoIdCliente").css("display","none").find("input").removeAttr("required");
                    break;
                case "Busca de Dados":
                case "Exclusão":
                    $(".cliente").css("display","block");
                    $(".cliente p").css("display","none").find("input,textarea").removeAttr("required");
                    $(".campoIdCliente").css("display","block").find("input").attr("required",true).removeAttr("readonly").removeClass("readonly");
            }
            break;
        case "funcionario":
            $("input.alvo").val("funcionario");
            setTitle(".funcionario","<h3>"+proc+" de Funcionário</h3>");
            escondeTudo();
            switch(proc){
                case "Cadastro":
                    $(".funcionario,.contato,.endereco").css("display","block").find("input,textarea").attr("required",true);
                    $(".funcionario p").css("display","block").find("input,textarea").attr("required",true);
                    $(".campoIdFuncionario").css("display","none").find("input").removeAttr("required");
                    break;
                case "Busca de Dados":
                case "Exclusão":
                    $(".funcionario").css("display","block");
                    $(".funcionario p").css("display","none").find("input,textarea").removeAttr("required");
                    $(".campoIdFuncionario").css("display","block").find("input").attr("required",true).removeAttr("readonly").removeClass("readonly");
            }
            break;
        case "remessa":
            $("input.alvo").val("remessa");
            setTitle(".remessa","<h3>"+proc+" de Remessa</h3>");
            escondeTudo();
            switch(proc){
                case "Cadastro": $(".remessa").css("display","block").find("input,textarea").attr("required",true);
            }
            break;
        case "produto":
            $("input.alvo").val("produto");
            setTitle(".produto","<h3>"+proc+" de Produto</h3>");
            escondeTudo();
            switch(proc){
                case "Cadastro":
                    $(".produto").css("display","block").find("input,textarea").attr("required",true);
                    $(".produto p").css("display","block").find("input,textarea").attr("required",true);
                    $(".campoIdProduto").css("display","none").find("input").removeAttr("required");
                    break;
                case "Busca de Dados":
                    $(".produto").css("display","block");
                    $(".produto p").css("display","none").find("input,textarea").removeAttr("required");
                    $(".campoIdProduto").css("display","block").find("input").attr("required",true).removeAttr("readonly").removeClass("readonly");
            }
            break;
        case "estoque":
            $("input.alvo").val("estoque");
            setTitle(".estoque","<h3>"+proc+" itens no Estoque</h3>");
            escondeTudo();
            switch(proc){
                case "Inserir":
                    $(".estoque").css("display","block").find("input,textarea").attr("required",true);
                    $(".estoque p").css("display","block").find("input,textarea").attr("required",true);
                    $(".campoIdFuncEstq,.campoDataSaidaEstq").css("display","none").find("input").removeAttr("required");
                    break;
                case "Retirar":
                    $(".estoque").css("display","block");
                    $(".estoque p").css("display","block").find("input,textarea").attr("required",true);
                    $(".campoIdFuncEstq,.campoDataSaidaEstq").css("display","block").find("input").attr("required",true);
            }
            break;
        default:$(".direita").css("display","none");
    }
}