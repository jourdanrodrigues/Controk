function Estoque(){
    this.inserir=function(){
        var btnText=$(".goBtn").html();
        $(".goBtn").html("Aguarde...");
        $.ajax({
            type: "POST",
            data: {
                alvo: "estoque",
                idProdutoEstq: $(".idProdutoEstq").val(),
                qtdProdEstq: $(".qtdProdEstq").val()
            },
            url: "php/actions/inserir.php",
            success: function(dados){successCase(dados, btnText);},
            error: function(jqXHR, textStatus, errorThrown){errorCase(textStatus, errorThrown, btnText, cadastrarRemessa);}
        });
    };
    this.retirar=function(){
        var btnText=$(".goBtn").html();
        $(".goBtn").html("Aguarde...");
        $.ajax({
            type: "POST",
            data: {
                alvo: "estoque",
                idProdutoEstq: $(".idProdutoEstq").val(),
                idFuncionarioEstq: $(".idFuncionarioEstq").val(),
                dataSaida: $(".dataSaida").val(),
                qtdProdEstq: $(".qtdProdEstq").val()
            },
            url: "php/actions/retirar.php",
            success: function(dados){successCase(dados, btnText);},
            error: function(jqXHR, textStatus, errorThrown){errorCase(textStatus, errorThrown, btnText, cadastrarRemessa);}
        });
    };
}