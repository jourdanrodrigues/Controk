function Produto(){
    this.cadastrar=function(){
        var btnText=$(".goBtn").html();
        $(".goBtn").html("Aguarde...");
        $.ajax({
            type: "POST",
            data: {
                alvo: $("input.alvo").val(),
                idRemessa: $(".idRemessa").val(),
                nome: $(".nome").val(),
                descricao: $(".descricao").val(),
                custo: $(".custo").val(),
                valorVenda: $(".valorVenda").val()
            },
            url: "php/actions/cadastrar.php",
            success: function(data){successCase(data, btnText);},
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
                    content("produto","Atualização");
                    $(".idProduto").val(obj.idProduto);
                    $(".idRemessa").val(obj.idRemessa);
                    $(".nome").val(obj.nome);
                    $(".descricao").val(obj.descricao);
                    $(".custo").val(obj.custo);
                    $(".valorVenda").val(obj.valorVenda);
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
                idRemessa: $(".idRemessa").val(),
                nome: $(".nome").val(),
                descricao: $(".descricao").val(),
                custo: $(".custo").val(),
                valorVenda: $(".valorVenda").val()
            },
            url: "php/actions/atualizar.php",
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