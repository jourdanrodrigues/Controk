﻿$(document).ready(function(){
	$(".mainForm").submit(function(){
		manageAJAX();
		return false;
	});
	$(".logOut span").click(function(){
		loadFile("js/AJAX/Sessao.js");
		logOut();
	});
})
function manageAJAX(){
	var acao=$("input.acao").val(), alvo=$("input.alvo").val();
	switch(alvo){
		case 'cliente':
			loadFile("js/AJAX/Cliente.js");
			switch(acao){
				case 'cadastrar': cadastrarCliente(); break;
				case 'buscarDados': buscarDadosCliente(); break;
				case 'atualizar': atualizarCliente(); break;
				case 'excluir': excluirCliente(); break;
			}
			break;
		case 'funcionario':
			loadFile("js/AJAX/Funcionario.js");
			switch(acao){
				case 'cadastrar': cadastrarFuncionario(); break;
				case 'buscarDados': buscarDadosFuncionario(); break;
				case 'atualizar': atualizarFuncionario(); break;
				case 'excluir': excluirFuncionario(); break;
			}
			break;
		case 'fornecedor':
			loadFile("js/AJAX/Fornecedor.js");
			switch(acao){
				case 'cadastrar': cadastrarFornecedor(); break;
				case 'buscarDados': buscarDadosFornecedor(); break;
				case 'atualizar': atualizarFornecedor(); break;
				case 'excluir': excluirFornecedor(); break;
			}
			break;
		case 'produto':
			loadFile("js/AJAX/Produto.js");
			switch(acao){
				case 'cadastrar': cadastrarProduto(); break;
				case 'buscarDados': buscarDadosProduto(); break;
				case 'atualizar': atualizarProduto(); break;
			}
			break;
		case 'remessa':
			loadFile("js/AJAX/Remessa.js");
			switch(acao){
				case 'cadastrar': cadastrarRemessa(); break;
			}
			break;
	}
}
function successCase(dados, btnText){
	$(".goBtn").html(btnText);
	swal({
		title:$(dados).filter(".retorno").html(),
		type:$(dados).filter(".retorno").attr("data-type"),
		html: true
	},function(){
		if($(dados).filter(".retorno").attr("data-type")!="error") limparCampos();
	});
}
function errorCase(textStatus, errorThrown, btnText, thisFunction){
	$(".goBtn").html(btnText);
	swal({
		title: "Ocorreu um erro!",
		text: "<p>Descrição do erro: \""+textStatus+" "+errorThrown+"\".</p><p>Gostaria de tentar novamente?</p>",
		type: "error",
		html: true,
		showCancelButton: true,
		confirmButtonText: "Sim, tente!",
		cancelButtonText: "Não, tudo bem.",
		closeOnConfirm: false
	},function(isConfirm){
		if(isConfirm) thisFunction.call();
		else limparCampos();
	});
}
function limparCampos(){
	$(".resetBtn").click();
	$('.direita').css('display','none').find('input,textarea').removeAttr('required');
}
function loadFile(url){
	if($("script[src='"+url+"']").length==0) $("head").append("<script src='"+url+"'></script>");
}