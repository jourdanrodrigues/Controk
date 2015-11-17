function Cliente(){}
Cliente.prototype={
    constructor:Cliente,
    target:"cliente",
    data:function(action){
        return {
            target:this.target,
            action:action,
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
    exibirCampos:function(){
        var content="<div class='panel panel-primary'>"+
            "<div class='panel-heading'>Cadastrar cliente</div>"+
            "<div class='panel-body'>"+
                "<form>"+
                    "<div class='panel panel-default'>"+
                        "<div class='panel-heading'>Informações gerais</div>"+
                        "<div class='panel-body'>"+
                            generateFields({md:6,xs:6,label:"Nome",field:"nome",required:1})+
                            generateFields({md:6,xs:6,label:"CPF",field:"cpf",required:1})+
                        "</div>"+
                    "</div>"+
                    "<div class='panel panel-default'>"+
                        "<div class='panel-heading'>Contato</div>"+
                        "<div class='panel-body'>"+
                            generateFields({lg:6,lgOf:3,md:12,xs:12,label:"E-mail",field:"email",type:"email",required:1})+
                            generateFields({md:6,xs:6,label:"Tel. Cel.",field:"telCel",required:1})+
                            generateFields({md:6,xs:6,label:"Tel. Fixo.",field:"telFixo",required:1})+
                        "</div>"+
                    "</div>"+
                    "<div class='panel panel-default'>"+
                        "<div class='panel-heading'>Endereço</div>"+
                        "<div class='panel-body'>"+
                            generateFields({lg:6,lgOf:3,xs:6,label:"CEP",field:"cep",required:1})+
                            generateFields({lg:4,lgOf:2,md:6,xs:6,label:"Tipo",field:"logradouro",type:"select",
                            option:[["Rua","Rua"],["Av.","Avenida"],["Tv.","Travessa"]]})+
                            generateFields({lg:5,md:6,xs:6,label:"Nome",required:1,field:"log_nome"})+
                            generateFields({lg:2,xs:4,field:"numero",type:"number",placeholder:"Número"})+
                            generateFields({lg:5,xs:8,label:"Compl.",field:"complemento",placeholder:"Casa, apartamento..."})+
                            generateFields({lg:5,md:4,xs:12,label:"Bairro",required:1,field:"bairro"})+
                            generateFields({lg:4,md:4,xs:4,label:"UF",field:"estado",type:"select",required:1,
                            option:[["selected","-"],["CE","CE"],["MA","MA"]]})+
                            generateFields({lg:8,md:4,xs:8,label:"Cidade",field:"cidade",required:1,type:"select",
                            option:[["selected","-"],["Fortaleza","Fortaleza"],["Juazeiro","Juazeiro"]]})+
                        "</div>"+
                    "</div>"+
                "</form>"+
            "</div>"+
        "</div>";
        showFading(showFields(content),'$(".row>.container").removeClass("col-xs-12").addClass("col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1");');
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
                        content="<table class='table'><thead><tr><th></th><th>Nome</th><th></th></tr></thead><tbody>";
                        $.each(obj,function(i,a){
                            content+="<tr data-id='"+a.id+"'>"+
                            "<td class='check'><input type='checkbox'></td>"+
                            "<td class='nome moreInfo'>"+a.nome+"</td>"+
                            "<td class='atualizar'><span class='glyphicon glyphicon-pencil'></span></td></tr>";
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
    buscarDados:function(){
        $.ajax({
            data:this.data("buscarDados"),
            type:"post",
            url:"php/manager.php",
            success:function(data){
                var obj=JSON.parse(data);
                if(obj.type==="error"||obj.type==="success") successCase(data);
                else{
                    content("cliente","Atualização");
                    $(".id").val(obj.id);
                    $(".nome").val(obj.nome);
                    $(".cpf").val(obj.cpf.format("cpf"));
                    $(".email").val(obj.email);
                    $(".telFixo").val(obj.telFixo.format("telFixo"));
                    $(".telCel").val(obj.telCel.format("telCel"));
                    $(".cep").val(obj.cep.format("cep"));
                    $(".rua").val(obj.rua);
                    $(".numero").val(obj.numero);
                    $(".complemento").val(obj.complemento);
                    $(".bairro").val(obj.bairro);
                    $(".cidade").val(obj.cidade);
                    $(".estado").val(obj.estado);
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
    },
    excluir:function(){
        var num=0;
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
                        relist();
                    },
                    error: function(jqXHR,textStatus,errorThrown){errorCase(textStatus,errorThrown);}
                });
            }
        });
    }
};