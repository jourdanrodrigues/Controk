<?php
function __autoload($className) {
    require_once $className.'.php';
}
public class Estoque extends Historico{
	private $idProduto;
	private $qtdProd;
	public function inserirProduto($idProduto,$qtdProd){
		$this->idProduto=$idProduto;
		$this->qtdProd=$qtdProd;
		$insEstoque='insert into estoque(produto,qtdProd) values ("'.$this->idProduto.'","'.$this->qtdProd.'");';
		$nomeProduto=getValueInBank('nome','produto','id',$this->idProduto);
		$mysqli=conectar();
		if(!mysqli_query($mysqli,$insEstoque)){
			die ('<script>alert("Não foi possível inserir o produto no estoque:\n\n'.mysqli_error($mysqli).'");location.href="/trabalhos/gti/bda1/";</script>');
		}else{
			echo '<script>alert("O produto '.$nomeProduto.' foi inserido no estoque com sucesso!");location.href="/trabalhos/gti/bda1/";</script>';
		}
	}
	public function retirarProduto($idProduto,$qtdRetProd,$idFuncionario,$dataSaida){
		$this->qtdProd=getValueInBank('qtdProd','estoque','produto',$idProduto);
		$nomeProduto=getValueInBank('nome','produto','id',$idProduto);
		if($qtdRetProd>$this->qtdProd){
			echo '<script>alert("Retirada não pode ser realizada porque não há essa quantidade do produto no estoque!");location.href="/trabalhos/gti/bda1/";</script>';
		}else{
			$this->qtdProd-=$qtdRetProd;
			$newQtdEstoque='update estoque set qtdProd='.$this->qtdProd.' where produto='.$idProduto.';';
			if(!mysqli_query($mysqli,$newQtdEstoque)){
				die ('<script>alert("Não foi possível retirar o produto do estoque:\n\n'.mysqli_error($mysqli).'");location.href="/trabalhos/gti/bda1/";</script>');
			}else{
				$this->cadastrarHistorico($idProduto,$idFuncionario,$dataSaida,$qtdRetProd);
				echo '<script>alert("O produto '.$nomeProduto.' foi retirado do estoque com sucesso!");location.href="/trabalhos/gti/bda1/";</script>';
			}
		}
	}
}
?>