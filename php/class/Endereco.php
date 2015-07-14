<?php
class Endereco extends Connection {
	protected $idEndereco;
	protected $rua;
	protected $numero;
	protected $complemento;
	protected $cep;
	protected $bairro;
	protected $cidade;
	protected $estado;
	public function setAttrEndereco($rua,$numero,$complemento,$cep,$bairro,$cidade,$estado){
		$this->rua=$rua;
		$this->numero=$numero;
		$this->complemento=$complemento;
		$this->cep=$cep;
		$this->bairro=$bairro;
		$this->cidade=$cidade;
		$this->estado=$estado;
	}
	public function cadastrarEndereco(){
		$mysqli=$this->conectar();
		$cadEndereco='insert into endereco(rua,numero,complemento,cep,bairro,cidade,estado) values ("'.$this->rua.'",'.$this->numero.',"'.$this->complemento.'","'.$this->cep.'","'.$this->bairro.'","'.$this->cidade.'","'.$this->estado.'");';
		if(!mysqli_query($mysqli,$cadEndereco)){
			die ('<script>alert("Não foi possível cadastrar o endereço:\n\n'.mysqli_error($mysqli).'");location.href="/trabalhos/gti/bda1/";</script>');
		}else{
			$this->idEndereco=mysqli_insert_id($mysqli);
		}
	}
	public function buscarDadosEndereco(){
		$this->rua=$this->getValueInBank('rua','endereco','id',$this->idEndereco);
		$this->numero=$this->getValueInBank('numero','endereco','id',$this->idEndereco);
		$this->complemento=$this->getValueInBank('complemento','endereco','id',$this->idEndereco);
		$this->cep=$this->getValueInBank('cep','endereco','id',$this->idEndereco);
		$this->bairro=$this->getValueInBank('bairro','endereco','id',$this->idEndereco);
		$this->cidade=$this->getValueInBank('cidade','endereco','id',$this->idEndereco);
		$this->estado=$this->getValueInBank('estado','endereco','id',$this->idEndereco);
		echo '<input type="hidden" name="rua" value="'.$this->rua.'">';
		echo '<input type="hidden" name="numero" value="'.$this->numero.'">';
		echo '<input type="hidden" name="compl" value="'.$this->complemento.'">';
		echo '<input type="hidden" name="cep" value="'.$this->cep.'">';
		echo '<input type="hidden" name="bairro" value="'.$this->bairro.'">';
		echo '<input type="hidden" name="cidade" value="'.$this->cidade.'">';
		echo '<input type="hidden" name="estado" value="'.$this->estado.'">';
	}
	public function atualizarEndereco(){
		$mysqli=$this->conectar();
		$updEndereco='update endereco set rua="'.$this->rua.'",numero='.$this->numero.',complemento="'.$this->complemento.'",cep="'.$this->cep.'",bairro="'.$this->bairro.'",cidade="'.$this->cidade.'",estado="'.$this->estado.'" where id='.$this->idEndereco.';';
		if(!mysqli_query($mysqli,$updEndereco)){
			die ('<script>alert("Não foi possível atualizar o endereço:\n\n'.mysqli_error($mysqli).'");location.href="/trabalhos/gti/bda1/";</script>');
		}
	}
	public function excluirEndereco(){
		$mysqli=$this->conectar();
		$delEndereco='delete from endereco where id='.$this->idEndereco.';';
		if(!mysqli_query($mysqli,$delEndereco)){
			die ('<script>alert("Não foi possível excluir o endereço:\n\n'.mysqli_error($mysqli).'");location.href="/trabalhos/gti/bda1/";</script>');
		}
	}
}
?>