function cadastrarProduto(){
	$(".allBtn").html("Aguarde...");
	$.ajax({
		type: "POST",
		data: {
			alvo: $("input.alvo").val(),
			idRemessa: $("#idRemessa").val(),
			nomeProd: $("#nomeProd").val(),
			descrProd: $("#descrProd").val(),
			custoProd: $("#custoProd").val(),
			valorVenda: $("#valorVenda").val()
		},
		url: "php/actions/cadastrar.php",
		success: function(dados){
			successCase(dados);
		},
		error: function(jqXHR, textStatus, errorThrown){
			errorCase(textStatus, errorThrown, cadastrarProduto);
		}
	});
}
function buscarDadosProduto(){
	$(".allBtn").html("Aguarde...");
	$.ajax({
		data: {
			alvo: $("input.alvo").val(),
			idProduto: $("#idProduto").val()
		},
		type: "POST",
		url: "php/actions/buscarDados.php",
		success: function(dados){
			returnType=$(dados).filter(".retorno").attr("data-type");
			if(returnType=="error"||returnType=="success"){
				successCase(dados);
				return;
			}
			$('.produto h3').html('Atualização de Produto');
			$("#idProduto").val($(dados).filter(".idProduto").val()).attr('readonly','readonly').addClass('readonly'),
			$("#idRemessa").val($(dados).filter(".idRemessa").val()),
			$("#nomeProd").val($(dados).filter(".nomeProd").val()),
			$("#descrProd").val($(dados).filter(".descrProd").val()),
			$("#custoProd").val($(dados).filter(".custoProd").val()),
			$("#valorVenda").val($(dados).filter(".valorVenda").val()),
			$(".allBtn").html("Atualizar").val("atualizar");
			$("input.alvo").val("produto");
			$("input.acao").val("atualizar");
			escondeTudo();
			$('.produto').css('display','block').find('input,textarea').attr('required',true);
			$('.produto p').css('display','block').find('input,textarea').attr('required',true);
		},
		error: function(jqXHR, textStatus, errorThrown){
			errorCase(textStatus, errorThrown, buscarDadosProduto);
		}
	})
}
function atualizarProduto(){
	$(".allBtn").html("Aguarde...");
	$.ajax({
		type: "POST",
		data: {
			alvo: $("input.alvo").val(),
			idProduto: $("#idProduto").val(),
			idRemessa: $("#idRemessa").val(),
			nomeProd: $("#nomeProd").val(),
			descrProd: $("#descrProd").val(),
			custoProd: $("#custoProd").val(),
			valorVenda: $("#valorVenda").val()
		},
		url: "php/actions/atualizar.php",
		success: function(dados){
			successCase(dados);
		},
		error: function(jqXHR, textStatus, errorThrown){
			errorCase(textStatus, errorThrown, atualizarProduto);
		}
	});
}