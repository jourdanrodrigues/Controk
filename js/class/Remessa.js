function Remessa(){}
Remessa.prototype={
    constructor:Remessa,
    target:"remessa",
    exibirCampos:function(id){
        var content="<div class='panel panel-default'>"+
                        "<div class='panel-heading'>Informações da Remessa</div>"+
                        "<div class='panel-body'>"+
                            generateFields({md:6,xs:12,label:"ID do Fornecedor",field:"fornecedor",type:"number",required:1})+
                            generateFields({md:6,xs:12,label:"ID do produto",field:"produto",type:"number",required:1})+
                            generateFields({md:6,xs:12,label:"Quantidade",field:"qtdProd",type:"number",required:1})+
                            generateFields({md:6,xs:12,label:"Data da entrega",field:"dataEntrega date",required:1})+
                            generateFields({md:6,xs:12,label:"Data do pedido",field:"dataPedido date",required:1})+
                            generateFields({md:6,xs:12,label:"Data do pagamento",field:"dataPagamento date",required:1})+
                        "</div>"+
                    "</div>";
        showFading(showFields(content,typeof(id)=="undefined"?"Cadastrar":"Atualizar"),'$(".row>.container").removeClass("col-xs-12").addClass("col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1");');
    },
    cadastrar:function(){
        $.ajax({
            type:"post",
            dataType:"json",
            data:{
                target:this.target,
                action:"cadastrar",
                idProduto:$(".produto").val(),
                qtdProd:$(".qtdProd").val(),
                idFornecedor:$(".fornecedor").val(),
                dataPedido:$(".dataPedido").val(),
                dataPagamento:$(".dataPagamento").val(),
                dataEntrega:$(".dataEntrega").val()
            },
            url:"php/manager.php",
            success:function(obj){
                var self=this;
                swal({
                    title:obj.msg,
                    type:obj.type,
                    html:true,
                    closeOnConfirm:false
                },function(){
                    if(obj.type=="error") swal.close();
                    else{
                        $.ajax({
                            type:"post",
                            dataType:"json",
                            data:{
                                target:"estoque",
                                action:"inserir",
                                idProduto:$(".produto").val(),
                                qtdProd:$(".qtdProd").val()
                            },
                            url:"php/manager.php",
                            success:function(obj){
                                successCase(obj);
                                self.listar();
                            },
                            error:function(jqXHR,textStatus,errorThrown){errorCase(textStatus,errorThrown);}
                        });
                    }
                });
            },
            error: function(jqXHR,textStatus,errorThrown){errorCase(textStatus,errorThrown);}
        });
    },
    listar:function(){
        $.ajax({
            data:{
                target:this.target,
                action:"listar"
            },
            type:"post",
            dataType:"json",
            url:"php/manager.php",
            success: function(obj){
                if(obj.type=="error"||obj.type=="success") successCase(obj);
                else{
                    var content="",filter="";
                    if(obj.length!=0){
                        content="<table class='table'><thead><tr><th>ID</th><th>Produto</th><th>Quantidade</th><th>Fornecedor</th>"+
                        "</tr></thead><tbody>";
                        $.each(obj,function(i,a){
                            content+="<tr data-id='"+a.id+"'>"+
                            "<td class='id moreInfo'>"+a.id+"</td>"+
                            "<td class='produto moreInfo'>"+a.produto+"</td>"+
                            "<td class='qtdProd moreInfo'>"+a.qtdProd+"</td>"+
                            "<td class='fornecedor moreInfo'>"+a.fornecedor+"</td></tr>";
                        });
                        content+="</tbody></table>";
                        $.each([["id","ID","number"],["produto","Produto"],["fornecedor","Fornecedor"]],function(i,a){
                            filter+="<div class='form-group col-md-12 col-sm-4 col-xs-"+(a[0]=="fornecedor"?12:6)+"'>"+
                                "<input type='"+(a[2]=="undefined"?"text":a[2])+"' class='form-control' data-search='"+a[0]+"' placeholder='"+a[1]+"'></div>";
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
            dataType:"json",
            data:{
                id:$(trigger).parent().attr("data-id"),
                target:this.target,
                action:"mostrarDados"
            },
            url:"php/manager.php",
            success: function(obj){
                var text="<table class='table info'><tr><th>Data do Pedido:</th><td>"+obj.dataPedido+"</td></tr>"+
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