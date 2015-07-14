<?php
class Contato extends Endereco {
	protected $idContato;
	protected $email;
	protected $telCel;
	protected $telFixo;
	public function setAttrContato($email,$telCel,$telFixo){
		$this->email=$email;
		$this->telCel=$telCel;
		$this->telFixo=$telFixo;
	}
	public function cadastrarContato(){
		$mysqli=$this->conectar();
		$cadContato='insert into contato(email,telCel,telFixo) values ("'.$this->email.'","'.$this->telCel.'","'.$this->telFixo.'");';
		if(!mysqli_query($mysqli,$cadContato)){
			die ('<script>alert("Não foi possível cadastrar o contato:\n\n'.mysqli_error($mysqli).'");</script>');
			return false;
		}else{
			$this->idContato=mysqli_insert_id($mysqli);
			return true;
		}
	}
	public function buscarDadosContato(){
		$this->email=$this->getValueInBank('email','contato','id',$this->idContato);
		$this->telCel=$this->getValueInBank('telCel','contato','id',$this->idContato);
		$this->telFixo=$this->getValueInBank('telFixo','contato','id',$this->idContato);
		echo '<input type="hidden" name="email" value="'.$this->email.'">';
		echo '<input type="hidden" name="telCel" value="'.$this->telCel.'">';
		echo '<input type="hidden" name="telFixo" value="'.$this->telFixo.'">';
	}
	public function atualizarContato(){
		$mysqli=$this->conectar();
		$updContato='update contato set email="'.$this->email.'",telCel="'.$this->telCel.'",telFixo="'.$this->telFixo.'" where id='.$this->idContato.';';
		if(!mysqli_query($mysqli,$updContato)){
			die ('<script>alert("Não foi possível atualizar o contato:\n\n'.mysqli_error($mysqli).'");</script>');
			return false;
		}
		return true;
	}
	public function excluirContato(){
		$mysqli=$this->conectar();
		$delContato='delete from contato where id='.$this->idContato.';';
		if(!mysqli_query($mysqli,$delContato)){
			die ('<script>alert("Não foi possível excluir o contato:\n\n'.mysqli_error($mysqli).'");</script>');
			return false;
		}
		return true;
	}
}
?>