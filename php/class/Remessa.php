<?php
class Remessa extends Estoque {
	protected $idRemessa;
	private $idFornecedor;
	private $dataEntrega;
	private $dataPagamento;
	private $dataPedido;
	public function setAttrRemessa($idProduto,$qtdProd,$idFornecedor,$dataPedido,$dataPagamento,$dataEntrega){
		$this->idProduto=$idProduto;
		$this->idFornecedor=$idFornecedor;
		$this->dataEntrega=$dataEntrega;
		$this->dataPagamento=$dataPagamento;
		$this->dataPedido=$dataPedido;
		$this->qtdProd=$qtdProd;
	}
	public function cadastrarRemessa(){
		if($this->verificarExistencia('fornecedor','id',$this->idFornecedor)===false||$this->verificarExistencia('produto','id',$this->idProduto)===false) return;
		$mysqli=$this->conectar();
		$cadRemessa=$mysqli->prepare('insert into remessa(produto,fornecedor,dataEntrega,dataPagamento,dataPedido,qtdProd) values (?,?,?,?,?,?)');
		$cadRemessa->bind_param("ddsssd",$this->idProduto,$this->idFornecedor,$this->dataEntrega,$this->dataPagamento,$this->dataPedido,$this->qtdProd);
		if(!$cadRemessa->execute()) echo "<span class='retorno' data-type='error'Não foi possível cadastrar a remessa:<p>$cadRemessa->error</p></span>";
		else echo "<span class='retorno' data-type='success'>Cadastro da remessa nº $cadRemessa->insert_id finalizado com sucesso!</span>";
	}
}
?>