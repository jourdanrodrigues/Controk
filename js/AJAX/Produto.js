function cadastrarProduto(){
    var btnText=$(".goBtn").html();
    $(".goBtn").html("Aguarde...");
    $.ajax({
        type: "POST",
        data: {
            alvo: $("input.alvo").val(),
            idRemessa: $(".idRemessa").val(),
            nomeProd: $(".nomeProd").val(),
            descrProd: $(".descrProd").val(),
            custoProd: $(".custoProd").val(),
            valorVenda: $(".valorVenda").val()
        },
        url: "php/actions/cadastrar.php",
        success: function(dados){
            successCase(dados, btnText);
        },
        error: function(jqXHR, textStatus, errorThrown){
            errorCase(textStatus, errorThrown, btnText, cadastrarProduto);
        }
    });
}
function buscarDadosProduto(){
    var btnText=$(".goBtn").html();
    $(".goBtn").html("Aguarde...");
    $.ajax({
        data: {
            alvo: $("input.alvo").val(),
            idProduto: $(".idProduto").val()
        },
        type: "POST",
        url: "php/actions/buscarDados.php",
        success: function(dados){
            var obj=JSON.parse(dados);
            if(obj.type==="error"||obj.type==="success") successCase(dados, btnText);
            else{
                content("produto","Atualização");
                $(".idProduto").val(obj.idProduto);
                $(".idRemessa").val(obj.idRemessa);
                $(".nomeProd").val(obj.nomeProd);
                $(".descrProd").val(obj.descrProd);
                $(".custoProd").val(obj.custoProd);
                $(".valorVenda").val(obj.valorVenda);
            }
        },
        error: function(jqXHR, textStatus, errorThrown){
            errorCase(textStatus, errorThrown, btnText, buscarDadosProduto);
        }
    });
}
function atualizarProduto(){
    var btnText=$(".goBtn").html();
    $(".goBtn").html("Aguarde...");
    $.ajax({
        type: "POST",
        data: {
            alvo: $("input.alvo").val(),
            idProduto: $(".idProduto").val(),
            idRemessa: $(".idRemessa").val(),
            nome: $(".nomeProd").val(),
            descricao: $(".descrProd").val(),
            custoProd: $(".custoProd").val(),
            valorVenda: $(".valorVenda").val()
        },
        url: "php/actions/atualizar.php",
        success: function(dados){
            successCase(dados, btnText);
        },
        error: function(jqXHR, textStatus, errorThrown){
            errorCase(textStatus, errorThrown, btnText, atualizarProduto);
        }
    });
}