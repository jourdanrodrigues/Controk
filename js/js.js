$(document).ready(function (){
	$('input#cpfFuncionario,input#cpfCliente').mask("999.999.999-99");
	$('input#cnpj').mask("99.999.999/9999-99");
	$('input#telFixo').mask("(99) 9999-9999");
	$('input#telCel').mask("(99) 9 9999-9999");
	$('input#cep').mask("99.999-999");
	$('.custoProd,.valorVenda').priceFormat({
		prefix: 'R$ ',
		centsSeparator: ',',
		thousandsSeparator: '.'
	});
	$('body').fadeTo(600, 1,'swing');
});
function opcoes(item){
	if($('.'+item+' ul').css('display')=='block') $('.'+item+' ul').css('display','none')
	else $('.'+item+' ul').css('display','block');
}
function escondeTudo(){
	$('.remessa,.produto,.fornecedor,.cliente,.funcionario,.estoque,.contato,.endereco').css('display','none').find('input,textarea').removeAttr('required');
}
function dbManage(item,proc){
	if($('.direita').css('display')=='none') $('.direita').css('display','block')
	switch(proc){
		case 'Cadastro':
			$('input.acao').val('cadastrar');
			$('.mainForm button').html('Cadastrar');
			break;
		case 'Busca de Dados':
			$('input.acao').val('buscarDados');
			$('.mainForm button').html('Buscar dados');
			break;
		case 'Exclusão':
			$('input.acao').val('excluir');
			$('.mainForm button').html('Excluir');
			break;
		case 'Inserir':
			$('input.acao').val('inserir');
			$('.mainForm button').html('Inserir');
			break;
		case 'Retirar':
			$('input.acao').val('retirar');
			$('.mainForm button').html('Retirar');
			break;
	}
	switch(item){
		case 'fornecedor':
			$('input.alvo').val('fornecedor');
			$('.fornecedor h3').html(proc+' de Fornecedor');
			switch(proc){
				case 'Cadastro':
					escondeTudo();
					$('.fornecedor,.contato,.endereco').css('display','block').find('input,textarea').attr('required',true);
					$('.fornecedor p').css('display','block').find('input,textarea').attr('required',true);
					$('.campoIdFornecedor').css('display','none').find('input').removeAttr('required');
					break;
				case 'Busca de Dados':
					escondeTudo();
					$('.fornecedor').css('display','block');
					$('.fornecedor p').css('display','none').find('input,textarea').removeAttr('required');
					$('.campoIdFornecedor').css('display','block').find('input').attr('required',true).removeAttr('readonly').removeClass('readonly');
					break;
				case 'Exclusão':
					escondeTudo();
					$('.fornecedor').css('display','block');
					$('.fornecedor p').css('display','none').find('input,textarea').removeAttr('required');
					$('.campoIdFornecedor').css('display','block').find('input').attr('required',true).removeAttr('readonly').removeClass('readonly');
					break;
			}
			break;
		case 'cliente':
			$('input.alvo').val('cliente');
			$('.cliente h3').html(proc+' de Cliente');
			switch(proc){
				case 'Cadastro':
					escondeTudo();
					$('.cliente,.contato,.endereco').css('display','block').find('input,textarea').attr('required',true);
					$('.cliente p').css('display','block').find('input,textarea').attr('required',true);
					$('.campoIdCliente').css('display','none').find('input').removeAttr('required');
					break;
				case 'Busca de Dados':
					escondeTudo();
					$('.cliente').css('display','block');
					$('.cliente p').css('display','none').find('input,textarea').removeAttr('required');
					$('.campoIdCliente').css('display','block').find('input').attr('required',true).removeAttr('readonly').removeClass('readonly');
					break;
				case 'Exclusão':
					escondeTudo();
					$('.cliente').css('display','block');
					$('.cliente p').css('display','none').find('input,textarea').removeAttr('required');
					$('.campoIdCliente').css('display','block').find('input').attr('required',true).removeAttr('readonly').removeClass('readonly');
					break;
			}
			break;
		case 'funcionario':
			$('input.alvo').val('funcionario');
			$('.funcionario h3').html(proc+' de Funcionário');
			switch(proc){
				case 'Cadastro':
					escondeTudo();
					$('.funcionario,.contato,.endereco').css('display','block').find('input,textarea').attr('required',true);
					$('.funcionario p').css('display','block').find('input,textarea').attr('required',true);
					$('.campoIdFuncionario').css('display','none').find('input').removeAttr('required');
					break;
				case 'Busca de Dados':
					escondeTudo();
					$('.funcionario').css('display','block');
					$('.funcionario p').css('display','none').find('input,textarea').removeAttr('required');
					$('.campoIdFuncionario').css('display','block').find('input').attr('required',true).removeAttr('readonly').removeClass('readonly');
					break;
				case 'Exclusão':
					escondeTudo();
					$('.funcionario').css('display','block');
					$('.funcionario p').css('display','none').find('input,textarea').removeAttr('required');
					$('.campoIdFuncionario').css('display','block').find('input').attr('required',true).removeAttr('readonly').removeClass('readonly');
					break;
			}
			break;
		case 'remessa':
			$('input.alvo').val('remessa');
			$('.remessa h3').html(proc+' de Remessa');
			switch(proc){
				case 'Cadastro':
					escondeTudo();
					$('.remessa').css('display','block').find('input,textarea').attr('required',true);
					break;
			}
			break;
		case 'produto':
			$('input.alvo').val('produto');
			$('.produto h3').html(proc+' de Produto');
			switch(proc){
				case 'Cadastro':
					escondeTudo();
					$('.produto').css('display','block').find('input,textarea').attr('required',true);
					$('.produto p').css('display','block').find('input,textarea').attr('required',true);
					$('.campoIdProduto').css('display','none').find('input').removeAttr('required');
					break;
				case 'Busca de Dados':
					escondeTudo();
					$('.produto').css('display','block');
					$('.produto p').css('display','none').find('input,textarea').removeAttr('required');
					$('.campoIdProduto').css('display','block').find('input').attr('required',true).removeAttr('readonly').removeClass('readonly');
					break;
			}
			break;
		case 'estoque':
			$('input.alvo').val('estoque');
			switch(proc){
				case 'Inserir':
					escondeTudo();
					$('.estoque h3').html('Inserir itens no Estoque');
					$('.estoque').css('display','block').find('input,textarea').attr('required',true);
					$('.estoque p').css('display','block').find('input,textarea').attr('required',true);
					$('.campoIdFuncEstq,#campoDataSaidaEstq').css('display','none').find('input').removeAttr('required');
					break;
				case 'Retirar':
					escondeTudo();
					$('.estoque h3').html('Retirar itens do Estoque');
					$('.estoque').css('display','block');
					$('.estoque p').css('display','block').find('input,textarea').attr('required',true);
					$('.campoIdFuncEstq,#campoDataSaidaEstq').css('display','block').find('input').attr('required',true);
					break;
			}
			break;
		default:$('.direita').css('display','none');
	}
}