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
		$mysqli=$this->conectar();
		$cadRemessa='insert into remessa(produto,fornecedor,dataEntrega,dataPagamento,dataPedido,qtdProd) values ("'.$this->idProduto.'","'.$this->idFornecedor.'","'.$this->dataEntrega.'","'.$this->dataPagamento.'","'.$this->dataPedido.'","'.$this->qtdProd.'");';
		if(!mysqli_query($mysqli,$cadRemessa)){
			die ('<script>alert("Não foi possível cadastrar a remessa:\n\n'.mysqli_error($mysqli).'");location.href="/trabalhos/gti/bda1/";</script>');
		}else{
			$this->idRemessa=mysqli_insert_id($mysqli);
			echo '<script>alert("Cadastro de remessa '.$this->idRemessa.' finalizado com sucesso!");location.href="/trabalhos/gti/bda1/";</script>';
		}
	}
}
?>