$(document).ready(function (){
	$('input[id="cpfFuncionario"],input[id="cpfCliente"]').mask("999.999.999-99");
	$('input[id="cnpj"]').mask("99.999.999/9999-99");
	$('input[id="telFixo"]').mask("(99) 9999-9999");
	$('input[id="telCel"]').mask("(99) 9 9999-9999");
	$('input[id="cep"]').mask("99.999-999");
	$('#custoProd,#valorVenda').priceFormat({
		prefix: 'R$ ',
		centsSeparator: ',',
		thousandsSeparator: '.'
	});
	// Fade em todas as páginas
	$('body').css('opacity', '0').fadeTo(600, 1,'swing');
});
function opcoes(item){
	if($('#'+item+' ul').css('display')=='block'){
		$('#'+item+' ul').css('display','none')
	}else{
		$('#'+item+' ul').css('display','block')
	};
}
function escondeTudo(){
	$('#remessa,#produto,#fornecedor,#cliente,#funcionario,#estoque,#contato,#endereco').css('display','none').find('input,textarea').removeAttr('required');
}
function dbManage(item,proc){
	if($('#direita').css('display')=='none'){
		$('#direita').css('display','block')
	}
	switch(proc){
		case 'Cadastro':
			$('input[name="acao"]').val('cadastrar');
			$('button').html('Cadastrar');
			break;
		case 'Edição':
			$('input[name="acao"]').val('editar');
			$('button').html('Editar');
			break;
		case 'Exclusão':
			$('input[name="acao"]').val('excluir');
			$('button').html('Excluir');
			break;
		case 'Inserir':
			$('input[name="acao"]').val('inserir');
			$('button').html('Inserir');
			break;
		case 'Retirar':
			$('input[name="acao"]').val('retirar');
			$('button').html('Retirar');
			break;
	}
	switch(item){
		case 'fornecedor':
			$('input[name="alvo"]').val('fornecedor');
			$('#fornecedor h3').html(proc+' de Fornecedor');
			switch(proc){
				case 'Cadastro':
					escondeTudo();
					$('#fornecedor,#contato,#endereco').css('display','block').find('input,textarea').attr('required',true);
					$('#fornecedor p').css('display','block').find('input,textarea').attr('required',true);
					$('#campoIdFornecedor').css('display','none').find('input').removeAttr('required');
					break;
				case 'Edição':
					escondeTudo();
					$('#fornecedor').css('display','block');
					$('#fornecedor p').css('display','none').find('input,textarea').removeAttr('required');
					$('#campoIdFornecedor').css('display','block').find('input').attr('required',true);
					break;
				case 'Exclusão':
					escondeTudo();
					$('#fornecedor').css('display','block');
					$('#fornecedor p').css('display','none').find('input,textarea').removeAttr('required');
					$('#campoIdFornecedor').css('display','block').find('input').attr('required',true);
					break;
			}
			break;
		case 'cliente':
			$('input[name="alvo"]').val('cliente');
			$('#cliente h3').html(proc+' de Cliente');
			switch(proc){
				case 'Cadastro':
					escondeTudo();
					$('#cliente,#contato,#endereco').css('display','block').find('input,textarea').attr('required',true);
					$('#cliente p').css('display','block').find('input,textarea').attr('required',true);
					$('#campoIdCliente').css('display','none').find('input').removeAttr('required');
					break;
				case 'Edição':
					escondeTudo();
					$('#cliente').css('display','block');
					$('#cliente p').css('display','none').find('input,textarea').removeAttr('required');
					$('#campoIdCliente').css('display','block').find('input').attr('required',true);
					break;
				case 'Exclusão':
					escondeTudo();
					$('#cliente').css('display','block');
					$('#cliente p').css('display','none').find('input,textarea').removeAttr('required');
					$('#campoIdCliente').css('display','block').find('input').attr('required',true);
					break;
			}
			break;
		case 'funcionario':
			$('input[name="alvo"]').val('funcionario');
			$('#funcionario h3').html(proc+' de Funcionário');
			switch(proc){
				case 'Cadastro':
					escondeTudo();
					$('#funcionario,#contato,#endereco').css('display','block').find('input,textarea').attr('required',true);
					$('#funcionario p').css('display','block').find('input,textarea').attr('required',true);
					$('#campoIdFuncionario').css('display','none').find('input').removeAttr('required');
					break;
				case 'Edição':
					escondeTudo();
					$('#funcionario').css('display','block');
					$('#funcionario p').css('display','none').find('input,textarea').removeAttr('required');
					$('#campoIdFuncionario').css('display','block').find('input').attr('required',true);
					break;
				case 'Exclusão':
					escondeTudo();
					$('#funcionario').css('display','block');
					$('#funcionario p').css('display','none').find('input,textarea').removeAttr('required');
					$('#campoIdFuncionario').css('display','block').find('input').attr('required',true);
					break;
			}
			break;
		case 'remessa':
			$('input[name="alvo"]').val('remessa');
			$('#remessa h3').html(proc+' de Remessa');
			switch(proc){
				case 'Cadastro':
					escondeTudo();
					$('#remessa').css('display','block').find('input,textarea').attr('required',true);
					break;
			}
			break;
		case 'produto':
			$('input[name="alvo"]').val('produto');
			$('#produto h3').html(proc+' de Produto');
			switch(proc){
				case 'Cadastro':
					escondeTudo();
					$('#produto').css('display','block').find('input,textarea').attr('required',true);
					$('#produto p').css('display','block').find('input,textarea').attr('required',true);
					$('#campoIdFuncionario').css('display','none').find('input').removeAttr('required');
					break;
				case 'Edição':
					escondeTudo();
					$('#produto').css('display','block');
					$('#produto p').css('display','none').find('input,textarea').removeAttr('required');
					$('#campoIdProduto').css('display','block').find('input').attr('required',true);
					break;
			}
			break;
		case 'estoque':
			$('input[name="alvo"]').val('estoque');
			switch(proc){
				case 'Inserir':
					escondeTudo();
					$('#estoque h3').html('Inserir itens no Estoque');
					$('#estoque').css('display','block').find('input,textarea').attr('required',true);
					$('#estoque p').css('display','block').find('input,textarea').attr('required',true);
					$('#campoIdFuncEstq,#campoDataSaidaEstq').css('display','none').find('input').removeAttr('required');
					break;
				case 'Retirar':
					escondeTudo();
					$('#estoque h3').html('Retirar itens do Estoque');
					$('#estoque').css('display','block');
					$('#estoque p').css('display','block').find('input,textarea').attr('required',true);
					$('#campoIdFuncEstq,#campoDataSaidaEstq').css('display','block').find('input').attr('required',true);
					break;
			}
			break;
		default:
			$('#direita').css('display','none');
	}
}