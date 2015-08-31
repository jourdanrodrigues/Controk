<?php
class Historico extends Connection{
	private $idHistorico;
	protected $idProduto;
	protected $idFuncionario;
	protected $dataSaida;
	protected $qtdProd;
	public function cadastrarHistorico(){
		$mysqli=$this->conectar();
		$insHistorico=$mysqli->prepare("insert into historico(produtoEstq,funcionario,qtdRetProd,dataSaida) values (?,?,?,?)");
		$insHistorico->bind_param("ddds",$this->idProduto,$this->idFuncionario,$this->qtdProd,$this->dataSaida);
		if(!$insHistorico->execute()) echo "<span class='retorno' data-type='error'>Não foi possível cadastrar o histórico:<p><br>$insHistorico->error</p></span>";
	}
	public function buscarDadosHistorico(){
		//Não finalizada!
	}
}
?>