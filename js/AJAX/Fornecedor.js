﻿function cadastrarFornecedor(){
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
            putDataValues(dados,[
                [".nomeFantasia",".nomeFantasia"],
                [".cnpj",".cnpj"],
                [".email",".email"],
                [".telFixo",".telFixo"],
                [".telCel",".telCel"],
                [".cep",".cep"],
                [".rua",".rua"],
                [".numero",".numero"],
                [".complemento",".complemento"],
                [".bairro",".bairro"],
                [".cidade",".cidade"],
                [".estado",".estado"]
            ]);
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