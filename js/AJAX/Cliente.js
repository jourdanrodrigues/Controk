function cadastrarCliente(){
	$.ajax({
		type: "POST",
		data: {alvo: $("input.alvo").val(),
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
		url: "php/actions/cadastrar.php",
		success: function(dados){
			retornoOk(dados);
		},
		error: function(jqXHR, textStatus, errorThrown){
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
				if(isConfirm){
					cadastrarCliente();
				}else{
					limparCampos();
				}
			});
		}
	});
}
function retornoOk(dados){
	swal({
		title:"Operação concluída!",
		text:$(dados).filter(".retorno").html(),
		type:"success"
	},function(){
		limparCampos();
	});
}