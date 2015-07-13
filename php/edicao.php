<?php
	if(isset($_POST)){
		if(isset($_POST['idFornecedor'])||isset($_POST['idCliente'])||isset($_POST['idFuncionario'])){
			$rua=$_POST['rua'];
			$numero=$_POST['numero'];
			$complemento=$_POST['compl'];
			$cep=$_POST['cep'];
			$bairro=$_POST['bairro'];
			$cidade=$_POST['cidade'];
			$estado=$_POST['estado'];
			$email=$_POST['email'];
			$telCel=$_POST['telCel'];
			$telFixo=$_POST['telFixo'];
			echo "<script>
			$(document).ready(function (){
			$('input[name=\"acao\"]').val('atualizar');
			$('button').html('Atualizar');
			$('#email').val('".$email."');
			$('#telFixo').val('".$telFixo."');
			$('#telCel').val('".$telCel."');
			$('#rua').val('".$rua."');
			$('#numero').val('".$numero."');
			$('#compl').val('".$complemento."');
			$('#cep').val('".$cep."');
			$('#bairro').val('".$bairro."');
			$('#cidade').val('".$cidade."');
			$('#estado').val('".$estado."');
			";
			if(isset($_POST['idFuncionario'])){
				$idFuncionario=$_POST['idFuncionario'];
				$nomeFunc=$_POST['nomeFunc'];
				$cpf=$_POST['cpf'];
				$cargo=$_POST['cargo'];
				$obs=$_POST['obs'];
				echo "
				$('#funcionario h3').html('Atualização de Funcionario');
				$('input[name=\"alvo\"]').val('funcionario');
				$('#idFuncionario').val('".$idFuncionario."').attr('readonly','readonly').addClass('readonly');
				$('#nomeFunc').val('".$nomeFunc."');
				$('#cpfFuncionario').val('".$cpf."');
				$('#cargo').val('".$cargo."');
				$('#obsFuncionario').val('".$obs."');
				escondeTudo();
				$('#direita').css('display','block');
				$('#funcionario,#contato,#endereco').css('display','block').find('input,textarea').attr('required',true);
				$('#funcionario p').css('display','block').find('input,textarea').attr('required',true);
				});
				</script>";
			}elseif(isset($_POST['idCliente'])){
				$idCliente=$_POST['idCliente'];
				$nomeCliente=$_POST['nomeCliente'];
				$cpf=$_POST['cpf'];
				$obs=$_POST['obs'];
				echo "
				$('#cliente h3').html('Atualização de Cliente');
				$('input[name=\"alvo\"]').val('cliente');
				$('#idCliente').val('".$idCliente."').attr('readonly','readonly').addClass('readonly');
				$('#nomeCliente').val('".$nomeCliente."');
				$('#cpfCliente').val('".$cpf."');
				$('#obsCliente').val('".$obs."');
				escondeTudo();
				$('#direita').css('display','block');
				$('#cliente,#contato,#endereco').css('display','block').find('input,textarea').attr('required',true);
				$('#cliente p').css('display','block').find('input,textarea').attr('required',true);
				});
				</script>";
			}elseif(isset($_POST['idFornecedor'])){
				$idFornecedor=$_POST['idFornecedor'];
				$nomeFantasia=$_POST['nomeFantasia'];
				$cnpj=$_POST['cnpj'];
				echo "
				$('#fornecedor h3').html('Atualização de Fornecedor');
				$('input[name=\"alvo\"]').val('fornecedor');
				$('#idFornecedor').val('".$idFornecedor."').attr('readonly','readonly').addClass('readonly');
				$('#nomeFantasia').val('".$nomeFantasia."');
				$('#cnpj').val('".$cnpj."');
				escondeTudo();
				$('#direita').css('display','block');
				$('#fornecedor,#contato,#endereco').css('display','block').find('input,textarea').attr('required',true);
				$('#fornecedor p').css('display','block').find('input,textarea').attr('required',true);
				});
				</script>";
			}
		}elseif(isset($_POST['idProduto'])){
			$idProduto=$_POST['idProduto'];
			$nomeProd=$_POST['nomeProd'];
			$idRemessa=$_POST['idRemessa'];
			$descrProd=$_POST['descrProd'];
			$custoProd=$_POST['custoProd'];
			$valorVenda=$_POST['valorVenda'];
			echo "<script>
			$(document).ready(function (){
			$('input[name=\"acao\"]').val('atualizar');
			$('input[name=\"alvo\"]').val('produto');
			$('button').html('Atualizar');
			$('#idProduto').val('".$idProduto."').attr('readonly','readonly').addClass('readonly');
			$('#idRemessa').val('".$idRemessa."');
			$('#nomeProd').val('".$nomeProd."');
			$('#descrProd').val('".$descrProd."');
			$('#custoProd').val('".$custoProd."');
			$('#valorVenda').val('".$valorVenda."');
			escondeTudo();
			$('#direita').css('display','block');
			$('#produto').css('display','block').find('input,textarea').attr('required',true);
			$('#produto p').css('display','block').find('input,textarea').attr('required',true);
			});
			</script>";
		}
	}
?>