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
                $(".produto h3").html("Atualização de Produto");
                $(".idProduto").val(obj.idProduto).attr("readonly","readonly").addClass("readonly");
                $(".idRemessa").val(obj.idRemessa);
                $(".nomeProd").val(obj.nomeProd);
                $(".descrProd").val(obj.descrProd);
                $(".custoProd").val(obj.custoProd);
                $(".valorVenda").val(obj.valorVenda);
                $(".goBtn").html("Atualizar").val("atualizar");
                $("input.alvo").val("produto");
                $("input.acao").val("atualizar");
                escondeTudo();
                $(".produto").css("display","block").find("input,textarea").attr("required",true);
                $(".produto p").css("display","block").find("input,textarea").attr("required",true);
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