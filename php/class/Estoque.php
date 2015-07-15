<?php
class Estoque extends Historico{
	public function setAttrEstoque($idProduto,$idFuncionario,$qtdProd,$dataSaida){
		$this->idProduto=$idProduto;
		$this->qtdProd=$qtdProd;
		$this->idFuncionario=$idFuncionario;
		$this->dataSaida=$dataSaida;
	}
	public function inserirProduto(){
		if($this->verificarExistencia('produto','id',$this->idProduto)===false){return;}
		if($this->verificarExistencia('estoque','produto',$this->idProduto)===false){
			$insEstoque='insert into estoque(produto,qtdProd) values ('.$this->idProduto.','.$this->qtdProd.');';
		}else{
			$qtdProdEstq=$this->getValueInBank('qtdProd','estoque','produto',$this->idProduto);
			$this->qtdProd+=$qtdProdEstq;
			$insEstoque='update estoque set qtdProd='.$this->qtdProd.' where produto='.$this->idProduto.';';
		}
		$this->nomeProduto=$this->getValueInBank('nome','produto','id',$this->idProduto);
		$mysqli=$this->conectar();
		if(!mysqli_query($mysqli,$insEstoque)){
			die ('<script>alert("Não foi possível inserir o produto no estoque:\n\n'.mysqli_error($mysqli).'");location.href="/trabalhos/gti/bda1/";</script>');
		}else{
			echo '<script>alert("Produto inserido no estoque com sucesso:\n\nProduto: '.$this->nomeProduto.';\nQuantidade';
			if(isset($qtdProdEstq)){
				echo ' anterior: '.$qtdProdEstq.';\nQuantidade atual: '.$this->qtdProd.'.");';
			}else{
				echo ': '.$this->qtdProd.'.");location.href="/trabalhos/gti/bda1/";';
			}
			echo 'location.href="/trabalhos/gti/bda1/";</script>';
		}
	}
	public function retirarProduto(){
		if($this->verificarExistencia('funcionario','id',$this->idFuncionario)===false||$this->verificarExistencia('produto','id',$this->idProduto)===false){return;}
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
				echo '<script>alert("Retirado do estoque com sucesso:\n\nID do funcionário: '.$this->idFuncionario.';\nProduto: '.$nomeProduto.';\nQuantidade retirada: '.$this->qtdProd.';\nQuantidade no estoque: '.$qtdProdEstq.'");location.href="/trabalhos/gti/bda1/";</script>';
			}
		}
	}
}
?>