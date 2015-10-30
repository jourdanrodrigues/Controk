function cadastrarFuncionario(){
    var btnText=$(".goBtn").html();
    $(".goBtn").html("Aguarde...");
    $.ajax({
        type: "POST",
        data: {
            alvo: $("input.alvo").val(),
            nome: $(".nomeFuncionario").val(),
            cpf: $(".cpfFuncionario").val(),
            obs: $(".obsFuncionario").val(),
            cargo: $(".cargo").val(),
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
            errorCase(textStatus, errorThrown, btnText, cadastrarFuncionario);
        }
    });
}
function buscarDadosFuncionario(){
    var btnText=$(".goBtn").html();
    $(".goBtn").html("Aguarde...");
    $.ajax({
        data: {
            alvo: $("input.alvo").val(),
            idFuncionario: $(".idFuncionario").val()
        },
        type: "POST",
        url: "php/actions/buscarDados.php",
        success: function(dados){
            returnType=$(dados).filter(".retorno").attr("data-type");
            if(returnType==="error"||returnType==="success"){
                successCase(dados, btnText);
                return;
            }
            $('.funcionario h3').html('Atualização de Funcionário');
            $(".idFuncionario").val($(dados).filter(".idFuncionario").val()).attr('readonly','readonly').addClass('readonly');
            putDataValues(dados,[
                [".nomeFuncionario",".nome"],
                [".cpfFuncionario",".cpf"],
                [".obsFuncionario",".obs"],
                [".cargo",".cargo"],
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
            $(".goBtn").html("Atualizar").val("atualizar");
            $("input.alvo").val("funcionario");
            $("input.acao").val("atualizar");
            escondeTudo();
            $('.funcionario,.contato,.endereco').css('display','block').find('input,textarea').attr('required',true);
            $('.funcionario p').css('display','block').find('input,textarea').attr('required',true);
        },
        error: function(jqXHR, textStatus, errorThrown){
            errorCase(textStatus, errorThrown, btnText, buscarDadosFuncionario);
        }
    });
}
function atualizarFuncionario(){
    var btnText=$(".goBtn").html();
    $(".goBtn").html("Aguarde...");
    $.ajax({
        type: "POST",
        data: {
            alvo: $("input.alvo").val(),
            idFuncionario: $(".idFuncionario").val(),
            nomeFuncionario: $(".nomeFuncionario").val(),
            cpfFuncionario: $(".cpfFuncionario").val(),
            obsFuncionario: $(".obsFuncionario").val(),
            cargo: $(".cargo").val(),
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
            errorCase(textStatus, errorThrown, btnText, atualizarFuncionario);
        }
    });
}
function excluirFuncionario(){
    var btnText=$(".goBtn").html();
    $(".goBtn").html("Aguarde...");
    $.ajax({
        type:"POST",
        data:{
            alvo: $("input.alvo").val(),
            idFuncionario: $(".idFuncionario").val()
        },
        url: "php/actions/excluir.php",
        success: function(dados){
            successCase(dados, btnText);
        },
        error: function(jqXHR, textStatus, errorThrown){
            errorCase(textStatus, errorThrown, btnText, excluirFuncionario);
        }
    });
}