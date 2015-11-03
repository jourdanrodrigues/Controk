<?php
require_once("Remessa.php");
class Produto extends Remessa{
    private $nome;
    private $descricao;
    private $custoProd;
    private $valorVenda;
    public function setAttrProduto($var){
        $obj=json_decode(fixJSON($var));
        if(isset($obj->idProduto)) $this->idProduto=$obj->idProduto;
        if(isset($obj->nome)){
            $this->nome=$obj->nome;
            $this->idRemessa=$obj->idRemessa;
            $this->descricao=$obj->descricao;
            $this->custoProd=$obj->custoProd;
            $this->valorVenda=$obj->valorVenda;
        }
    }
    public function handleMonetary(&$value,$action,$return=0){
        if($action=="goNum") $result=str_replace(',','.',str_replace('R$ ','',$value));
        else if($action=="goCur") $result="R$ ".str_replace('.',',',$value);
        if($return==1) return $result;
        else if($return==0) $value=$result;
    }
    public function cadastrarProduto(){
        handleMonetary($this->custoProd,"goNum");
        handleMonetary($this->valorVenda,"goNum");
        $mysqli=$this->connect();
        $cadProduto=$mysqli->prepare("insert into produto(remessa,descricao,nome,custo,valorVenda) values (?,?,?,?,?)");
        $cadProduto->bind_param("dssdd",$this->idRemessa,$this->descricao,$this->nome,$this->custoProd,$this->valorVenda);
        if(!$cadProduto->execute()) AJAXReturn("{'type':'error','msg':'Não foi possível cadastrar o produto:<p>$cadProduto->error</p>'}");
        else AJAXReturn("{'type':'success','msg':'Cadastro do produto $this->nome, de ID $cadProduto->insert_id, finalizado com sucesso!'}");
    }
    public function buscarDadosProduto(){
        if($this->checkExistence('produto','id',$this->idProduto)===false){return;}
        $this->nome=$this->getValue('nome','produto','id',$this->idProduto);
        $this->idRemessa=$this->getValue('remessa','produto','id',$this->idProduto);
        $this->descricao=$this->getValue('descricao','produto','id',$this->idProduto);
        $this->custoProd=$this->getValue('custo','produto','id',$this->idProduto);
        $custoProd=handleMonetary($this->custoProd,"goCur",1);
        $this->valorVenda=$this->getValue('valorVenda','produto','id',$this->idProduto);
        $valorVenda=handleMonetary($this->valorVenda,"goCur",1);
        generateReturnInputs(array(
            array("idProduto",$this->idProduto),
            array("nomeProd",$this->nome),
            array("idRemessa",$this->idRemessa),
            array("descrProd",$this->descricao),
            array("custoProd",$custoProd),
            array("valorVenda",$valorVenda)
        ));
    }
    public function atualizarProduto(){
        $mysqli=$this->connect();
        $updProduto=$mysqli->prepare("update produto set descricao=?,nome=?,custo=?,valorVenda=? where id=?");
        $updProduto->bind_param("ssddd",$this->descricao,$this->nome,handleMonetary($this->custoProd,"goNum",1),handleMonetary($this->valorVenda,"goNum",1),$this->idProduto);
        if(!$updProduto->execute()) AJAXReturn("{'type':'error','msg':'Não foi possível atualizar o produto:<p>$updProduto->error</p>'}");
        else AJAXReturn("{'type':'success','msg':'Atualização do produto $this->nome, de ID $this->idProduto, finalizada com sucesso!'}");
    }
}