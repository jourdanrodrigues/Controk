$(document).ready(function(){
//Sub-itens
    var target=[
        ["Funcionario","funcionario"],//0
        ["Cliente","cliente"],//1
        ["Fornecedor","fornecedor"],//2
        ["Remessa","remessa"],//3
        ["Produto","produto"],//4
        ["Estoque","estoque"]//5
    ];
    var action=[
        ["cadastrar","Cadastro"],//0
        ["buscarDados","Busca de dados"],//1
        ["excluir","Exclusão"],//2
        ["inserir","Inserir"],//3
        ["retirar","Retirar"]//4
    ];
// Itens principais
    $(".nav"+target[0][0]).click(function(){ddMenu("nav"+target[0][0]);});
    $(".nav"+target[1][0]).click(function(){ddMenu("nav"+target[1][0]);});
    $(".nav"+target[2][0]).click(function(){ddMenu("nav"+target[2][0]);});
    $(".nav"+target[3][0]).click(function(){ddMenu("nav"+target[3][0]);});
    $(".nav"+target[4][0]).click(function(){ddMenu("nav"+target[4][0]);});
    $(".nav"+target[5][0]).click(function(){ddMenu("nav"+target[5][0]);});
    //Funcionário
    $(".nav"+target[0][0]+" ."+action[0][0]).click(function(){content(target[0][1],action[0][1]);});
    $(".nav"+target[0][0]+" ."+action[1][0]).click(function(){content(target[0][1],action[1][1]);});
    $(".nav"+target[0][0]+" ."+action[2][0]).click(function(){content(target[0][1],action[2][1]);});
    //Cliente
    $(".nav"+target[1][0]+" ."+action[0][0]).click(function(){content(target[1][1],action[0][1]);});
    $(".nav"+target[1][0]+" ."+action[1][0]).click(function(){content(target[1][1],action[1][1]);});
    $(".nav"+target[1][0]+" ."+action[2][0]).click(function(){content(target[1][1],action[2][1]);});
    //Fornecedor
    $(".nav"+target[2][0]+" ."+action[0][0]).click(function(){content(target[2][1],action[0][1]);});
    $(".nav"+target[2][0]+" ."+action[1][0]).click(function(){content(target[2][1],action[1][1]);});
    $(".nav"+target[2][0]+" ."+action[2][0]).click(function(){content(target[2][1],action[2][1]);});
    //Remessa
    $(".nav"+target[3][0]+" ."+action[0][0]).click(function(){content(target[3][1],action[0][1]);});
    //Produto
    $(".nav"+target[4][0]+" ."+action[0][0]).click(function(){content(target[4][1],action[0][1]);});
    $(".nav"+target[4][0]+" ."+action[1][0]).click(function(){content(target[4][1],action[1][1]);});
    //Estoque
    $(".nav"+target[5][0]+" ."+action[3][0]).click(function(){content(target[5][1],action[3][1]);});
    $(".nav"+target[5][0]+" ."+action[4][0]).click(function(){content(target[5][1],action[4][1]);});
});
function ddMenu(item){
    if($("."+item+" ul").css("display")==="block") $("."+item+" ul").css("display","none");
    else $("."+item+" ul").css("display","block");
}