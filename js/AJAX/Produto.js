function cadastrarProduto(){
	var btnText=$(".goBtn").html();
	$(".goBtn").html("Aguarde...");
	$.ajax({
		type: "POST",
		data: {
			alvo: $("input.alvo").val(),
			idRemessa: $(".idRemessa").val(),
			nomeProd: $(".nomeProd").val(),
			descrProd: $(".descrProd").val(),
			custoProd: $(".custoProd").val(),
			valorVenda: $(".valorVenda").val()
		},
		url: "php/actions/cadastrar.php",
		success: function(dados){
			successCase(dados, btnText);
		},
		error: function(jqXHR, textStatus, errorThrown){
			errorCase(textStatus, errorThrown, btnText, cadastrarProduto);
		}
	});
}
function buscarDadosProduto(){
	var btnText=$(".goBtn").html();
	$(".goBtn").html("Aguarde...");
	$.ajax({
		data: {
			alvo: $("input.alvo").val(),
			idProduto: $(".idProduto").val()
		},
		type: "POST",
		url: "php/actions/buscarDados.php",
		success: function(dados){
			returnType=$(dados).filter(".retorno").attr("data-type");
			if(returnType=="error"||returnType=="success"){
				successCase(dados, btnText);
				return;
			}
			$('.produto h3').html('Atualização de Produto');
			$(".idProduto").val($(dados).filter(".idProduto").val()).attr('readonly','readonly').addClass('readonly'),
			$(".idRemessa").val($(dados).filter(".idRemessa").val()),
			$(".nomeProd").val($(dados).filter(".nomeProd").val()),
			$(".descrProd").val($(dados).filter(".descrProd").val()),
			$(".custoProd").val($(dados).filter(".custoProd").val()),
			$(".valorVenda").val($(dados).filter(".valorVenda").val()),
			$(".goBtn").html("Atualizar").val("atualizar");
			$("input.alvo").val("produto");
			$("input.acao").val("atualizar");
			escondeTudo();
			$('.produto').css('display','block').find('input,textarea').attr('required',true);
			$('.produto p').css('display','block').find('input,textarea').attr('required',true);
		},
		error: function(jqXHR, textStatus, errorThrown){
			errorCase(textStatus, errorThrown, btnText, buscarDadosProduto);
		}
	})
}
function atualizarProduto(){
	var btnText=$(".goBtn").html();
	$(".goBtn").html("Aguarde...");
	$.ajax({
		type: "POST",
		data: {
			alvo: $("input.alvo").val(),
			idProduto: $(".idProduto").val(),
			idRemessa: $(".idRemessa").val(),
			nomeProd: $(".nomeProd").val(),
			descrProd: $(".descrProd").val(),
			custoProd: $(".custoProd").val(),
			valorVenda: $(".valorVenda").val()
		},
		url: "php/actions/atualizar.php",
		success: function(dados){
			successCase(dados, btnText);
		},
		error: function(jqXHR, textStatus, errorThrown){
			errorCase(textStatus, errorThrown, btnText, atualizarProduto);
		}
	});
}