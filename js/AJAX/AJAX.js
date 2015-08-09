var tentarNovamente="Gostaria de tentar novamente?";
function execute(){
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
}
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
			if(confirm("Ocorreu um problema:\n\n"+textStatus+" "+errorThrown+"\n\n"+tentarNovamente)){
				cadastrarCliente();
			}
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