<?php
function __autoload($className) {
    require_once $className.'.php';
}
public class Endereco extends Connection {
	private $idEndereco;
	private $rua;
	private $numero;
	private $complemento;
	private $cep;
	private $bairro;
	private $cidade;
	private $estado;
	public function cadastrarEndereco($rua,$numero,$complemento,$cep,$bairro,$cidade,$estado){
		$this->rua=$rua;
		$this->numero=$numero;
		$this->complemento=$complemento;
		$this->cep=$cep;
		$this->bairro=$bairro;
		$this->cidade=$cidade;
		$this->estado=$estado;
		$mysqli=conectar();
		if($mysqli!="erro"){
			$cadEndereco='insert into endereco(rua,numero,complemento,cep,bairro,cidade,estado) values ("'.$this->rua.'",'.$this->numero.',"'.$this->complemento.'","'.$this->cep.'","'.$this->bairro.'","'.$this->cidade.'","'.$this->estado.'");';
			if(!mysqli_query($mysqli,$cadEndereco)){
				die ('<script>alert("Não foi possível cadastrar o endereço:\n\n'.mysqli_error($mysqli).'");location.href="/trabalhos/gti/bda1/";</script>');
			}else{
				$this->idEndereco=mysqli_insert_id($mysqli);
				return $this->idEndereco;
			}
		}
	}
	public function buscarDadosEndereco($id){
		if($this->idEndereco!=$id){
			$this->rua=getValueInBank('rua','endereco','id',$id);
			$this->numero=getValueInBank('numero','endereco','id',$id);
			$this->complemento=getValueInBank('complemento','endereco','id',$id);
			$this->cep=getValueInBank('cep','endereco','id',$id);
			$this->bairro=getValueInBank('bairro','endereco','id',$id);
			$this->cidade=getValueInBank('cidade','endereco','id',$id);
			$this->estado=getValueInBank('estado','endereco','id',$id);
			$this->idEndereco=$id;
		}
		echo '<input type="hidden" name="rua" value="'.$this->rua.'">';
		echo '<input type="hidden" name="numero" value="'.$this->numero.'">';
		echo '<input type="hidden" name="compl" value="'.$this->complemento.'">';
		echo '<input type="hidden" name="cep" value="'.$this->cep.'">';
		echo '<input type="hidden" name="bairro" value="'.$this->bairro.'">';
		echo '<input type="hidden" name="cidade" value="'.$this->cidade.'">';
		echo '<input type="hidden" name="estado" value="'.$this->estado.'">';
	}
	public function atualizarEndereco($id,$rua,$numero,$complemento,$cep,$bairro,$cidade,$estado){
		$this->idEndereco=$id;
		$this->rua=$rua;
		$this->numero=$numero;
		$this->complemento=$complemento;
		$this->cep=$cep;
		$this->bairro=$bairro;
		$this->cidade=$cidade;
		$this->estado=$estado;
		$mysqli=conectar();
		if($mysqli!="erro"){
			$updContato='update endereco set rua="'.$this->rua.'",numero="'.$this->numero.'",complemento="'.$this->complemento.'",cep="'.$this->cep.'",bairro="'.$this->bairro.'",cidade="'.$this->cidade.'",estado="'.$this->estado.'" where id='.$this->idEndereco.';';
			if(!mysqli_query($mysqli,$updContato)){
				die ('<script>alert("Não foi possível atualizar o endereço:\n\n'.mysqli_error($mysqli).'");location.href="/trabalhos/gti/bda1/";</script>');
			}
		}else{return null}
	}
	public function excluirEndereco($id){
		$mysqli=connect();
		if($mysqli!="erro"){
			$delEndereco='delete from endereco where id='.$id.';';
			if(!mysqli_query($mysqli,$delEndereco)){
				die ('<script>alert("Não foi possível excluir o endereço:\n\n'.mysqli_error($mysqli).'");location.href="/trabalhos/gti/bda1/";</script>');
			}
		}else{return null}
	}
}
?>