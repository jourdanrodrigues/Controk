<?php
function __autoload($className) {
    require_once $className.'.php';
}
public class Contato extends Endereco {
	private $idContato;
	private $idEndereco;
	private $email;
	private $telCel;
	private $telFixo;
	public function cadastrarContato($email,$telCel,$telFixo){
		$this->email=$email;
		$this->telCel=$telCel;
		$this->telFixo=$telFixo;
		$mysqli=connect();
		$cadContato='insert into contato(email,telCel,telFixo) values ("'.$this->email.'","'.$this->telCel.'","'.$this->telFixo.'");';
		if(!mysqli_query($mysqli,$cadEndereco)){
			die ('<script>alert("Não foi possível cadastrar o contato:\n\n'.mysqli_error($mysqli).'");location.href="/trabalhos/gti/bda1/";</script>');
		}else{
			$this->idContato=mysqli_insert_id($mysqli);
			return $this->idContato;
		}
	}
	public function buscarDadosContato($id){
		if($this->idContato!=$id){
			$this->email=getValueInBank('email','contato','id',$id);
			$this->telCel=getValueInBank('telCel','contato','id',$id);
			$this->telFixo=getValueInBank('telFixo','contato','id',$id);
			$this->idContato=$id;
		}
		echo '<input type="hidden" name="email" value="'.$this->email.'">';
		echo '<input type="hidden" name="telCel" value="'.$this->telCel.'">';
		echo '<input type="hidden" name="telFixo" value="'.$this->telFixo.'">';
	}
	public function atualizarContato($id,$alvo,$email,$telCel,$telFixo){
		$this->idContato=$id;
		$this->email=$email;
		$this->telCel=$telCel;
		$this->telFixo=$telFixo;
		$updContato='update contato set email="'.$this->email.'",telCel="'.$this->telCel.'",telFixo="'.$this->telFixo.'" where id='.$this->idContato.';';
		if(!mysqli_query($mysqli,$updContato)){
			die ('<script>alert("Não foi possível atualizar o contato:\n\n'.mysqli_error($mysqli).'");location.href="/trabalhos/gti/bda1/";</script>');
		}
	}
	public function excluirContato($id){
		$delContato='delete from contato where id='.$id.';';
		if(!mysqli_query($mysqli,$delContato)){
			die ('<script>alert("Não foi possível excluir o contato:\n\n'.mysqli_error($mysqli).'");location.href="/trabalhos/gti/bda1/";</script>');
		}
	}
}
?>