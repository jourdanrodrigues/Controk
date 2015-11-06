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
            var obj=JSON.parse(dados);
            if(obj.type==="error"||obj.type==="success") successCase(dados, btnText);
            else{
                $('.cliente h3').html('Atualização de Cliente');
                $(".idCliente").val(obj.idCliente).attr('readonly','readonly').addClass('readonly');
                $(".nomeCliente").val(obj.nome);
                $(".cpfCliente").val(obj.cpf);
                $(".obsCliente").val(obj.obs);
                $(".email").val(obj.email);
                $(".telFixo").val(obj.telFixo);
                $(".telCel").val(obj.telCel);
                $(".rua").val(obj.rua);
                $(".numero").val(obj.numero);
                $(".complemento").val(obj.complemento);
                $(".cep").val(obj.cep);
                $(".bairro").val(obj.bairro);
                $(".cidade").val(obj.cidade);
                $(".estado").val(obj.estado);
                escondeTudo();
                $(".goBtn").html("Atualizar");
                $("input.alvo").val("cliente");
                $("input.acao").val("atualizar");
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