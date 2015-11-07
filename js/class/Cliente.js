function Cliente(){
    this.cadastrar=function(){
        var btnText=$(".goBtn").html();
        $(".goBtn").html("Aguarde...");
        $.ajax({
            type: "POST",
            data: {
                alvo: $("input.alvo").val(),
                nome: $(".nome").val(),
                cpf: $(".cpf").val(),
                obs: $(".obs").val(),
                email: $(".email").val(),
                telCel: $(".telCel").val(),
                telFixo: $(".telFixo").val(),
                rua: $(".rua").val(),
                numero: $(".numero").val(),
                complemento: $(".complemento").val(),
                cep: $(".cep").val(),
                bairro: $(".bairro").val(),
                cidade: $(".cidade").val(),
                estado: $(".estado").val()
            },
            url: "php/actions/cadastrar.php",
            success: function(data){successCase(data,btnText);},
            error: function(jqXHR,textStatus,errorThrown){errorCase(textStatus,errorThrown,btnText,this.cadastrar);}
        });
    };
    this.buscarDados=function(){
        var btnText=$(".goBtn").html();
        $(".goBtn").html("Aguarde...");
        $.ajax({
            data: {
                alvo: $("input.alvo").val(),
                id: $(".id").val()
            },
            type: "POST",
            url: "php/actions/buscarDados.php",
            success: function(data){
                var obj=JSON.parse(data);
                if(obj.type==="error"||obj.type==="success") successCase(data,btnText);
                else{
                    content("cliente","Atualização");
                    $(".id").val(obj.id);
                    $(".nome").val(obj.nome);
                    $(".cpf").val(obj.cpf);
                    $(".obs").val(obj.obs);
                    $(".email").val(obj.email);
                    $(".telFixo").val(obj.telFixo);
                    $(".telCel").val(obj.telCel);
                    $(".rua").val(obj.rua);
                    $(".numero").val(obj.numero);
                    $(".complemento").val(obj.complemento);
                    $(".cep").val(obj.cep);
                    $(".bairro").val(obj.bairro);
                    $(".cidade").val(obj.cidade);
                    $(".estado").val(obj.estado);
                }
            },
            error: function(jqXHR,textStatus,errorThrown){errorCase(textStatus,errorThrown,btnText,this.buscarDados);}
        });
    };
    this.atualizar=function(){
        var btnText=$(".goBtn").html();
        $(".goBtn").html("Aguarde...");
        $.ajax({
            type: "POST",
            data: {
                alvo: $("input.alvo").val(),
                id: $(".id").val(),
                nome: $(".nome").val(),
                cpf: $(".cpf").val(),
                obs: $(".obs").val(),
                email: $(".email").val(),
                telCel: $(".telCel").val(),
                telFixo: $(".telFixo").val(),
                rua: $(".rua").val(),
                numero: $(".numero").val(),
                complemento: $(".complemento").val(),
                cep: $(".cep").val(),
                bairro: $(".bairro").val(),
                cidade: $(".cidade").val(),
                estado: $(".estado").val()
            },
            url: "php/actions/atualizar.php",
            success: function(data){successCase(data,btnText);},
            error: function(jqXHR,textStatus,errorThrown){errorCase(textStatus,errorThrown,btnText,this.atualizar);}
        });
    };
    this.excluir=function(){
        var btnText=$(".goBtn").html();
        $(".goBtn").html("Aguarde...");
        $.ajax({
            type:"POST",
            data:{
                alvo: $("input.alvo").val(),
                id: $(".id").val()
            },
            url: "php/actions/excluir.php",
            success: function(data){successCase(data,btnText);},
            error: function(jqXHR,textStatus,errorThrown){errorCase(textStatus,errorThrown,btnText,this.excluir);}
        });
    };
    this.genFields=function(action){
        var container="";
        switch(action){
            case "Atualização": container+=generateField({id:"Cliente",type:"number",field:"id",lblContent:"ID do Cliente",readonly:1,classes:["readonly"]});
            case "Cadastro": container+=generateField({field:"nome",lblContent:"Nome"})+
            generateField({field:"cpf",lblContent:"CPF"})+
            generateField({field:"obs",lblContent:"Observação",value:"S. Obs."}); break;
            case "Busca de dados":
            case "Exclusão": container+=generateField({id:"Cliente",type:"number",field:"id",lblContent:"ID do Cliente"});
        }
        return container;
    };
}