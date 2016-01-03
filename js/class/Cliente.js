function Cliente(){}
Cliente.prototype={
    constructor:Cliente,
    target:"cliente",
    data:function(action){
        return {
            target:this.target,
            action:action,
            id:$(".id").val(),
            nome:$(".nome").val(),
            cpf:$(".cpf").val().format("cpf"),
            email:$(".email").val().toLowerCase(),
            telCel:$(".telCel").val().format("telCel"),
            telFixo:$(".telFixo").val().format("telFixo"),
            log_nome:$(".log_nome").val(),
            logradouro:$(".logradouro").val(),
            numero:$(".numero").val(),
            complemento:$(".complemento").val(),
            cep:$(".cep").val().format("cep"),
            bairro:$(".bairro").val(),
            cidade:$(".cidade").val(),
            estado:$(".estado").val()
        };
    },
    exibirCampos:function(id){
        var content="<div class='panel panel-default'>"+
                        "<div class='panel-heading'>Informações gerais</div>"+
                        "<div class='panel-body'>"+
                            (typeof(id)!="undefined"?
                                generateFields({sm:4,smOf:4,xs:12,label:"ID",field:"id",readonly:1,value:id}):"")+
                            generateFields({sm:6,xs:12,label:"Nome",field:"nome",required:1})+
                            generateFields({sm:6,xs:12,label:"CPF",field:"cpf",required:1})+
                        "</div>"+
                    "</div>"+
                    "<div class='panel panel-default'>"+
                        "<div class='panel-heading'>Contato</div>"+
                        "<div class='panel-body'>"+generateFields("contato")+"</div>"+
                    "</div>"+
                    "<div class='panel panel-default'>"+
                        "<div class='panel-heading'>Endereço</div>"+
                        "<div class='panel-body'>"+generateFields("endereco")+"</div>"+
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
                        content="<table class='table'><thead><tr><th></th><th>Nome</th><th></th></tr></thead><tbody>";
                        $.each(obj,function(i,a){
                            content+="<tr data-id='"+a.id+"'>"+
                            "<td class='check'><input type='checkbox'></td>"+
                            "<td class='nome moreInfo'>"+a.nome+"</td>"+
                            "<td class='edit'><span class='glyphicon glyphicon-pencil'></span></td></tr>";
                        });
                        content+="</tbody></table>";
                        $.each([["nome","Nome"],["cpf","CPF"],["email","E-mail"]],function(i,a){
                            filter+="<div class='form-group col-md-12 col-ms-4 col-xs-"+(i==2?12:6)+"'>"+
                                "<input type='text' class='form-control' data-search='"+a[0]+"' placeholder='"+a[1]+"'></div>";
                        });
                    }else{
                        content="<span>Não há clientes cadastrados.</span>";
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
                    "<tr><th>CPF:</th><td>"+obj.cpf.format("cpf")+"</td></tr>"+
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
    buscarDados:function(id){
        this.exibirCampos(id);
        $.ajax({
            data:{
                id:id,
                action:"buscarDados",
                target:this.target
            },
            type:"post",
            url:"php/manager.php",
            success:function(data){
                var obj=JSON.parse(data);
                if(obj.type=="error"||obj.type=="success") successCase(data);
                else setTimeout(function(){
                    $(".nome").val(obj.nome);
                    $(".cpf").val(obj.cpf.format("cpf"));
                    $(".email").val(obj.email);
                    $(".telCel").val(obj.telCel.format("telCel"));
                    $(".telFixo").val(obj.telFixo.format("telFixo"));
                    $(".log_nome").val(obj.log_nome);
                    $(".logradouro").val(obj.logradouro);
                    $(".numero").val(obj.numero);
                    $(".complemento").val(obj.complemento);
                    $(".cep").val(obj.cep.format("cep"));
                    $(".bairro").val(obj.bairro);
                    $(".cidade").val(obj.cidade);
                    $(".estado").val(obj.estado);
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
    },
    excluir:function(){
        var num=0,self=this;
        $.each($("input:checked"),function(){num++;});
        swal({
            title:"Atenção!",
            text:"Você está prestes a excluir "+num+" cliente"+(num>1?"s":"")+".<br>Deseja continuar?",
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
                        target:"cliente",
                        action:"excluir",
                        id:JSON.stringify(idList)
                    },
                    url:"php/manager.php",
                    success: function(data){
                        successCase(data);
                        var obj=JSON.parse(data);
                        if(obj.type!="error") self.listar();
                    },
                    error: function(jqXHR,textStatus,errorThrown){errorCase(textStatus,errorThrown);}
                });
            }
        });
    }
};