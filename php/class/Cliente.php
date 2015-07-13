<?php
class Cliente extends Contato{
	public $idCliente;
	public $nome;
	public $cpf;
	public $obs;
	public function cadastrarCliente(){
		$mysqli=$this->conectar();
		$queryInsert='insert into cliente(nome,cpf,obs,endereco,contato) values ("'.$this->nome.'","'.$this->cpf.'","'.$this->obs.'",'.$this->idEndereco.','.$this->idContato.');';
		if(!mysqli_query($mysqli,$queryInsert)){
			die ('<script>alert("Não foi possível cadastrar o cliente:\n\n'.mysqli_error($mysqli).'");location.href="/trabalhos/gti/bda1/";</script>');
		}else{
			$this->idCliente=mysqli_insert_id($mysqli);
			echo '<script>alert("Cadastro do cliente '.$this->nome.', de ID '.$this->idCliente.', finalizado com sucesso!");location.href="/trabalhos/gti/bda1/";</script>';
		}
	}
	public function buscarDadosCliente(){
		$mysqli=$this->conectar();
		$this->nome=$this->getValueInBank('nome','cliente','id',$this->idCliente);
		$this->cpf=$this->getValueInBank('cpf','cliente','id',$this->idCliente);
		$this->obs=$this->getValueInBank('obs','cliente','id',$this->idCliente);
		$this->idEndereco=$this->getValueInBank('endereco','cliente','id',$this->idCliente);
		$this->idContato=$this->getValueInBank('contato','cliente','id',$this->idCliente);
		echo '<form id="phpForm" action="/trabalhos/gti/bda1/" method="POST">';
		echo '<input type="hidden" name="idCliente" value="'.$this->idCliente.'">';
		echo '<input type="hidden" name="nomeCliente" value="'.$this->nome.'">';
		echo '<input type="hidden" name="cpf" value="'.$this->cpf.'">';
		echo '<input type="hidden" name="obs" value="'.$this->obs.'">';
		$this->buscarDadosEndereco();
		$this->buscarDadosContato();
		echo '</form>';
		echo '<script src="/trabalhos/gti/bda1/js/jQuery.js"></script>';
		echo "<script>$('#phpForm').submit();</script>";
	}
	public function atualizarCliente(){
		$mysqli=$this->conectar();
		$this->idContato=$this->getValueInBank('contato','cliente','id',$this->idCliente);
		$this->idEndereco=$this->getValueInBank('endereco','cliente','id',$this->idCliente);
		$updCliente='update cliente set nome="'.$this->nome.'",cpf="'.$this->cpf.'",obs="'.$this->obs.'" where id='.$this->idCliente.';';
		if(!mysqli_query($mysqli,$updCliente)){
			die ('<script>alert("Não foi possível atualizar o cliente:\n\n'.mysqli_error($mysqli).'");location.href="/trabalhos/gti/bda1/";</script>');
		}else{
			echo '<script>alert("Atualização do cliente '.$this->nome.', de ID '.$this->idCliente.', finalizada com sucesso!");location.href="/trabalhos/gti/bda1/";</script>';
		}
	}
	public function excluirCliente(){
		$this->nome=$this->getValueInBank('nome','cliente','id',$this->idCliente);
		$this->idContato=$this->getValueInBank('contato','cliente','id',$this->idCliente);
		$this->idEndereco=$this->getValueInBank('endereco','cliente','id',$this->idCliente);
		$this->excluirContato();
		$this->excluirEndereco();
		$delCliente='delete from cliente where id='.$this->idCliente.';';
		$mysqli=$this->conectar();
		if(!mysqli_query($mysqli,$delCliente)){
			die ('<script>alert("Não foi possível excluir o cliente:\n\n'.mysqli_error($mysqli).'");location.href="/trabalhos/gti/bda1/";</script>');
		}else{
			echo '<script>alert("Exclusão do cliente '.$this->nome.', de ID '.$this->idCliente.', finalizada com sucesso!");location.href="/trabalhos/gti/bda1/";</script>';
		}
	}
}
?>