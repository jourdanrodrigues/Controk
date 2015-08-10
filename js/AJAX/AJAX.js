$(document).ready(function(){
	$(".x").click(function(){
		$(".mensagem").bPopup().close();
	});
	$("#mainForm").submit(function(e){
		e.preventDefault();
		var
			acao = $("input[name='acao']").val(),
			alvo = $("input[name='alvo']").val();
		switch(acao){
			case 'cadastrar':
				switch(alvo){
					case 'cliente': cadastrarCliente(); break;
				}
				break;
		}
	});
});
var tentarNovamente="Gostaria de tentar novamente?";
function cadastrarCliente(){
	$.ajax({
		type: "POST",
		data: {alvo: $("input[name='alvo']").val(),
			idCliente: $("#idCliente").val(),
			nome: $("#nomeCliente").val(),
			cpf: $("#cpfCliente").val(),
			obs: $("#obsCliente").val(),
			email: $("#email").val(),
			telCel: $("#telCel").val(),
			telFixo: $("#telFixo").val(),
			rua: $("#rua").val(),
			numero: $("#numero").val(),
			complemento: $("#complemento").val(),
			cep: $("#cep").val(),
			bairro: $("#bairro").val(),
			cidade: $("#cidade").val(),
			estado: $("#estado").val()
		},
		url: "php/actions/cadastrar.ph",
		success: function(dados){
			retornoCadastro(dados);
		},
		error: function(jqXHR, textStatus, errorThrown){
			$(".mensagem .titulo").css("background","#f33").html("Ocorreu um problema");
			$(".mensagem p:first").html("<p>Descrição do erro: \""+textStatus+" "+errorThrown+"\"</p><p>"+tentarNovamente+"</p>");
			$("button.ok").css("display","none");
			$("button.tentarNovamente").css("display","block").click(function(){
				$(".mensagem").bPopup().close();
				cadastrarCliente();
			});
			$("button.cancelar").css("display","block").click(function(){
				$(".mensagem").bPopup().close();
			});
			$(".mensagem").bPopup();
		}
	});
}
function retornoCadastro(dados){
	alert($(dados).filter(".retorno").html());
}
function limparCampos(){
	$("input,textarea").val("");
	$("#obsCliente,#obsFuncionario").val("S. Obs.");
	$("#complemento").val("S. Comp.");
}