<?php
function __autoload($className) {
    require_once $className.'.php';
}
public class Fornecedor extends Contato {
	private $idFornecedor;
	private $nomeFantasia;
	private $cnpj;
	public function cadastrarFornecedor($nomeFantasia,$cnpj){
		$this->nomeFantasia=$nomeFantasia;
		$this->cnpj=$cnpj;
		$cadFornecedor='insert into fornecedor(nomeFantasia,cnpj,endereco,contato) values ("'.$this->nomeFantasia.'","'.$this->cnpj.'",'.$this->idEndereco.','.$this->idContato.');';
		if(!mysqli_query($mysqli,$cadFornecedor)){
			die ('<script>alert("Não foi possível cadastrar o fornecedor:\n\n'.mysqli_error($mysqli).'");location.href="/trabalhos/gti/bda1/";</script>');
		}else{
			$this->idFornecedor=mysqli_insert_id($mysqli);
			echo '<script>alert("Cadastro do fornecedor '.$this->nomeFantasia.', de ID '.$this->idFornecedor.', finalizado com sucesso!");location.href="/trabalhos/gti/bda1/";</script>';
		}
	}
	public function buscarDadosFornecedor($id){
		if($this->idFornecedor!=$id){
			$this->nomeFantasia=getValueInBank('nomeFantasia','fornecedor','id',$id);
			$this->cnpj=getValueInBank('cnpj','fornecedor','id',$id);
			$this->endereco=getValueInBank('endereco','fornecedor','id',$id);
			$this->contato=getValueInBank('contato','fornecedor','id',$id);
			$this->idFornecedor=$id;
		}
		echo '<form id="phpForm" action="/trabalhos/gti/bda1/" method="POST">';
		echo '<input type="hidden" name="idFornecedor" value="'.$this->idFornecedor.'">';
		echo '<input type="hidden" name="nomeFantasia" value="'.$this->nomeFantasia.'">';
		echo '<input type="hidden" name="cnpj" value="'.$this->cnpj.'">';
		$this->buscaDadosEndereco($this->idEndereco);
		$this->buscaDadosContato($this->idContato);
		echo '</form>';
		echo '<script src="/trabalhos/gti/bda1/js/jQuery.js"></script>';
		echo "<script>$('#phpForm').submit();</script>";
	}
	public function atualizarFornecedor($id,$nomeFantasia,$cnpj){
		$this->nomeFantasia=$nomeFantasia;
		$this->cnpj=$cnpj;
		$this->idFornecedor=$id;
		$mysqli=conectar();
		$updFornecedor='update fornecedor set cnpj="'.$this->cnpj.'",nomeFantasia="'.$this->nomeFantasia.'" where id='.$this->idFornecedor.';';
		if(!mysqli_query($mysqli,$updFornecedor)){
			die ('<script>alert("Não foi possível atualizar o fornecedor:\n\n'.mysqli_error($mysqli).'");location.href="/trabalhos/gti/bda1/";</script>');
		}else{
			echo '<script>alert("Atualização do fornecedor '.$this->nomeFantasia.', de ID '.$this->idFornecedor.', finalizada com sucesso!");location.href="/trabalhos/gti/bda1/";</script>';
		}
	}
	public function excluirFornecedor($id){
		$nomeFantasia=getValueInBank('nomeFantasia','fornecedor','id',$id);
		$delFornecedor='delete from fornecedor where id='.$id.';';
		$mysqli=conectar();
		if(!mysqli_query($mysqli,$delFornecedor)){
			die ('<script>alert("Não foi possível excluir o fornecedor '.$nomeFantasia.':\n\n'.mysqli_error($mysqli).'");location.href="/trabalhos/gti/bda1/";</script>');
		}else{
			echo '<script>alert("Exclusão do fornecedor '.$nomeFantasia.', de ID '.$id.', finalizada com sucesso!");location.href="/trabalhos/gti/bda1/";</script>';
		}
	}
}
?>