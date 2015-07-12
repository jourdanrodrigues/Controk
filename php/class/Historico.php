<?php
function __autoload($className) {
    require_once $className.'.php';
}
public class Historico extends Connection{
	private $idHistorico;
	private $idProduto;
	private $idFuncionario;
	private $dataSaida;
	private $qtdRetProd;
	public function cadastrarHistorico($idProduto,$idFuncionario,$dataSaida,$qtdRetProd){
		$this->idProduto=$idProduto;
		$this->idFuncionario=$idFuncionario;
		$this->dataSaida=$dataSaida;
		$this->qtdRetProd=$qtdRetProd;
		$insHistorico='insert into historico(produtoEstq,funcionario,qtdRetProd,dataSaida) values ('.$idProduto.','.$idFuncionario.','.$qtdRetProd.',"'.$dataSaida.'");';
		if(!mysqli_query($mysqli,$insHistorico)){
			die ('<script>alert("Não foi possível cadastrar o histórico:\n\n'.mysqli_error($mysqli).'");location.href="/trabalhos/gti/bda1/";</script>');
		}else{
			$this->idHistorico=mysqli_insert_id($mysqli);
		}
	}
	public function buscarDadosHistorico($id){
		//Não finalizada!
	}
}
?>