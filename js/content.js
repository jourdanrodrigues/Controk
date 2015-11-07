function content(target,action){
    $(".estoque,.fornecedor,.endereco,.cliente,.funcionario,.contato,.produto,.remessa").remove();
    $("input.alvo").val(target);
    setButtons(action);
    var container="<div class='"+target+"'>"+
    "<h3>"+action+" "+(target!="estoque"?"de":"itens no")+" "+(target!="funcionario"?target:target.replace("a","á"))+"</h3>";
    switch(target){
        case "fornecedor":
            switch(action){
                case "Atualização": container+=generateField({id:"Fornecedor",field:"idFornecedor",type:"number",lblContent:"ID do Fornecedor",readonly:1,classes:["readonly"]});
                case "Cadastro": container+=generateField({field:"nomeFantasia",lblContent:"Nome Fantasia"})+
                generateField({field:"cnpj",lblContent:"CNPJ"}); break;
                case "Busca de dados":
                case "Exclusão": container+=generateField({id:"Fornecedor",type:"number",field:"idFornecedor",lblContent:"ID do Fornecedor"});
            }
            break;
        case "cliente":
            switch(action){
                case "Atualização": container+=generateField({id:"Cliente",type:"number",field:"idCliente",lblContent:"ID do Cliente",readonly:1,classes:["readonly"]});
                case "Cadastro": container+=generateField({field:"nomeCliente",lblContent:"Nome"})+
                generateField({field:"cpfCliente",lblContent:"CPF"})+
                generateField({field:"obsCliente",lblContent:"Observação",value:"S. Obs."}); break;
                case "Busca de dados":
                case "Exclusão": container+=generateField({id:"Cliente",type:"number",field:"idCliente",lblContent:"ID do Cliente"});
            }
            break;
        case "funcionario":
            switch(action){
                case "Atualização": container+=generateField({id:"Funcionario",type:"number",field:"idFuncionario",lblContent:"ID do Funcionário",readonly:1,classes:["readonly"]});
                case "Cadastro": container+=generateField({field:"nomeFuncionario",lblContent:"Nome"})+
                generateField({field:"cpfFuncionario",lblContent:"CPF"})+
                generateField({field:"cargo",lblContent:"Cargo"})+
                generateField({field:"obsFuncionario",lblContent:"Observação",value:"S. Obs."}); break;
                case "Busca de dados":
                case "Exclusão": container+=generateField({id:"Funcionario",type:"number",field:"idFuncionario",lblContent:"ID do Funcionário"});
            }
            break;
        case "remessa":
            container+=generateField({field:"idProdutoRem",type:"number",lblContent:"ID do produto"})+
            generateField({field:"qtdProdRem",type:"number",lblContent:"Quantidade do produto (un.)"})+
            generateField({field:"idFornecedorRem",type:"number",lblContent:"ID do fornecedor"})+
            generateField({field:"dataPedido",lblContent:"Data do Pedido"})+
            generateField({field:"dataPagamento",lblContent:"Data do Pagamento"})+
            generateField({field:"dataEntrega",lblContent:"Data da Entrega"}); break;
        case "produto":
            switch(action){
                case "Atualização": container+=generateField({id:"Produto",type:"number",field:"idProduto",lblContent:"ID do Produto",readonly:1,classes:["readonly"]});
                case "Cadastro": container+=generateField({field:"idRemessa",type:"number",lblContent:"ID da remessa"})+
                generateField({field:"nomeProd",lblContent:"Nome do produto"})+
                generateField({field:"descrProd",fieldTag:"textarea",lblContent:"Descrição do produto"})+
                generateField({field:"custoProd",lblContent:"Custo do produto"})+
                generateField({field:"valorVenda",lblContent:"Valor de venda do produto"}); break;
                case "Busca de dados": container+=generateField({id:"Produto",type:"number",field:"idProduto",lblContent:"ID do Produto"});
            }
            break;
        case "estoque":
            switch(action){
                case "Retirar": container+=generateField({id:"FuncEstq",type:"number",field:"idFuncionarioEstq",lblContent:"ID do funcionário"});
                case "Inserir": container+=generateField({field:"idProdutoEstq",type:"number",lblContent:"ID do produto"})+
                generateField({field:"qtdProdEstq",type:"number",lblContent:"Quantidade do produto (un.)"})+
                generateField({id:"DataSaidaEstq",field:"dataSaida",lblContent:"Data Saída"}); break;
            }
            break;
        default: container=""; container(target);
    }
    container+="</div>";
    if((target==="fornecedor"||target==="cliente"||target==="funcionario")&&(action==="Cadastro"||action==="Atualização"))
        container+=contentContato()+contentEndereco();
    $(".mainForm").prepend(container);
    format();
    if($(".direita").css("display")==="none") $(".direita").css("display","block");
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
function format(){
    $("input[class*='cpf']").mask("999.999.999-99");
    $(".cnpj").mask("99.999.999/9999-99");
    $(".telFixo").mask("(99) 9999-9999");
    $(".telCel").mask("(99) 9 9999-9999");
    $(".cep").mask("99.999-999");
    $(".custoProd,.valorVenda").priceFormat({
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