function cadastrarFornecedor(){
    var btnText=$(".goBtn").html();
    $(".goBtn").html("Aguarde...");
    $.ajax({
        type: "POST",
        data: {
            alvo: $("input.alvo").val(),
            nomeFantasia: $(".nomeFantasia").val(),
            cnpj: $(".cnpj").val(),
            email: $(".email").val(),
            telCel: $(".telCel").val(),
            telFixo: $(".telFixo").val(),
            rua: $(".rua").val(),
            numero: $(".numero").val(),
            complemento: $(".complemento").val(),
            cep: $(".cep").val(),
            bairro: $(".bairro").val(),
            cidade: $(".cidade").val(),
            estado: $(".estado").val()
        },
        url: "php/actions/cadastrar.php",
        success: function(dados){
            successCase(dados, btnText);
        },
        error: function(jqXHR, textStatus, errorThrown){
            errorCase(textStatus, errorThrown, btnText, cadastrarFornecedor);
        }
    });
}
function buscarDadosFornecedor(){
    var btnText=$(".goBtn").html();
    $(".goBtn").html("Aguarde...");
    $.ajax({
        data: {
            alvo: $("input.alvo").val(),
            idFornecedor: $(".idFornecedor").val()
        },
        type: "POST",
        url: "php/actions/buscarDados.php",
        success: function(dados){
            returnType=$(dados).filter(".retorno").attr("data-type");
            if(returnType=="error"||returnType=="success"){
                successCase(dados, btnText);
                return;
            }
            $('.fornecedor h3').html('Atualização de Fornecedor');
            $(".idFornecedor").val($(dados).filter(".idFornecedor").val()).attr('readonly','readonly').addClass('readonly');
            $(".nomeFantasia").val($(dados).filter(".nomeFantasia").val());
            $(".cnpj").val($(dados).filter(".cnpj").val());
            $(".email").val($(dados).filter(".email").val());
            $(".telFixo").val($(dados).filter(".telFixo").val());
            $(".telCel").val($(dados).filter(".telCel").val());
            $(".rua").val($(dados).filter(".rua").val());
            $(".numero").val($(dados).filter(".numero").val());
            $(".complemento").val($(dados).filter(".complemento").val());
            $(".cep").val($(dados).filter(".cep").val());
            $(".bairro").val($(dados).filter(".bairro").val());
            $(".cidade").val($(dados).filter(".cidade").val());
            $(".estado").val($(dados).filter(".estado").val());
            $(".goBtn").html("Atualizar").val("atualizar");
            $("input.alvo").val("fornecedor");
            $("input.acao").val("atualizar");
            escondeTudo();
            $('.fornecedor,.contato,.endereco').css('display','block').find('input,textarea').attr('required',true);
            $('.fornecedor p').css('display','block').find('input,textarea').attr('required',true);
        },
        error: function(jqXHR, textStatus, errorThrown){
            errorCase(textStatus, errorThrown, btnText, buscarDadosFornecedor);
        }
    });
}
function atualizarFornecedor(){
    var btnText=$(".goBtn").html();
    $(".goBtn").html("Aguarde...");
    $.ajax({
        type: "POST",
        data: {
            alvo: $("input.alvo").val(),
            idFornecedor: $(".idFornecedor").val(),
            nomeFantasia: $(".nomeFantasia").val(),
            cnpj: $(".cnpj").val(),
            email: $(".email").val(),
            telCel: $(".telCel").val(),
            telFixo: $(".telFixo").val(),
            rua: $(".rua").val(),
            numero: $(".numero").val(),
            complemento: $(".complemento").val(),
            cep: $(".cep").val(),
            bairro: $(".bairro").val(),
            cidade: $(".cidade").val(),
            estado: $(".estado").val()
        },
        url: "php/actions/atualizar.php",
        success: function(dados){
            successCase(dados, btnText);
        },
        error: function(jqXHR, textStatus, errorThrown){
            errorCase(textStatus, errorThrown, btnText, atualizarFornecedor);
        }
    });
}
function excluirFornecedor(){
    var btnText=$(".goBtn").html();
    $(".goBtn").html("Aguarde...");
    $.ajax({
        type:"POST",
        data:{
            alvo: $("input.alvo").val(),
            idFornecedor: $(".idFornecedor").val()
        },
        url: "php/actions/excluir.php",
        success: function(dados){
            successCase(dados, btnText);
        },
        error: function(jqXHR, textStatus, errorThrown){
            errorCase(textStatus, errorThrown, btnText, excluirFornecedor);
        }
    });
}