var count=0;
function logOut(){
	$.ajax({
		url: "php/sessionManager.php",
		type: "POST",
		data: {acaoSessao:"logout"},
		success:function(dados){
			swal({
				title: $(dados).filter(".retorno").html(),
				timer: 2000,
				type: "success"
			},function(){
				location.href="/trabalhos/gti/bda1/login.php";
			});
		},
		error:function(jqXHR, textStatus, errorThrown){
			swal({
				title: "Ocorreu um erro!",
				text: "<p>Descrição: \""+textStatus+" "+errorThrown+"\".</p><p>Gostaria de tentar novamente?</p><p>"+(count+1)+"ª tentativa</p>",
				type: "error",
				html: true,
				showCancelButton: true,
				confirmButtonText: "Sim, tente!",
				cancelButtonText: "Não, tudo bem.",
				closeOnConfirm: false
			},function(){
				if((count+1)<5){
					count++;
					$(".logOut span").click();
				}else{
					count=0;
					swal({
						title: "Falha no LogOut!",
						text: "Recarregaremos a página para tentar resolver o problema.",
						type: "error",
						timer: 3000
					},function(){
						location.reload();
					});
				}
			});
		}
	});
}
function logIn(){
	var btnText = $(".logIn .allBtn").html();
	$(".logIn button").html("Aguarde...");
	$.ajax({
		url: "php/sessionManager.php",
		type: "POST",
		data: {
			usuario: $(".usuario").val(),
			senha: $(".senha").val(),
			acaoSessao: $(".acaoSessao").val()
		},
		success: function(dados){
			$(".logIn .allBtn").html(btnText);
			if($(dados).filter(".retorno").attr("data-type")=="redirect"){
				location.href=$(dados).filter(".retorno").html();
				return false;
			}
			swal({
				title: $(dados).filter(".retorno").html(),
				type: $(dados).filter(".retorno").attr("data-type")
			});
		},
		error: function(jqXHR, textStatus, errorThrown){
			$(".logIn .allBtn").html(btnText);
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
					$(".logIn").submit();
				}
			});
		}
	});
}