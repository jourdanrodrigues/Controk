var count=0;
$(document).ready(function(){
	$(".mainForm").submit(function(e){
		e.preventDefault();
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
	var
		acao=$("input.acao").val(),
		alvo=$("input.alvo").val();
	switch(alvo){
		case 'cliente':
			loadFile("js/AJAX/Cliente.js");
			switch(acao){
				case 'cadastrar': cadastrarCliente(); break;
				case 'buscarDados': buscarDadosCliente(); break;
				case 'excluir': excluirCliente(); break;
			}
			break;
	}
}
function limparCampos(){
	$("input,textarea").val("");
	$("#obsCliente,#obsFuncionario").val("S. Obs.");
	$("#complemento").val("S. Comp.");
}
function successCase(dados){
	swal({
		title:$(dados).filter(".retorno").html(),
		type:$(dados).filter(".retorno").attr("data-type")
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
function loadFile(url){
	if($("script[src='"+url+"']").length==0) $("head").append("<script src='"+url+"'></script>");
}