function Fornecedor(){}
Fornecedor.prototype={
    constructor:Fornecedor,
    data:function(action){
        return {
            target:"fornecedor",
            action:action,
            id:$(".id").val(),
            nome:$(".nome").val(),
            cnpj:format($(".cpf").val(),"cpf"),
            email:$(".email").val().toLowerCase(),
            telCel:format($(".telCel").val(),"telCel"),
            telFixo:format($(".telFixo").val(),"telFixo"),
            rua:$(".rua").val(),
            numero:$(".numero").val(),
            complemento:$(".complemento").val(),
            cep:format($(".cep").val(),"cep"),
            bairro:$(".bairro").val(),
            cidade:$(".cidade").val(),
            estado:$(".estado").val()
        };
    },
    cadastrar:function(){
        $.ajax({
            type:"POST",
            data:this.data("cadastrar"),
            url:"php/manager.php",
            success: function(data){successCase(data);},
            error: function(jqXHR,textStatus,errorThrown){errorCase(textStatus,errorThrown);}
        });
    },
    listar:function(){
        $.ajax({
            data:{
                target:"fornecedor",
                action:"listar"
            },
            type:"POST",
            url:"php/manager.php",
            success: function(data){
                var obj=JSON.parse(data);
                if(obj.type=="error"||obj.type=="success") successCase(data);
                else{
                    var content="",filter="";
                    if(obj.length!=0){
                        content="<table class='table'><thead><tr><th></th><th>Nome</th><th>CNPJ</th>"+
                        "<th><span class='glyphicon glyphicon-plus'></span></th><th></th></tr></thead><tbody>";
                        $.each(obj,function(i,item){
                            content+="<tr data-id='"+item.id+"'>"+
                            "<td class='check'><input type='checkbox'></td>"+
                            "<td class='nome'>"+item.nome+"</td>"+
                            "<td class='cnpj'>"+format(item.cpf,"cnpj")+"</td>"+
                            "<td class='maisInfo'><span class='glyphicon glyphicon-eye-open'></span></td>"+
                            "<td class='atualizar'><span class='glyphicon glyphicon-pencil'></span></td></tr>";
                        });
                        content+="</tbody></table>";
                        filter="<input type='text' class='form-control' data-search='nome' placeholder='Nome'>"+
                        "<input type='text' class='form-control' data-search='cnpj' placeholder='CNPJ'>"+
                        "<input type='text' class='form-control' data-search='email' placeholder='E-mail'>";
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
            type:"POST",
            data:{
                id:$(trigger).parent().attr("data-id"),
                target:"fornecedor",
                action:"mostrarDados"
            },
            url:"php/manager.php",
            success: function(data){
                var obj=JSON.parse(data),title=$(".navbar-nav li.active a").html(),
                text="<table class='table info'><tr><th>ID:</th><td>"+$(trigger).parent().attr("data-id")+"</td></tr>"+
                    "<tr><th>Email:</th><td>"+obj.email+"</td></tr>"+
                    "<tr><th>Celular:</th><td>"+format(obj.telCel,"telCel")+"</td></tr>"+
                    "<tr><th>Tel. Fixo:</th><td>"+format(obj.telFixo,"telFixo")+"</td></tr>"+
                    "<tr><th>Endereço:</th><td>"+obj.logradouro+" "+obj.log_nome+", "+obj.numero+", "+obj.complemento+", bairro "+obj.bairro+"</td></tr>"+
                    "<tr><th>Cidade:</th><td>"+obj.cidade+"/"+obj.estado+"</td></tr>"+
                    "<tr><th>CEP:</th><td>"+format(obj.cep,"cep")+"</td></tr></table>";
                title="<span style='font-size:12pt'>"+title+":</span><br>"+$(trigger).parent().find("td.nome").html();
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
            type:"POST",
            data:this.data("atualizar"),
            url:"php/manager.php",
            success: function(data){successCase(data);},
            error: function(jqXHR,textStatus,errorThrown){errorCase(textStatus,errorThrown);}
        });
    },
    excluir:function(){
        var msg=0;
        $.each($("input:checked"),function(){msg++;});
        swal({
            title:"Atenção!",
            text:"Você está prestes a excluir "+msg+" funcionário"+(msg>1?"s":"")+".<br>Deseja continuar?",
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
                    type:"POST",
                    data:{
                        target:"fornecedor",
                        action:"excluir",
                        id:JSON.stringify(idList)
                    },
                    url:"php/manager.php",
                    success: function(data){
                        successCase(data);
                        $(".navbar-nav li.active").click();
                    },
                    error: function(jqXHR,textStatus,errorThrown){errorCase(textStatus,errorThrown);}
                });
            }
        });
    }
};