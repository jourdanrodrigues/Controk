<?php
function __autoload($className) {
    require_once $className.'.php';
}
public class Cliente extends Contato{
	private $idCliente;
	private $nome;
	private $cpf;
	private $obs;
	public function cadastrarCliente($nome,$cpf,$obs){
		$this->nome=$nome;
		$this->cpf=$cpf;
		$this->obs=$obs;
		$mysqli=conectar();
		$queryInsert='insert into cliente(nome,cpf,obs,endereco,contato) values ("'.$this->nome.'","'.$this->cpf.'","'.$this->obs.'",'.$this->idEndereco.','.$this->idContato.');';
		if(!mysqli_query($mysqli,$queryInsert)){
			die ('<script>alert("Não foi possível cadastrar o cliente:\n\n'.mysqli_error($mysqli).'");location.href="/trabalhos/gti/bda1/";</script>');
		}else{
			$this->idCliente=mysqli_insert_id($mysqli);
			echo '<script>alert("Cadastro do cliente '.$this->nome.', de ID '.$this->idCliente.', finalizado com sucesso!");location.href="/trabalhos/gti/bda1/";</script>';
		}
	}
	public function buscarDadosCliente($id){
		$mysqli=$this->conectar();
		if($this->idCliente!=$id){
			$this->nome=getValueInBank('nome','cliente','id',$id);
			$this->cpf=getValueInBank('cpf','cliente','id',$id);
			$this->obs=getValueInBank('obs','cliente','id',$id);
			$this->idCliente=$id;
		}
		echo '<form id="phpForm" action="/trabalhos/gti/bda1/" method="POST">';
		echo '<input type="hidden" name="idCliente" value="'.$this->idCliente.'">';
		echo '<input type="hidden" name="nomeCliente" value="'.$this->nome.'">';
		echo '<input type="hidden" name="cpf" value="'.$this->cpf.'">';
		echo '<input type="hidden" name="obs" value="'.$this->obs.'">';
		$this->buscaDadosEndereco($this->idEndereco);
		$this->buscaDadosContato($this->idContato);
		echo '</form>';
		echo '<script src="/trabalhos/gti/bda1/js/jQuery.js"></script>';
		echo "<script>$('#phpForm').submit();</script>";
	}
	public function atualizarCliente($id,$nome,$cpf,$obs){
		$mysqli=$this->conectar();
		$updCliente='update cliente set nome="'.$this->nome.'",cpf="'.$this->cpf.'",obs="'.$this->obs.'" where id='.$this->idCliente.';';
		if(!mysqli_query($mysqli,$updCliente)){
			die ('<script>alert("Não foi possível atualizar o cliente:\n\n'.mysqli_error($mysqli).'");location.href="/trabalhos/gti/bda1/";</script>');
		}else{
			echo '<script>alert("Atualização do cliente '.$this->nome.', de ID '.$this->idCliente.', finalizada com sucesso!");location.href="/trabalhos/gti/bda1/";</script>';
		}
	}
	public function excluirCliente($id){
		$nome=getValueInBank('nome','cliente','id',$id);
		$delCliente='delete from cliente where id='.$id.';';
		$mysqli=conectar();
		if(!mysqli_query($mysqli,$delCliente)){
			die ('<script>alert("Não foi possível excluir o cliente:\n\n'.mysqli_error($mysqli).'");location.href="/trabalhos/gti/bda1/";</script>');
		}else{
			echo '<script>alert("Exclusão do cliente '.$nome.', de ID '.$id.', finalizada com sucesso!");location.href="/trabalhos/gti/bda1/";</script>';
		}
	}
}
?>