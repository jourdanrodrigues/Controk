<?php
function __autoload($className) {
    require_once $className.'.php';
}
public class Fornecedor extends Contato {
	private $id;
	private $nomeFantasia;
	private $cnpj;
	public function cadastrarFornecedor($nomeFantasia,$cnpj,$endereco,$contato){
		$cadFornecedor='insert into fornecedor(nomeFantasia,cnpj,endereco,contato) values ("'.$nomeFantasia.'","'.$cnpj.'",'.$endereco.','.$contato.');';
		if(!mysqli_query($mysqli,$cadFornecedor)){
			die ('<script>alert("Não foi possível cadastrar o fornecedor:\n\n'.mysqli_error($mysqli).'");location.href="/trabalhos/gti/bda1/";</script>');
		}else{
			echo '<script>alert("Cadastro do fornecedor '.$nomeFantasia.', de ID '.mysqli_insert_id($mysqli).', finalizado com sucesso!");location.href="/trabalhos/gti/bda1/";</script>';
		}
	}
	public function buscarDadosFornecedor($id){
		$mysqli=conectar();
		if($mysqli!="erro"){
		//Fornecedor
			$nomeFantasia=getValueInBank('nomeFantasia','fornecedor','id',$id);
			$cnpj=getValueInBank('cnpj','fornecedor','id',$id);
			$endereco=getValueInBank('endereco','fornecedor','id',$id);
			$contato=getValueInBank('contato','fornecedor','id',$id);
		//Cria o formulário
			echo '<form id="phpForm" action="/trabalhos/gti/bda1/" method="POST">';
			echo '<input type="hidden" name="idFornecedor" value="'.$id.'">';
			echo '<input type="hidden" name="nomeFantasia" value="'.$nomeFantasia.'">';
			echo '<input type="hidden" name="cnpj" value="'.$cnpj.'">';
			buscaDadosEndereco($endereco);
			buscaDadosContato($contato);
			echo '</form>';
			echo '<script src="/trabalhos/gti/bda1/js/jQuery.js"></script>';
			echo "<script>$('#phpForm').submit();</script>"; //Submite ele
			desconectar($mysqli);
		}
	}
	public function atualizarFornecedor($nomeFantasia,$cnpj){
		$mysqli=conectar();
		if($mysqli!="erro"){
			$updFornecedor='update fornecedor set cnpj="'.$cnpj.'",nomeFantasia="'.$nomeFantasia.'" where id='.$id.';';
			if(!mysqli_query($mysqli,$updFornecedor)){
				die ('<script>alert("Não foi possível atualizar o fornecedor:\n\n'.mysqli_error($mysqli).'");location.href="/trabalhos/gti/bda1/";</script>');
			}else{
				desconectar($mysqli);
				echo '<script>alert("Atualização do fornecedor '.$nomeFantasia.', de ID '.$id.', finalizada com sucesso!");location.href="/trabalhos/gti/bda1/";</script>';
			}
		}
	}
	public function excluirFornecedor($id){
		$mysqli=conectar();
		if($mysqli!="erro"){
			$endereco=getValueInBank('endereco','fornecedor','id',$id);
			$contato=getValueInBank('contato','fornecedor','id',$id);
			$nomeFantasia=getValueInBank('nomeFantasia','fornecedor','id',$id);
			//Estabelece funções de exclusão
			$delFornecedor='delete from fornecedor where id='.$id.';';
			$delContato='delete from contato where id='.$contato.';';
			if(!mysqli_query($mysqli,$delContato)){
				desconectar($mysqli);
				die ('<script>alert("Não foi possível excluir o contato fornecedor:\n\n'.mysqli_error($mysqli).'");location.href="/trabalhos/gti/bda1/";</script>');
			}elseif(!mysqli_query($mysqli,$delFornecedor)){
				desconectar($mysqli);
				die ('<script>alert("Não foi possível excluir o fornecedor '.$nome.':\n\n'.mysqli_error($mysqli).'");location.href="/trabalhos/gti/bda1/";</script>');
			}else{
				desconectar($mysqli);
				echo '<script>alert("Exclusão do fornecedor '.$nome.', de ID '.$id.', finalizada com sucesso!");location.href="/trabalhos/gti/bda1/";</script>';
			}
		}
	}
}
?>