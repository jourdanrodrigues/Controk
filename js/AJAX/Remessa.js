function cadastrarRemessa(){
	var btnText=$(".goBtn").html();
	$(".goBtn").html("Aguarde...");
	$.ajax({
		type: "POST",
		data: {
			alvo: $("input.alvo").val(),
			idProdutoRem: $(".idProdutoRem").val(),
			qtdProdRem: $(".qtdProdRem").val(),
			idFornecedorRem: $(".idFornecedorRem").val(),
			dataPedido: $(".dataPedido").val(),
			dataPagamento: $(".dataPagamento").val(),
			dataEntrega: $(".dataEntrega").val()
		},
		url: "php/actions/cadastrar.php",
		success: function(dados){
			$(".goBtn").html(btnText);
			swal({
				title:$(dados).filter(".retorno").html(),
				type:$(dados).filter(".retorno").attr("data-type"),
				html: true,
				closeOnConfirm: false
			},function(){
				if($(dados).filter(".retorno").attr("data-type")=="error") swal.close();
				else{
					swal({
						title:"O produto será inserido no estoque.",
						type:"info",
						showCancelButton: true,
						confirmButtonText: "Ok",
						cancelButtonText: "Cancelar",
						closeOnConfirm: false,
						showLoaderOnConfirm: true
					},function(isConfirm){
						if(isConfirm){
							$.ajax({
								type: "POST",
								data: {
									alvo: "estoque",
									idProdutoEstq: $(".idProdutoRem").val(),
									qtdProdEstq: $(".qtdProdRem").val(),
								},
								url: "php/actions/inserir.php",
								success: function(dados){
									successCase(dados, btnText);
								},
								error: function(jqXHR, textStatus, errorThrown){
									errorCase(textStatus, errorThrown, btnText, cadastrarRemessa);
								}
							})
						}else limparCampos();
					});
				}
			});
		},
		error: function(jqXHR, textStatus, errorThrown){
			errorCase(textStatus, errorThrown, btnText, cadastrarRemessa);
		}
	});
}