<?php
function __autoload($className) {
    require_once $className.'.php';
}
public class Endereco extends Connection {
	private $id;
	private $rua;
	private $numero;
	private $complemento;
	private $cep;
	private $bairro;
	private $cidade;
	private $estado;
	public function cadastrarEndereco($rua,$numero,$complemento,$cep,$bairro,$cidade,$estado){
		$mysqli=conectar();
		if($mysqli!="erro"){
			$cadEndereco='insert into endereco(rua,numero,complemento,cep,bairro,cidade,estado) values ("'.$rua.'",'.$numero.',"'.$compl.'","'.$cep.'","'.$bairro.'","'.$cidade.'","'.$estado.'");';
			if(!mysqli_query($mysqli,$cadEndereco)){
				die ('<script>alert("Não foi possível cadastrar o endereço:\n\n'.mysqli_error($mysqli).'");location.href="/trabalhos/gti/bda1/";</script>');
			}else{
				mysqli_close($mysqli);
				return mysqli_insert_id($mysqli);
			}
		}
	}
	public function buscarDadosEndereco($id){
		$mysqli=conectar();
		if($mysqli!="erro"){
			$rua=getValueInBank('rua','endereco','id',$id);
			$numero=getValueInBank('numero','endereco','id',$id);
			$complemento=getValueInBank('complemento','endereco','id',$id);
			$cep=getValueInBank('cep','endereco','id',$id);
			$bairro=getValueInBank('bairro','endereco','id',$id);
			$cidade=getValueInBank('cidade','endereco','id',$id);
			$estado=getValueInBank('estado','endereco','id',$id);
			echo '<input type="hidden" name="rua" value="'.$rua.'">';
			echo '<input type="hidden" name="numero" value="'.$numero.'">';
			echo '<input type="hidden" name="compl" value="'.$complemento.'">';
			echo '<input type="hidden" name="cep" value="'.$cep.'">';
			echo '<input type="hidden" name="bairro" value="'.$bairro.'">';
			echo '<input type="hidden" name="cidade" value="'.$cidade.'">';
			echo '<input type="hidden" name="estado" value="'.$estado.'">';
		}
	}
	public function atualizarEndereco($id){
		
	}
	public function excluirEndereco($id){
		$mysqli=connect();
		if($mysqli!="erro"){
			$delEndereco='delete from endereco where id='.$id.';';
			if(!mysqli_query($mysqli,$delEndereco)){
				die ('<script>alert("Não foi possível excluir o endereço fornecedor:\n\n'.mysqli_error($mysqli).'");location.href="/trabalhos/gti/bda1/";</script>');
			}
			mysqli_close($mysqli);
		}
	}
}
?>