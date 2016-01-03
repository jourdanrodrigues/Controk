function Produto(){}
Produto.prototype={
    constructor: Produto,
    target:"produto",
    data:function(action){
        return{
            target:this.target,
            action:action,
            id:$(".id").val(),
            idRemessa:$(".remessa").val(),
            nome:$(".nome").val(),
            descricao:$(".descricao").val(),
            custo:$(".custo").val().format("money"),
            valorVenda:$(".valorVenda").val().format("money")
        };
    },
    exibirCampos:function(id){
        var content="<div class='panel panel-default'>"+
                        "<div class='panel-heading'>Informações do Produto</div>"+
                        "<div class='panel-body'>"+
                            (typeof(id)!="undefined"?
                                generateFields({sm:4,smOf:4,xs:12,label:"ID",field:"id",readonly:1,value:id}):"")+
                            generateFields({md:6,xs:12,label:"ID da Remessa",field:"remessa",type:"number",required:1})+
                            generateFields({md:6,xs:12,label:"Nome",field:"nome",required:1})+
                            generateFields({lg:8,lgOf:2,xs:12,label:"Descrição",field:"descricao",placeholder:"Breve...",required:1})+
                            generateFields({md:6,xs:12,label:"Custo",field:"custo money",required:1})+
                            generateFields({md:6,xs:12,label:"Valor p/ venda",field:"valorVenda money",required:1})+
                        "</div>"+
                    "</div>";
        showFading(showFields(content,typeof(id)=="undefined"?"Cadastrar":"Atualizar"),'$(".row>.container").removeClass("col-xs-12").addClass("col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1");');
    },
    cadastrar:function(){
        var self=this;
        $.ajax({
            type:"post",
            data:this.data("cadastrar"),
            url:"php/manager.php",
            success: function(data){
                successCase(data);
                self.listar();
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
            url:"php/manager.php",
            success: function(data){
                var obj=JSON.parse(data);
                if(obj.type=="error"||obj.type=="success") successCase(data);
                else{
                    var content="",filter="";
                    if(obj.length!=0){
                        content="<table class='table'><thead><tr><th>Nome</th><th>Descrição</th><th>Remessa</th>"+
                        "<th></th></tr></thead><tbody>";
                        $.each(obj,function(i,a){
                            content+="<tr data-id='"+a.id+"'>"+
                            "<td class='nome moreInfo'>"+a.nome+"</td>"+
                            "<td class='descricao moreInfo'>"+a.descricao+"</td>"+
                            "<td class='remessa moreInfo'>"+a.remessa+"</td>"+
                            "<td class='edit'><span class='glyphicon glyphicon-pencil'></span></td></tr>";
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
                    "<tr><th>Custo:</th><td>"+obj.custo.toFixed(2).format("money")+"</td></tr>"+
                    "<tr><th>Valor de venda:</th><td>"+obj.valorVenda.toFixed(2).format("money")+"</td></tr>"+
                    "<tr><th>Lucro:</th><td>"+((obj.valorVenda/obj.custo-1)*100).toFixed(2)+"%</td></tr>";
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
    buscarDados:function(id){
        this.exibirCampos(id);
        $.ajax({
            data:{
                id:id,
                target:this.target,
                action:"buscarDados"
            },
            type: "post",
            url: "php/manager.php",
            success: function(data){
                var obj=JSON.parse(data);
                if(obj.type=="error"||obj.type=="success") successCase(data);
                else setTimeout(function(){
                    $(".remessa").val(obj.idRemessa);
                    $(".nome").val(obj.nome);
                    $(".descricao").val(obj.descricao);
                    $(".custo").val(obj.custo.toFixed(2).format("money"));
                    $(".valorVenda").val(obj.valorVenda.toFixed(2).format("money"));
                },601);
            },
            error: function(jqXHR,textStatus,errorThrown){errorCase(textStatus,errorThrown);}
        });
    },
    atualizar:function(){
        var self=this;
        $.ajax({
            type:"post",
            data:this.data("atualizar"),
            url:"php/manager.php",
            success: function(data){
                successCase(data);
                self.listar();
            },
            error: function(jqXHR,textStatus,errorThrown){errorCase(textStatus,errorThrown);}
        });
    }
};