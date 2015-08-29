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
		$cadEndereco=$mysqli->prepare('insert into endereco(rua,numero,complemento,cep,bairro,cidade,estado) values (?,?,?,?,?,?,?)');
		$cadEndereco->bind_param("sdsssss",$this->rua,$this->numero,$this->complemento,$this->cep,$this->bairro,$this->cidade,$this->estado);
		if(!$cadEndereco->execute()){
			echo "<span class='retorno' data-type='error'>Não foi possível cadastrar o endereço:<p>$cadEndereco->error</p></span>";
			return false;
		}else{
			$this->idEndereco=$cadEndereco->insert_id;
			return true;
		}
	}
	public function buscarDadosEndereco(){
		$this->rua=$this->pegarValor('rua','endereco','id',$this->idEndereco);
		$this->numero=$this->pegarValor('numero','endereco','id',$this->idEndereco);
		$this->complemento=$this->pegarValor('complemento','endereco','id',$this->idEndereco);
		$this->cep=$this->pegarValor('cep','endereco','id',$this->idEndereco);
		$this->bairro=$this->pegarValor('bairro','endereco','id',$this->idEndereco);
		$this->cidade=$this->pegarValor('cidade','endereco','id',$this->idEndereco);
		$this->estado=$this->pegarValor('estado','endereco','id',$this->idEndereco);
		echo "<input type='text' class='rua' value='$this->rua'>";
		echo "<input type='text' class='numero' value='$this->numero'>";
		echo "<input type='text' class='complemento' value='$this->complemento'>";
		echo "<input type='text' class='cep' value='$this->cep'>";
		echo "<input type='text' class='bairro' value='$this->bairro'>";
		echo "<input type='text' class='cidade' value='$this->cidade'>";
		echo "<input type='text' class='estado' value='$this->estado'>";
	}
	public function atualizarEndereco(){
		$mysqli=$this->conectar();
		$updEndereco=$mysqli->prepare("update endereco set rua=?,numero=?,complemento=?,cep=?,bairro=?,cidade=?,estado=? where id=?");
		$updEndereco->bind_param("sdsssssd",$this->rua,$this->numero,$this->complemento,$this->cep,$this->bairro,$this->cidade,$this->estado,$this->idEndereco);
		if(!$updEndereco->execute()){
			echo "<span class='retorno' data-type='error'>Não foi possível atualizar o endereço:<p>$updEndereco->error</p></span>";
			return false;
		}
		return true;
	}
	public function excluirEndereco(){
		$mysqli=$this->conectar();
		$delEndereco=$mysqli->prepare("delete from endereco where id=?");
		$delEndereco->bind_param("d",$this->idEndereco);
		if(!$delEndereco->execute()){
			echo "<span class='retorno' data-type='error'>Não foi possível excluir o endereço:<p>$delEndereco->error</p></span>";
			return false;
		}
		return true;
	}
}
?>