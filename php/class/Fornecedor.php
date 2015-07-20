<?php
class Fornecedor extends Contato {
	private $idFornecedor;
	private $nomeFantasia;
	private $cnpj;
	public function setAttrFornecedor($idFornecedor,$nomeFantasia,$cnpj){
		$this->idFornecedor=$idFornecedor;
		$this->nomeFantasia=$nomeFantasia;
		$this->cnpj=$cnpj;
	}
	public function cadastrarFornecedor(){
		if($this->cadastrarEndereco()===false||$this->cadastrarContato()===false){return;}
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
		if($this->verificarExistencia('fornecedor','id',$this->idFornecedor)===false){return;}
		$this->nomeFantasia=$this->pegarValor('nomeFantasia','fornecedor','id',$this->idFornecedor);
		$this->cnpj=$this->pegarValor('cnpj','fornecedor','id',$this->idFornecedor);
		$this->idEndereco=$this->pegarValor('endereco','fornecedor','id',$this->idFornecedor);
		$this->idContato=$this->pegarValor('contato','fornecedor','id',$this->idFornecedor);
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
		$this->idContato=$this->pegarValor('contato','fornecedor','id',$this->idFornecedor);
		$this->idEndereco=$this->pegarValor('endereco','fornecedor','id',$this->idFornecedor);
		if($this->atualizarEndereco()===false||$this->atualizarContato()===false){return;}
		$updFornecedor='update fornecedor set cnpj="'.$this->cnpj.'",nomeFantasia="'.$this->nomeFantasia.'" where id='.$this->idFornecedor.';';
		$mysqli=$this->conectar();
		if(!mysqli_query($mysqli,$updFornecedor)){
			die ('<script>alert("Não foi possível atualizar o fornecedor:\n\n'.mysqli_error($mysqli).'");location.href="/trabalhos/gti/bda1/";</script>');
		}else{
			echo '<script>alert("Atualização do fornecedor '.$this->nomeFantasia.', de ID '.$this->idFornecedor.', finalizada com sucesso!");location.href="/trabalhos/gti/bda1/";</script>';
		}
	}
	public function excluirFornecedor(){
		if($this->verificarExistencia('fornecedor','id',$this->idFornecedor)===false){return;}
		$this->nomeFantasia=$this->pegarValor('nomeFantasia','fornecedor','id',$this->idFornecedor);
		$this->idContato=$this->pegarValor('contato','fornecedor','id',$this->idFornecedor);
		$this->idEndereco=$this->pegarValor('endereco','fornecedor','id',$this->idFornecedor);
		if($this->excluirEndereco()===false||$this->excluirContato()===false){return;}
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