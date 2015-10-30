function cadastrarCliente(){
    var btnText=$(".goBtn").html();
    $(".goBtn").html("Aguarde...");
    $.ajax({
        type: "POST",
        data: {
            alvo: $("input.alvo").val(),
            nome: $(".nomeCliente").val(),
            cpf: $(".cpfCliente").val(),
            obs: $(".obsCliente").val(),
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
            errorCase(textStatus, errorThrown, btnText, cadastrarCliente);
        }
    });
}
function buscarDadosCliente(){
    var btnText=$(".goBtn").html();
    $(".goBtn").html("Aguarde...");
    $.ajax({
        data: {
            alvo: $("input.alvo").val(),
            idCliente: $(".idCliente").val()
        },
        type: "POST",
        url: "php/actions/buscarDados.php",
        success: function(dados){
            returnType=$(dados).filter(".retorno").attr("data-type");
            if(returnType==="error"||returnType==="success") successCase(dados, btnText);
            else{
            $('.cliente h3').html('Atualização de Cliente');
            $(".idCliente").val($(dados).filter(".idCliente").val()).attr('readonly','readonly').addClass('readonly');
            $(".nomeCliente").val($(dados).filter(".nome").val());
            $(".cpfCliente").val($(dados).filter(".cpf").val());
            $(".obsCliente").val($(dados).filter(".obs").val());
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
            $("input.alvo").val("cliente");
            $("input.acao").val("atualizar");
            escondeTudo();
            $('.cliente,.contato,.endereco').css('display','block').find('input,textarea').attr('required',true);
            $('.cliente p').css('display','block').find('input,textarea').attr('required',true);
            }
        },
        error: function(jqXHR, textStatus, errorThrown){
            errorCase(textStatus, errorThrown, btnText, buscarDadosCliente);
        }
    });
}
function atualizarCliente(){
    var btnText=$(".goBtn").html();
    $(".goBtn").html("Aguarde...");
    $.ajax({
        type: "POST",
        data: {
            alvo: $("input.alvo").val(),
            idCliente: $(".idCliente").val(),
            nome: $(".nomeCliente").val(),
            cpf: $(".cpfCliente").val(),
            obs: $(".obsCliente").val(),
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
            errorCase(textStatus, errorThrown, btnText, atualizarCliente);
        }
    });
}
function excluirCliente(){
    var btnText=$(".goBtn").html();
    $(".goBtn").html("Aguarde...");
    $.ajax({
        type:"POST",
        data:{
            alvo: $("input.alvo").val(),
            idCliente: $(".idCliente").val()
        },
        url: "php/actions/excluir.php",
        success: function(dados){
            successCase(dados, btnText);
        },
        error: function(jqXHR, textStatus, errorThrown){
            errorCase(textStatus, errorThrown, btnText, excluirCliente);
        }
    });
}