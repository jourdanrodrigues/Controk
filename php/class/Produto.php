<?php
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
    public function cadastrarProduto(){
        $this->custoProd=str_replace('R$ ','',$this->custoProd);
        $this->custoProd=str_replace(',','.',$this->custoProd);
        $this->valorVenda=str_replace('R$ ','',$this->valorVenda);
        $this->valorVenda=str_replace(',','.',$this->valorVenda);
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
        $custoProd=str_replace('.',',',$this->custoProd);
        $this->valorVenda=$this->getValue('valorVenda','produto','id',$this->idProduto);
        $valorVenda=str_replace('.',',',$this->valorVenda);
        generateReturnInputs(array(
            array("idProduto",$this->idProduto),
            array("nomeProd",$this->nome),
            array("idRemessa",$this->idRemessa),
            array("descrProd",$this->descricao),
            array("custoProd","R$ $custoProd"),
            array("valorVenda","R$ $valorVenda")
        ));
    }
    public function atualizarProduto(){
        $this->custoProd=str_replace('R$ ','',$this->custoProd);
        $custoProd=str_replace(',','.',$this->custoProd);
        $this->valorVenda=str_replace('R$ ','',$this->valorVenda);
        $valorVenda=str_replace(',','.',$this->valorVenda);
        $mysqli=$this->connect();
        $updProduto=$mysqli->prepare("update produto set descricao=?,nome=?,custo=?,valorVenda=? where id=?");
        $updProduto->bind_param("ssddd",$this->descricao,$this->nome,$custoProd,$valorVenda,$this->idProduto);
        if(!$updProduto->execute()) AJAXReturn("{'type':'error','msg':'Não foi possível atualizar o produto:<p>$updProduto->error</p>'}");
        else AJAXReturn("{'type':'success','msg':'Atualização do produto $this->nome, de ID $this->idProduto, finalizada com sucesso!'}");
    }
}