$(document).ready(function(){
	$(".mainForm").submit(function(){
		manageAJAX();
		return false;
	});
	$(".logOut span").click(function(){
		loadFile("js/AJAX/Sessao.js");
		logOut();
	});
	$(".logIn").submit(function(){
		loadFile("js/AJAX/Sessao.js");
		logIn();
		return false;
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
	}
}
function successCase(dados){
	swal({
		title:$(dados).filter(".retorno").html(),
		type:$(dados).filter(".retorno").attr("data-type"),
		html: true
	},function(){
		limparCampos();
	});
}
function errorCase(textStatus, errorThrown, thisFunction){
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
	$("input,textarea").val("");
	$("#obsCliente,#obsFuncionario").val("S. Obs.");
	$("#complemento").val("S. Comp.");
	$('.direita').css('display','none').find('input,textarea').removeAttr('required');
}
function loadFile(url){
	if($("script[src='"+url+"']").length==0) $("head").append("<script src='"+url+"'></script>");
}