function cadastrarFuncionario(){
	$(".allBtn").html("Aguarde...");
	$.ajax({
		type: "POST",
		data: {
			alvo: $("input.alvo").val(),
			nome: $("#nomeFuncionario").val(),
			cpf: $("#cpfFuncionario").val(),
			obs: $("#obsFuncionario").val(),
			cargo: $("#cargo").val(),
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
		url: "php/actions/cadastrar.php",
		success: function(dados){
			alert(dados);
			//successCase(dados);
		},
		error: function(jqXHR, textStatus, errorThrown){
			errorCase(textStatus, errorThrown, cadastrarFuncionario);
		}
	});
}