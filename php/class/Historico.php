<?php
class Historico extends Connection{
	private $idHistorico;
	protected $idProduto;
	protected $idFuncionario;
	protected $dataSaida;
	protected $qtdProd;
	public function cadastrarHistorico(){
		$insHistorico='insert into historico(produtoEstq,funcionario,qtdRetProd,dataSaida) values ('.$this->idProduto.','.$this->idFuncionario.','.$this->qtdProd.',"'.$this->dataSaida.'");';
		$mysqli=$this->conectar();
		if(!mysqli_query($mysqli,$insHistorico)){
			die ('<script>alert("Não foi possível cadastrar o histórico:\n\n'.mysqli_error($mysqli).'");location.href="/trabalhos/gti/bda1/";</script>');
		}else{
			$this->idHistorico=mysqli_insert_id($mysqli);
		}
	}
	public function buscarDadosHistorico(){
		//Não finalizada!
	}
}
?>