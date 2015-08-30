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
			successCase(dados);
		},
		error: function(jqXHR, textStatus, errorThrown){
			errorCase(textStatus, errorThrown, cadastrarFuncionario);
		}
	});
}
function buscarDadosFuncionario(){
	$(".allBtn").html("Aguarde...");
	$.ajax({
		data: {
			alvo: $("input.alvo").val(),
			idFuncionario: $("#idFuncionario").val()
		},
		type: "POST",
		url: "php/actions/buscarDados.php",
		success: function(dados){
			returnType=$(dados).filter(".retorno").attr("data-type");
			if(returnType=="error"||returnType=="success"){
				successCase(dados);
				return;
			}
			$('.funcionario h3').html('Atualização de Funcionário');
			$("#idFuncionario").val($(dados).filter(".idFuncionario").val()).attr('readonly','readonly').addClass('readonly');
			$("#nomeFuncionario").val($(dados).filter(".nome").val());
			$("#cpfFuncionario").val($(dados).filter(".cpf").val());
			$("#obsFuncionario").val($(dados).filter(".obs").val());
			$("#cargo").val($(dados).filter(".cargo").val());
			$("#email").val($(dados).filter(".email").val());
			$("#telFixo").val($(dados).filter(".telFixo").val());
			$("#telCel").val($(dados).filter(".telCel").val());
			$("#rua").val($(dados).filter(".rua").val());
			$("#numero").val($(dados).filter(".numero").val());
			$("#complemento").val($(dados).filter(".complemento").val());
			$("#cep").val($(dados).filter(".cep").val());
			$("#bairro").val($(dados).filter(".bairro").val());
			$("#cidade").val($(dados).filter(".cidade").val());
			$("#estado").val($(dados).filter(".estado").val());
			$(".allBtn").html("Atualizar").val("atualizar");
			$("input.alvo").val("funcionario");
			$("input.acao").val("atualizar");
			escondeTudo();
			$('.funcionario,.contato,.endereco').css('display','block').find('input,textarea').attr('required',true);
			$('.funcionario p').css('display','block').find('input,textarea').attr('required',true);
		},
		error: function(jqXHR, textStatus, errorThrown){
			errorCase(textStatus, errorThrown, buscarDadosFuncionario);
		}
	})
}
function atualizarFuncionario(){
	$(".allBtn").html("Aguarde...");
	$.ajax({
		type: "POST",
		data: {
			alvo: $("input.alvo").val(),
			idFuncionario: $("#idFuncionario").val(),
			nomeFuncionario: $("#nomeFuncionario").val(),
			cpfFuncionario: $("#cpfFuncionario").val(),
			obsFuncionario: $("#obsFuncionario").val(),
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
		url: "php/actions/atualizar.php",
		success: function(dados){
			successCase(dados);
		},
		error: function(jqXHR, textStatus, errorThrown){
			errorCase(textStatus, errorThrown, atualizarFuncionario);
		}
	});
}
function excluirFuncionario(){
	var btnText = $(".allBtn").html();
	$(".allBtn").html("Aguarde...");
	$.ajax({
		type:"POST",
		data:{
			alvo: $("input.alvo").val(),
			idFuncionario: $("#idFuncionario").val()
		},
		url: "php/actions/excluir.php",
		success: function(dados){
			successCase(dados);
		},
		error: function(jqXHR, textStatus, errorThrown){
			errorCase(textStatus, errorThrown, excluirFuncionario);
		}
	});
}