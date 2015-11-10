function Fornecedor(){
    this.data=function(action){
        switch(action){
            case "cadastrar":
            case "atualizar": var data={
                    target: $("input.alvo").val(),
                    action: action,
                    id: $(".id").val(),
                    nome: $(".nome").val(),
                    cnpj: format($(".cnpj").val(),"cnpj"),
                    email: $(".email").val().toLowerCase(),
                    telCel: format($(".telCel").val(),"telCel"),
                    telFixo: format($(".telFixo").val(),"telFixo"),
                    rua: $(".rua").val(),
                    numero: $(".numero").val(),
                    complemento: $(".complemento").val(),
                    cep: format($(".cep").val(),"cep"),
                    bairro: $(".bairro").val(),
                    cidade: $(".cidade").val(),
                    estado: $(".estado").val()
                }; break;
            case "excluir":
            case "buscarDados": var data={
                    target: $("input.alvo").val(),
                    action: action,
                    id: $(".id").val()
                }; break;
        }
        return data;
    };
    this.cadastrar=﻿function(){
        var btnText=$(".goBtn").html();
        $(".goBtn").html("Aguarde...");
        $.ajax({
            type:"POST",
            data:this.data("cadastrar"),
            url:"php/manager.php",
            success: function(data){successCase(data,btnText);},
            error: function(jqXHR,textStatus,errorThrown){errorCase(textStatus,errorThrown,btnText,this.cadastrar);}
        });
    };
    this.buscarDados=function(){
        var btnText=$(".goBtn").html();
        $(".goBtn").html("Aguarde...");
        $.ajax({
            data:this.data("buscarDados"),
            type: "POST",
            url: "php/manager.php",
            success: function(data){
                var obj=JSON.parse(data);
                if(obj.type==="error"||obj.type==="success") successCase(data, btnText);
                else{
                    content("fornecedor","Atualização");
                    $(".id").val(obj.id);
                    $(".nome").val(obj.nome);
                    $(".cnpj").val(format(obj.cnpj,"cnpj",0));
                    $(".email").val(obj.email);
                    $(".telFixo").val(format(obj.telFixo,"telFixo"));
                    $(".telCel").val(format(obj.telCel,"telCel"));
                    $(".cep").val(format(obj.cep,"cep"));
                    $(".rua").val(obj.rua);
                    $(".numero").val(obj.numero);
                    $(".complemento").val(obj.complemento);
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
            type:"POST",
            data:this.data("atualizar"),
            url:"php/manager.php",
            success: function(data){successCase(data,btnText);},
            error: function(jqXHR,textStatus,errorThrown){errorCase(textStatus,errorThrown,btnText,this.atualizar);}
        });
    };
    this.excluir=function(){
        var btnText=$(".goBtn").html();
        $(".goBtn").html("Aguarde...");
        $.ajax({
            type:"POST",
            data:this.data("excluir"),
            url:"php/manager.php",
            success: function(data){successCase(data,btnText);},
            error: function(jqXHR,textStatus,errorThrown){errorCase(textStatus,errorThrown,btnText,this.excluir);}
        });
    };
    this.genFields=function(action){
        var container="";
        switch(action){
            case "Atualização": container+=generateField({id:"Fornecedor",field:"id",type:"number",lblContent:"ID do Fornecedor",readonly:1,classes:["readonly"]});
            case "Cadastro": container+=generateField({field:"nome",lblContent:"Nome Fantasia"})+
            generateField({field:"cnpj",lblContent:"CNPJ"}); break;
            case "Busca de dados":
            case "Exclusão": container+=generateField({id:"Fornecedor",type:"number",field:"id",lblContent:"ID do Fornecedor"});
        }
        return container;
    };
}