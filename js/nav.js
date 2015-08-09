$(document).ready(function(){
// Itens principais
	$(".navFuncionario").click(function(){
		opcoes("navFuncionario");
	});
	$(".navCliente").click(function(){
		opcoes("navCliente");
	});
	$(".navFornecedor").click(function(){
		opcoes("navFornecedor");
	});
	$(".navRemessa").click(function(){
		opcoes("navRemessa");
	});
	$(".navProduto").click(function(){
		opcoes("navProduto");
	});
	$(".navEstoque").click(function(){
		opcoes("navEstoque");
	});
//Sub-itens
	var alvo=[
		["Funcionario","funcionario"],//0
		["Cliente","cliente"],//1
		["Fornecedor","fornecedor"],//2
		["Remessa","remessa"],//3
		["Produto","produto"],//4
		["Estoque","estoque"]//5
	];
	var acao=[
		["cadastrar","Cadastro"],//0
		["buscarDados","Busca de Dados"],//1
		["excluir","Exclusão"],//2
		["inserir","Inserir"],//3
		["retirar","Retirar"]//4
	];
	//Funcionário
	$(".nav"+alvo[0][0]+" ."+acao[0][0]).click(function(){
		dbManage(alvo[0][1],acao[0][1]);
	});
	$(".nav"+alvo[0][0]+" ."+acao[1][0]).click(function(){
		dbManage(alvo[0][1],acao[1][1]);
	});
	$(".nav"+alvo[0][0]+" ."+acao[2][0]).click(function(){
		dbManage(alvo[0][1],acao[2][1]);
	});
	//Cliente
	$(".nav"+alvo[1][0]+" ."+acao[0][0]).click(function(){
		dbManage(alvo[1][1],acao[0][1]);
	});
	$(".nav"+alvo[1][0]+" ."+acao[1][0]).click(function(){
		dbManage(alvo[1][1],acao[1][1]);
	});
	$(".nav"+alvo[1][0]+" ."+acao[2][0]).click(function(){
		dbManage(alvo[1][1],acao[2][1]);
	});
	//Fornecedor
	$(".nav"+alvo[2][0]+" ."+acao[0][0]).click(function(){
		dbManage(alvo[2][1],acao[0][1]);
	});
	$(".nav"+alvo[2][0]+" ."+acao[1][0]).click(function(){
		dbManage(alvo[2][1],acao[1][1]);
	});
	$(".nav"+alvo[2][0]+" ."+acao[2][0]).click(function(){
		dbManage(alvo[2][1],acao[2][1]);
	});
	//Remessa
	$(".nav"+alvo[3][0]+" ."+acao[0][0]).click(function(){
		dbManage(alvo[3][1],acao[0][1]);
	});
	//Produto
	$(".nav"+alvo[4][0]+" ."+acao[0][0]).click(function(){
		dbManage(alvo[4][1],acao[0][1]);
	});
	$(".nav"+alvo[4][0]+" ."+acao[1][0]).click(function(){
		dbManage(alvo[4][1],acao[1][1]);
	});
	//Estoque
	$(".nav"+alvo[5][0]+" ."+acao[3][0]).click(function(){
		dbManage(alvo[5][1],acao[3][1]);
	});
	$(".nav"+alvo[5][0]+" ."+acao[4][0]).click(function(){
		dbManage(alvo[5][1],acao[4][1]);
	});
})