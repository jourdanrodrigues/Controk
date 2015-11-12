function Remessa(){}
Remessa.prototype={
    constructor:Remessa,
    genFields:function(){
        return generateField({field:"idProduto",type:"number",lblContent:"ID do produto"})+
        generateField({field:"qtdProd",type:"number",lblContent:"Quantidade do produto (un.)"})+
        generateField({field:"idFornecedor",type:"number",lblContent:"ID do fornecedor"})+
        generateField({field:"dataPedido",lblContent:"Data do Pedido"})+
        generateField({field:"dataPagamento",lblContent:"Data do Pagamento"})+
        generateField({field:"dataEntrega",lblContent:"Data da Entrega"});
    },
    cadastrar:function(){
        var btnText=$(".goBtn").html();
        $(".goBtn").html("Aguarde...");
        $.ajax({
            type:"POST",
            data:{
                target: $("input.alvo").val(),
                action: "cadastrar",
                idProduto: $(".idProduto").val(),
                qtdProd: $(".qtdProd").val(),
                idFornecedor: $(".idFornecedor").val(),
                dataPedido: $(".dataPedido").val(),
                dataPagamento: $(".dataPagamento").val(),
                dataEntrega: $(".dataEntrega").val()
            },
            url:"php/manager.php",
            success: function(data){
                var obj=JSON.parse(data);
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
                                    type:"POST",
                                    data:{
                                        target: "estoque",
                                        action: "inserir",
                                        idProduto: $(".idProduto").val(),
                                        qtdProd: $(".qtdProd").val()
                                    },
                                    url:"php/manager.php",
                                    success: function(data){successCase(data,btnText);},
                                    error: function(jqXHR,textStatus,errorThrown){
                                        loadFile("Estoque.js");
                                        var estoque=new Estoque();
                                        errorCase(textStatus,errorThrown,btnText,estoque.inserir);
                                    }
                                });
                            }else{
                                $(".resetBtn").click();
                                $('.direita').css('display','none');
                            }
                        });
                    }
                });
            },
            error: function(jqXHR,textStatus,errorThrown){errorCase(textStatus,errorThrown,btnText,this.cadastrar);}
        });
    }
};