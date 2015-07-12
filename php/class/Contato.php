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
	private $rua;
	private $numero;
	private $complemento;
	private $cep;
	private $bairro;
	private $cidade;
	private $estado;
	//Contatos
	public function cadastrarContato($email,$telCel,$telFixo){
		$mysqli=connect();
		if($mysqli!="erro"){
			$cadContato='insert into contato(email,telCel,telFixo) values ("'.$email.'","'.$telCel.'","'.$telFixo.'");';
			if(!mysqli_query($mysqli,$cadEndereco)){
				die ('<script>alert("Não foi possível cadastrar o endereço:\n\n'.mysqli_error($mysqli).'");location.href="/trabalhos/gti/bda1/";</script>');
			}else{
				mysqli_close($mysqli);
				return mysqli_insert_id($mysqli);
			}
		}
	}
	public function buscarDadosContato($id){
		$mysqli=connect();
		if($mysqli!="erro"){
			$email=getValueInBank('email','contato','id',$id);
			$telCel=getValueInBank('telCel','contato','id',$id);
			$telFixo=getValueInBank('telFixo','contato','id',$id);
			echo '<input type="hidden" name="email" value="'.$email.'">';
			echo '<input type="hidden" name="telCel" value="'.$telCel.'">';
			echo '<input type="hidden" name="telFixo" value="'.$telFixo.'">';
		}
	}
	public function atualizarContato($email,$telCel,$telFixo){
		
	}
	public function excluirContato($id){
		
	}
}
?>