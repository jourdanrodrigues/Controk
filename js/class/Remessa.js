function Remessa(){
    this.cadastrar=function(){
        var btnText=$(".goBtn").html();
        $(".goBtn").html("Aguarde...");
        $.ajax({
            type: "POST",
            data: {
                alvo: $("input.alvo").val(),
                idProduto: $(".idProdutoRem").val(),
                qtdProd: $(".qtdProdRem").val(),
                idFornecedor: $(".idFornecedorRem").val(),
                dataPedido: $(".dataPedido").val(),
                dataPagamento: $(".dataPagamento").val(),
                dataEntrega: $(".dataEntrega").val()
            },
            url: "php/actions/cadastrar.php",
            success: function(dados){
                var obj=JSON.parse(dados);
                $(".goBtn").html(btnText);
                swal({
                    title:obj.msg,
                    type:obj.type,
                    html: true,
                    closeOnConfirm: false
                },function(){
                    if(obj.type==="error") swal.close();
                    else{
                        swal({
                            title:"O produto será inserido no estoque.",
                            type:"info",
                            showCancelButton: true,
                            confirmButtonText: "Ok",
                            cancelButtonText: "Cancelar",
                            closeOnConfirm: false,
                            showLoaderOnConfirm: true
                        },function(isConfirm){
                            if(isConfirm){
                                $.ajax({
                                    type: "POST",
                                    data: {
                                        alvo: "estoque",
                                        idProdutoEstq: $(".idProdutoRem").val(),
                                        qtdProdEstq: $(".qtdProdRem").val()
                                    },
                                    url: "php/actions/inserir.php",
                                    success: function(dados){successCase(dados, btnText);},
                                    error: function(jqXHR, textStatus, errorThrown){errorCase(textStatus, errorThrown, btnText, cadastrarRemessa);}
                                });
                            }else limparCampos();
                        });
                    }
                });
            },
            error: function(jqXHR, textStatus, errorThrown){errorCase(textStatus, errorThrown, btnText, cadastrarRemessa);}
        });
    };
}