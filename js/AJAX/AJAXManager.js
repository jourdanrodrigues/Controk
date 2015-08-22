var count=0;
$(document).ready(function(){
	$(".mainForm").submit(function(e){
		e.preventDefault();
	});
	$(".logOut span").click(function(){
		include_once("js/AJAX/Sessao.js");
		logOut();
	});
	$(".logIn").submit(function(){
		include_once("js/AJAX/Sessao.js");
		logIn();
		return false;
	});
})
function manageAJAX(){
	var
		acao = $("input.acao").val(),
		alvo = $("input.alvo").val();
	switch(alvo){
		case 'cliente':
			include_once("js/AJAX/Cliente.js");
			switch(acao){
				case 'cadastrar': cadastrarCliente(); break;
			}
			break;
	}
}
function limparCampos(){
	$("input,textarea").val("");
	$("#obsCliente,#obsFuncionario").val("S. Obs.");
	$("#complemento").val("S. Comp.");
}
function include_once(url){
	if($("script[src='"+url+"']").length==0){
		$("head").append("<script src='"+url+"'></script>");
	}
}