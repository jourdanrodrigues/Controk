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
            alert(dados);
            var obj=JSON.parse(dados);
            if(obj.type==="error"||obj.type==="success") successCase(dados, btnText);
            else{
                content("funcionario","Atualização");
                $(".idFuncionario").val(obj.idFuncionario);
                $(".nomeFuncionario").val(obj.nome);
                $(".cpfFuncionario").val(obj.cpf);
                $(".obsFuncionario").val(obj.obs);
                $(".cargo").val(obj.cargo);
                $(".email").val(obj.email);
                $(".telFixo").val(obj.telFixo);
                $(".telCel").val(obj.telCel);
                $(".cep").val(obj.cep);
                $(".rua").val(obj.rua);
                $(".numero").val(obj.numero);
                $(".complemento").val(obj.complemento);
                $(".bairro").val(obj.bairro);
                $(".cidade").val(obj.cidade);
                $(".estado").val(obj.estado);
            }
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