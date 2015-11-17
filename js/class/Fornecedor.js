function Fornecedor(){}
Fornecedor.prototype={
    constructor:Fornecedor,
    target:"fornecedor",
    data:function(action){
        return {
            target:this.target,
            action:action,
            id:$(".id").val(),
            nome:$(".nome").val(),
            cnpj:$(".cpf").val().format("cpf"),
            email:$(".email").val().toLowerCase(),
            telCel:$(".telCel").val().format("telCel"),
            telFixo:$(".telFixo").val().format("telFixo"),
            rua:$(".rua").val(),
            numero:$(".numero").val(),
            complemento:$(".complemento").val(),
            cep:$(".cep").val().format("cep"),
            bairro:$(".bairro").val(),
            cidade:$(".cidade").val(),
            estado:$(".estado").val()
        };
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
                        content="<table class='table'><thead><tr><th></th><th>Nome</th><th>CNPJ</th><th></th></tr></thead><tbody>";
                        $.each(obj,function(i,a){
                            content+="<tr data-id='"+a.id+"'>"+
                            "<td class='check'><input type='checkbox'></td>"+
                            "<td class='nome moreInfo'>"+a.nome+"</td>"+
                            "<td class='cnpj moreInfo'>"+a.cnpj.format("cnpj")+"</td>"+
                            "<td class='atualizar'><span class='glyphicon glyphicon-pencil'></span></td></tr>";
                        });
                        content+="</tbody></table>";
                        $.each([["nome","Nome"],["cnpj","CNPJ"],["email","E-mail"]],function(i,a){
                            filter+="<div class='form-group col-md-12 col-xs-"+(i==2?12:6)+"'>"+
                                "<input type='text' class='form-control' data-search='"+a[0]+"' placeholder='"+a[1]+"'></div>";
                        });
                    }else{
                        content="<span>Não há fornecedores cadastrados.</span>";
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
                    "<tr><th>CNPJ:</th><td>"+obj.cnpj.format("cnpj")+"</td></tr>"+
                    "<tr><th>Email:</th><td>"+obj.email+"</td></tr>"+
                    "<tr><th>Celular:</th><td>"+obj.telCel.format("telCel")+"</td></tr>"+
                    "<tr><th>Tel. Fixo:</th><td>"+obj.telFixo.format("telFixo")+"</td></tr>"+
                    "<tr><th>Endereço:</th><td>"+obj.logradouro+" "+obj.log_nome+", "+(obj.numero==""?"S/N":obj.numero)+","+(obj.complemento==""?"":" "+obj.complemento)+", bairro "+obj.bairro+"</td></tr>"+
                    "<tr><th>Cidade:</th><td>"+obj.cidade+"/"+obj.estado+"</td></tr>"+
                    "<tr><th>CEP:</th><td>"+obj.cep.format("cep")+"</td></tr></table>";
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
    atualizar:function(){
        $.ajax({
            type:"post",
            data:this.data("atualizar"),
            url:"php/manager.php",
            success: function(data){successCase(data);},
            error: function(jqXHR,textStatus,errorThrown){errorCase(textStatus,errorThrown);}
        });
    },
    excluir:function(){
        var num=0;
        $.each($("input:checked"),function(){num++;});
        swal({
            title:"Atenção!",
            text:"Você está prestes a excluir "+num+" fornecedor"+(num>1?"es":"")+".<br>Deseja continuar?",
            html:1,
            type:"warning",
            showCancelButton: true,
            cancelButtonText: "Cancelar",
            closeOnConfirm: false,
            showLoaderOnConfirm: true
        },function(isConfirm){
            if(isConfirm){
                var idList=new Array();
                $.each($("input:checked"),function(){idList.push($(this).parent().parent().attr("data-id"));});
                $.ajax({
                    type:"post",
                    data:{
                        target:"fornecedor",
                        action:"excluir",
                        id:JSON.stringify(idList)
                    },
                    url:"php/manager.php",
                    success: function(data){
                        successCase(data);
                        relist();
                    },
                    error: function(jqXHR,textStatus,errorThrown){errorCase(textStatus,errorThrown);}
                });
            }
        });
    }
};