<?php
class Estoque extends Historico{
	public function setAttrEstoque($idProduto,$idFuncionario,$qtdProd,$dataSaida){
		$this->idProduto=$idProduto;
		$this->qtdProd=$qtdProd;
		$this->idFuncionario=$idFuncionario;
		$this->dataSaida=$dataSaida;
	}
	public function inserirProduto(){
		$insEstoque='insert into estoque(produto,qtdProd) values ('.$this->idProduto.','.$this->qtdProd.');';
		$this->nomeProduto=$this->getValueInBank('nome','produto','id',$this->idProduto);
		$mysqli=$this->conectar();
		if(!mysqli_query($mysqli,$insEstoque)){
			die ('<script>alert("Não foi possível inserir o produto no estoque:\n\n'.mysqli_error($mysqli).'");location.href="/trabalhos/gti/bda1/";</script>');
		}else{
			echo '<script>alert("Inserido no estoque com sucesso:\n\nProduto: '.$this->nomeProduto.';\nQuantidade: '.$this->qtdProd.'.");location.href="/trabalhos/gti/bda1/";</script>';
		}
	}
	public function retirarProduto(){
		$qtdProdEstq=$this->getValueInBank('qtdProd','estoque','produto',$this->idProduto);
		$nomeProduto=$this->getValueInBank('nome','produto','id',$this->idProduto);
		if($this->qtdProd>$qtdProdEstq){
			echo '<script>alert("Retirada não pode ser realizada porque não há essa quantidade do produto no estoque!");location.href="/trabalhos/gti/bda1/";</script>';
		}else{
			$qtdProdEstq-=$this->qtdProd;
			$retQtdEstoque='update estoque set qtdProd='.$qtdProdEstq.' where produto='.$this->idProduto.';';
			$mysqli=$this->conectar();
			if(!mysqli_query($mysqli,$retQtdEstoque)){
				die ('<script>alert("Não foi possível retirar o produto '.$nomeProduto.' do estoque:\n\n'.mysqli_error($mysqli).'");location.href="/trabalhos/gti/bda1/";</script>');
			}else{
				$this->cadastrarHistorico();
				echo '<script>alert("Retirado do estoque com sucesso:\n\nProduto: '.$nomeProduto.';\nQuantidade: '.$this->qtdProd.'.");location.href="/trabalhos/gti/bda1/";</script>';
			}
		}
	}
}
?>