function Produto(){
    this.data=function(action){
        switch(action){
            case "cadastrar":
            case "atualizar": var data={
                    target: $("input.alvo").val(),
                    action: action,
                    id: $(".id").val(),
                    idRemessa: $(".idRemessa").val(),
                    nome: $(".nome").val(),
                    descricao: $(".descricao").val(),
                    custo: format($(".custo").val(),"money"),
                    valorVenda: format($(".valorVenda").val(),"money")
                }; break;
            case "buscarDados": var data={
                    target: $("input.alvo").val(),
                    action: action,
                    id: $(".id").val()
                }; break;
        }
        return data;
    };
    this.cadastrar=function(){
        var btnText=$(".goBtn").html();
        $(".goBtn").html("Aguarde...");
        $.ajax({
            type:"POST",
            data:this.data("cadastrar"),
            url:"php/manager.php",
            success: function(data){successCase(data, btnText);},
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
                if(obj.type==="error"||obj.type==="success") successCase(data,btnText);
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
            success: function(data){successCase(data, btnText);},
            error: function(jqXHR,textStatus,errorThrown){errorCase(textStatus,errorThrown,btnText,this.atualizar);}
        });
    };
    this.genFields=function(action){
        var container="";
        switch(action){
            case "Atualização": container+=generateField({id:"Produto",type:"number",field:"id",lblContent:"ID do Produto",readonly:1,classes:["readonly"]});
            case "Cadastro": container+=generateField({field:"idRemessa",type:"number",lblContent:"ID da remessa"})+
            generateField({field:"nome",lblContent:"Nome do produto"})+
            generateField({field:"descricao",fieldTag:"textarea",lblContent:"Descrição do produto"})+
            generateField({field:"custo",lblContent:"Custo do produto"})+
            generateField({field:"valorVenda",lblContent:"Valor de venda do produto"}); break;
            case "Busca de dados": container+=generateField({id:"Produto",type:"number",field:"id",lblContent:"ID do Produto"});
        }
        return container;
    };
}