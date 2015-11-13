function Remessa(){}
Remessa.prototype={
    constructor:Remessa,
    target:"remessa",
    cadastrar:function(){
        var btnText=$(".goBtn").html();
        $(".goBtn").html("Aguarde...");
        $.ajax({
            type:"POST",
            data:{
                target:this.target,
                action:"cadastrar",
                idProduto:$(".idProduto").val(),
                qtdProd:$(".qtdProd").val(),
                idFornecedor:$(".idFornecedor").val(),
                dataPedido:$(".dataPedido").val(),
                dataPagamento:$(".dataPagamento").val(),
                dataEntrega:$(".dataEntrega").val()
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
                    if(obj.type=="error") swal.close();
                    else{
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
                    }
                });
            },
            error: function(jqXHR,textStatus,errorThrown){errorCase(textStatus,errorThrown,btnText,this.cadastrar);}
        });
    },
    listar:function(){
        $.ajax({
            data:{
                target:this.target,
                action:"listar"
            },
            type:"post",
            url:"php/manager.php",
            success: function(data){
                var obj=JSON.parse(data);
                if(obj.type=="error"||obj.type=="success") successCase(data);
                else{
                    var content="",filter="";
                    if(obj.length!=0){
                        content="<table class='table'><thead><tr><th>ID</th><th>Produto</th><th>Quantidade</th><th>Fornecedor</th>"+
                        "<th><span class='glyphicon glyphicon-plus'></span></th><th></th></tr></thead><tbody>";
                        $.each(obj,function(i,a){
                            content+="<tr data-id='"+a.id+"'>"+
                            "<td class='id'>"+a.id+"</td>"+
                            "<td class='produto'>"+a.produto+"</td>"+
                            "<td class='qtdProd'>"+a.qtdProd+"</td>"+
                            "<td class='fornecedor'>"+a.fornecedor+"</td>"+
                            "<td class='maisInfo'><span class='glyphicon glyphicon-eye-open'></span></td>"+
                            "<td class='atualizar'><span class='glyphicon glyphicon-pencil'></span></td></tr>";
                        });
                        content+="</tbody></table>";
                        $.each([["id","ID","number"],["produto","Produto"],["fornecedor","Fornecedor"]],function(i,a){
                            filter+="<input type='"+(a[2]=="undefined"?"text":a[2])+"' class='form-control' data-search='"+a[0]+"' placeholder='"+a[1]+"'>";
                        });
                    }else{
                        content="<span>Não há remessas cadastradas.</span>";
                        filter="<span>Filtro indisponível.</span>";
                    }
                    showFading(listItems(filter,content));
                }
            },
            error: function(jqXHR,textStatus,errorThrown){errorCase(textStatus,errorThrown);}
        });
    },
    mostrarDados:function(trigger){
        $.ajax({
            type:"post",
            data:{
                id:$(trigger).parent().attr("data-id"),
                target:this.target,
                action:"mostrarDados"
            },
            url:"php/manager.php",
            success: function(data){
                var obj=JSON.parse(data),
                text="<table class='table info'><tr><th>Data do Pedido:</th><td>"+obj.dataPedido+"</td></tr>"+
                    "<tr><th>Data do Pagamento:</th><td>"+obj.dataPagamento+"</td></tr>"+
                    "<tr><th>Data da Entrega:</th><td>"+obj.dataEntrega+"</td></tr>";
                var title="<span style='font-size:12pt'>"+$(".navbar-nav li.active a").html()+":</span><br>"+$(trigger).parent().attr("data-id");
                swal({
                    title:title,
                    text:text,
                    html:1
                });
            },
            error: function(jqXHR,textStatus,errorThrown){errorCase(textStatus,errorThrown);}
        });
    }
};