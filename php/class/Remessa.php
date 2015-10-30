<?php
class Remessa extends Estoque {
    protected $idRemessa;
    private $idFornecedor;
    private $dataEntrega;
    private $dataPagamento;
    private $dataPedido;
    public function setAttrRemessa($var){
        $obj=json_decode(fixJSON($var));
        $this->idProduto=$obj->idProduto;
        $this->idFornecedor=$obj->idFornecedor;
        $this->dataEntrega=$obj->dataEntrega;
        $this->dataPagamento=$obj->dataPagamento;
        $this->dataPedido=$obj->dataPedido;
        $this->qtdProd=$obj->qtdProd;
    }
    public function cadastrarRemessa(){
        if($this->checkExistence('fornecedor','id',$this->idFornecedor)===false||$this->checkExistence('produto','id',$this->idProduto)===false) return;
        $mysqli=$this->connect();
        $cadRemessa=$mysqli->prepare('insert into remessa(produto,fornecedor,dataEntrega,dataPagamento,dataPedido,qtdProd) values (?,?,?,?,?,?)');
        $cadRemessa->bind_param("ddsssd",$this->idProduto,$this->idFornecedor,$this->dataEntrega,$this->dataPagamento,$this->dataPedido,$this->qtdProd);
        if(!$cadRemessa->execute()) AJAXReturn("{'type':'error','msg':'Não foi possível cadastrar a remessa:<p>$cadRemessa->error</p>'}");
        else AJAXReturn("{'type':'success','msg':'Cadastro da remessa nº $cadRemessa->insert_id finalizado com sucesso!'}");
    }
}