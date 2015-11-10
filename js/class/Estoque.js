function Estoque(){}
Estoque.prototype={
    constructor:Estoque,
    inserir:function(){
        var btnText=$(".goBtn").html();
        $(".goBtn").html("Aguarde...");
        $.ajax({
            type: "POST",
            data: {
                target: "estoque",
                action: "inserir",
                idProduto: $(".idProduto").val(),
                qtdProd: $(".qtdProd").val()
            },
            url: "php/manager.php",
            success: function(data){successCase(data,btnText);},
            error: function(jqXHR,textStatus,errorThrown){errorCase(textStatus,errorThrown,btnText,this.cadastrar);}
        });
    },
    genFields:function(action){
        var container="";
        switch(action){
            case "Retirar": container+=generateField({id:"FuncEstq",type:"number",field:"idFuncionario",lblContent:"ID do funcionário"})+
            generateField({id:"DataSaida",field:"dataSaida",lblContent:"Data Saída"});
            case "Inserir": container+=generateField({field:"idProduto",type:"number",lblContent:"ID do produto"})+
            generateField({field:"qtdProd",type:"number",lblContent:"Quantidade do produto (un.)"});
        }
        return container;
    },
    retirar:function(){
        var btnText=$(".goBtn").html();
        $(".goBtn").html("Aguarde...");
        $.ajax({
            type: "POST",
            data: {
                target: "estoque",
                action: "retirar",
                idProduto: $(".idProduto").val(),
                idFuncionario: $(".idFuncionario").val(),
                dataSaida: $(".dataSaida").val(),
                qtdProd: $(".qtdProd").val()
            },
            url: "php/manager.php",
            success: function(data){successCase(data,btnText);},
            error: function(jqXHR,textStatus,errorThrown){errorCase(textStatus,errorThrown,btnText,this.cadastrar);}
        });
    }
};