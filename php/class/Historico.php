<?php
require_once("Connection.php");
class Historico extends Connection{
    protected $idProduto;
    protected $idFuncionario;
    protected $dataSaida;
    protected $qtdProd;
    public function cadastrarHistorico(){
        $mysqli=$this->connect();
        $insHistorico=$mysqli->prepare("insert into historico(produtoEstq,funcionario,qtdRetProd,dataSaida) values (?,?,?,?)");
        $insHistorico->bind_param("ddds",$this->idProduto,$this->idFuncionario,$this->qtdProd,$this->dataSaida);
        if(!$insHistorico->execute()) AJAXReturn("{'type':'error','msg':'Não foi possível cadastrar o histórico:<p>$insHistorico->error</p>'}");
    }
    public function buscarDadosHistorico(){
        //Não finalizada!
    }
}