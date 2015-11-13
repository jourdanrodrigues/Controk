<?php
class Remessa extends Estoque {
    protected $idRemessa;
    private $idFornecedor;
    private $dataEntrega;
    private $dataPagamento;
    private $dataPedido;
    public function Remessa($var){
        $this->connect();
        $obj=json_decode(fixJSON($var));
        if(isset($obj->idRemessa)) $this->idRemessa=$obj->idRemessa;
        if(isset($obj->idProduto)){
            $this->idProduto=$obj->idProduto;
            $this->idFornecedor=$obj->idFornecedor;
            $this->dataEntrega=$obj->dataEntrega;
            $this->dataPagamento=$obj->dataPagamento;
            $this->dataPedido=$obj->dataPedido;
            $this->qtdProd=$obj->qtdProd;
        }
    }
    public function cadastrar(){
        if($this->checkExistence("fornecedor","id",$this->idFornecedor)===false||$this->checkExistence("produto","id",$this->idProduto)===false) return;
        $cad=$this->conn->prepare("insert into remessa(produto,fornecedor,dataEntrega,dataPagamento,dataPedido,qtdProd) values (?,?,?,?,?,?)");
        $cad->bind_param("ddsssd",$this->idProduto,$this->idFornecedor,$this->dataEntrega,$this->dataPagamento,$this->dataPedido,$this->qtdProd);
        if(!$cad->execute()) AJAXReturn("error","Não foi possível cadastrar a remessa:<p>$cad->error</p>");
        else AJAXReturn("success","Cadastro da remessa nº $cad->insert_id finalizado com sucesso!");
    }
    public function listar(){
        $list=$this->conn->prepare("select id,produto,fornecedor,qtdProd from remessa");
        if(!$list->execute()) AJAXReturn("error","Não foi possível listar as remessas:<p>($list->errno) $list->error<p>");
        else{
            $list->bind_result($id,$idProduto,$idFornecedor,$qtdProd);
            $listResult="";
            while($list->fetch()){
                $produto=$this->getValue("nome","produto","id",$idProduto);
                $fornecedor=$this->getValue("nome","fornecedor","id",$idFornecedor);
                $listResult.="{'id':$id,'produto':'$produto','fornecedor':'$fornecedor','qtdProd':$qtdProd},";
            }
            echo fixJSON("[".str_replace(",]","]","$listResult]"));
        }
    }
    public function mostrarDados(){
        $values=$this->getValue(["dataEntrega","dataPagamento","dataPedido"],"remessa","id",$this->idRemessa);
        echo fixJSON("{'dataEntrega':'$values->dataEntrega','dataPagamento':'$values->dataPagamento','dataPedido':'$values->dataPedido'}");
    }
}