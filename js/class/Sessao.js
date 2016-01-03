function Sessao(){}
Sessao.prototype={
    constructor:Sessao,
    logOut:function(){
        $.ajax({
            url: "php/sessionManager.php",
            type: "post",
            data: {acaoSessao:"logout"},
            success:function(){
                swal({
                    title: "Logout efetuado com sucesso!",
                    timer: 2000,
                    type: "success"
                },function(){location.href="/trabalhos/gti/bda1/login.php";});
            },
            error:function(jqXHR,textStatus,errorThrown){
                var self=this;
                self.count=0;
                swal({
                    title: "Ocorreu um erro!",
                    text: "<p>Descrição: \""+textStatus+" "+errorThrown+"\".</p><p>Gostaria de tentar novamente?</p><p>"+(this.count+1)+"ª tentativa</p>",
                    type: "error",
                    html: true,
                    showCancelButton: true,
                    confirmButtonText: "Sim, tente!",
                    cancelButtonText: "Não, tudo bem.",
                    closeOnConfirm: false
                },function(){
                    if(self.count<5){
                        self.count++;
                        $(".logout").click();
                    }else{
                        swal({
                            title: "Falha no LogOut!",
                            text: "Recarregaremos a página para tentar resolver o problema.",
                            type: "error",
                            timer: 3000
                        },function(){location.reload();});
                    }
                });
            }
        });
    },
    logIn:function(){
        var btnText=$(".goBtn").html();
        $(".goBtn").html("Aguarde...");
        $.ajax({
            url: "php/sessionManager.php",
            type: "POST",
            data: {
                usuario: $(".usuario").val(),
                senha: $(".senha").val(),
                acaoSessao: $(".acaoSessao").val()
            },
            success: function(data){
                var obj=JSON.parse(data);
                if(obj.type==="redirect") location.href=obj.msg;
                else successCase(data,btnText);
            },
            error: function(jqXHR,textStatus,errorThrown){
                $(".goBtn").html(btnText);
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
                    if(isConfirm) $(".logIn").submit();
                    else{
                        $(".resetBtn").click();
                        $('.direita').css('display','none');
                    }
                });
            }
        });
    }
};