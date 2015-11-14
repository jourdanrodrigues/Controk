function Produto(){}
Produto.prototype={
    constructor: Produto,
    target:"produto",
    data:function(action){
        switch(action){
            case "cadastrar":
            case "atualizar": var data={
                    target:this.target,
                    action:action,
                    id:$(".id").val(),
                    idRemessa:$(".idRemessa").val(),
                    nome:$(".nome").val(),
                    descricao:$(".descricao").val(),
                    custo:format($(".custo").val(),"money"),
                    valorVenda:format($(".valorVenda").val(),"money")
                }; break;
            case "buscarDados": var data={
                    target: $("input.alvo").val(),
                    action: action,
                    id: $(".id").val()
                }; break;
        }
        return data;
    },
    cadastrar:function(){
        $.ajax({
            type:"post",
            data:this.data("cadastrar"),
            url:"php/manager.php",
            success: function(data){successCase(data);},
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
            url:"php/manager.php",
            success: function(data){
                var obj=JSON.parse(data);
                if(obj.type=="error"||obj.type=="success") successCase(data);
                else{
                    var content="",filter="";
                    if(obj.length!=0){
                        content="<table class='table'><thead><tr><th>Nome</th><th>Descrição</th><th>Remessa</th>"+
                        "<th><span class='glyphicon glyphicon-plus'></span></th><th></th></tr></thead><tbody>";
                        $.each(obj,function(i,a){
                            content+="<tr data-id='"+a.id+"'>"+
                            "<td class='nome'>"+a.nome+"</td>"+
                            "<td class='descricao'>"+a.descricao+"</td>"+
                            "<td class='remessa'>"+a.remessa+"</td>"+
                            "<td class='maisInfo'><span class='glyphicon glyphicon-eye-open'></span></td>"+
                            "<td class='atualizar'><span class='glyphicon glyphicon-pencil'></span></td></tr>";
                        });
                        content+="</tbody></table>";
                        $.each([["nome","Nome"],["remessa","Remessa","number"]],function(i,a){
                            filter+="<div class='form-group col-md-12 col-xs-6'>"+
                                "<input type='"+(a[2]=="undefined"?"text":a[2])+"' class='form-control' data-search='"+a[0]+"' placeholder='"+a[1]+"'></div>";
                        });
                    }else{
                        content="<span>Não há produtos cadastrados.</span>";
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
                text="<table class='table info'><tr><th>ID:</th><td>"+$(trigger).parent().attr("data-id")+"</td></tr>"+
                    "<tr><th>Descrição:</th><td>"+obj.descricao+"</td></tr>"+
                    "<tr><th>Custo:</th><td>"+format(obj.custo,"money")+"</td></tr>"+
                    "<tr><th>Valor de venda:</th><td>"+format(obj.valorVenda,"money")+"</td></tr>"+
                    "<tr><th>Lucro:</th><td>"+((obj.valorVenda/obj.custo-1)*100)+"%</td></tr>";
                var title="<span style='font-size:12pt'>"+$(".navbar-nav li.active a").html()+":</span><br>"+$(trigger).parent().find("td.nome").html();
                swal({
                    title:title,
                    text:text,
                    html:1
                });
            },
            error: function(jqXHR,textStatus,errorThrown){errorCase(textStatus,errorThrown);}
        });
    },
    buscarDados:function(){
        $.ajax({
            data:{
                target:this.target,
                action:"buscarDados"
            },
            type: "post",
            url: "php/manager.php",
            success: function(data){
                var obj=JSON.parse(data);
                if(obj.type==="error"||obj.type==="success") successCase(data);
                else{
                    content("produto","Atualização");
                    $(".id").val(obj.id);
                    $(".idRemessa").val(obj.idRemessa);
                    $(".nome").val(obj.nome);
                    $(".descricao").val(obj.descricao);
                    $(".custo").val(format(obj.custo,"money"));
                    $(".valorVenda").val(format(obj.valorVenda,"money"));
                }
            },
            error: function(jqXHR,textStatus,errorThrown){errorCase(textStatus,errorThrown);}
        });
    },
    atualizar:function(){
        $.ajax({
            type:"post",
            data:this.data("atualizar"),
            url:"php/manager.php",
            success: function(data){successCase(data);},
            error: function(jqXHR,textStatus,errorThrown){errorCase(textStatus,errorThrown);}
        });
    }
};