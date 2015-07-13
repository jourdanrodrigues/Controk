<?php
class Fornecedor extends Contato {
	public $idFornecedor;
	public $nomeFantasia;
	public $cnpj;
	public function cadastrarFornecedor(){
		$mysqli=$this->conectar();
		$cadFornecedor='insert into fornecedor(nomeFantasia,cnpj,endereco,contato) values ("'.$this->nomeFantasia.'","'.$this->cnpj.'",'.$this->idEndereco.','.$this->idContato.');';
		if(!mysqli_query($mysqli,$cadFornecedor)){
			die ('<script>alert("Não foi possível cadastrar o fornecedor:\n\n'.mysqli_error($mysqli).'");location.href="/trabalhos/gti/bda1/";</script>');
		}else{
			$this->idFornecedor=mysqli_insert_id($mysqli);
			echo '<script>alert("Cadastro do fornecedor '.$this->nomeFantasia.', de ID '.$this->idFornecedor.', finalizado com sucesso!");location.href="/trabalhos/gti/bda1/";</script>';
		}
	}
	public function buscarDadosFornecedor(){
		$this->nomeFantasia=$this->getValueInBank('nomeFantasia','fornecedor','id',$this->idFornecedor);
		$this->cnpj=$this->getValueInBank('cnpj','fornecedor','id',$this->idFornecedor);
		$this->idEndereco=$this->getValueInBank('endereco','fornecedor','id',$this->idFornecedor);
		$this->idContato=$this->getValueInBank('contato','fornecedor','id',$this->idFornecedor);
		echo '<form id="phpForm" action="/trabalhos/gti/bda1/" method="POST">';
		echo '<input type="hidden" name="idFornecedor" value="'.$this->idFornecedor.'">';
		echo '<input type="hidden" name="nomeFantasia" value="'.$this->nomeFantasia.'">';
		echo '<input type="hidden" name="cnpj" value="'.$this->cnpj.'">';
		$this->buscarDadosEndereco();
		$this->buscarDadosContato();
		echo '</form>';
		echo '<script src="/trabalhos/gti/bda1/js/jQuery.js"></script>';
		echo "<script>$('#phpForm').submit();</script>";
	}
	public function atualizarFornecedor(){
		$this->idContato=$this->getValueInBank('contato','fornecedor','id',$this->idFornecedor);
		$this->idEndereco=$this->getValueInBank('endereco','fornecedor','id',$this->idFornecedor);
		$mysqli=$this->conectar();
		$updFornecedor='update fornecedor set cnpj="'.$this->cnpj.'",nomeFantasia="'.$this->nomeFantasia.'" where id='.$this->idFornecedor.';';
		if(!mysqli_query($mysqli,$updFornecedor)){
			die ('<script>alert("Não foi possível atualizar o fornecedor:\n\n'.mysqli_error($mysqli).'");location.href="/trabalhos/gti/bda1/";</script>');
		}else{
			echo '<script>alert("Atualização do fornecedor '.$this->nomeFantasia.', de ID '.$this->idFornecedor.', finalizada com sucesso!");location.href="/trabalhos/gti/bda1/";</script>';
		}
	}
	public function excluirFornecedor(){
		$this->nomeFantasia=$this->getValueInBank('nomeFantasia','fornecedor','id',$this->idFornecedor);
		$this->idContato=$this->getValueInBank('contato','fornecedor','id',$this->idFornecedor);
		$this->idEndereco=$this->getValueInBank('endereco','fornecedor','id',$this->idFornecedor);
		$this->excluirContato();
		$this->excluirEndereco();
		$delFornecedor='delete from fornecedor where id='.$this->idFornecedor.';';
		$mysqli=$this->conectar();
		if(!mysqli_query($mysqli,$delFornecedor)){
			die ('<script>alert("Não foi possível excluir o fornecedor '.$this->nomeFantasia.':\n\n'.mysqli_error($mysqli).'");location.href="/trabalhos/gti/bda1/";</script>');
		}else{
			echo '<script>alert("Exclusão do fornecedor '.$this->nomeFantasia.', de ID '.$this->idFornecedor.', finalizada com sucesso!");location.href="/trabalhos/gti/bda1/";</script>';
		}
	}
}
?>