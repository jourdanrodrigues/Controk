<?php
class Produto extends Remessa{
    private $nome;
    private $descricao;
    private $custoProd;
    private $valorVenda;
    public function setAttrProduto($idProduto,$nome="",$idRemessa="",$descricao="",$custoProd="",$valorVenda=""){
        $this->idProduto=$idProduto;
        $this->nome=$nome;
        $this->idRemessa=$idRemessa;
        $this->descricao=$descricao;
        $this->custoProd=$custoProd;
        $this->valorVenda=$valorVenda;
    }
    public function cadastrarProduto(){
        $this->custoProd=str_replace('R$ ','',$this->custoProd);
        $this->custoProd=str_replace(',','.',$this->custoProd);
        $this->valorVenda=str_replace('R$ ','',$this->valorVenda);
        $this->valorVenda=str_replace(',','.',$this->valorVenda);
        $mysqli=$this->conectar();
        $cadProduto=$mysqli->prepare("insert into produto(remessa,descricao,nome,custo,valorVenda) values (?,?,?,?,?)");
        $cadProduto->bind_param("dssdd",$this->idRemessa,$this->descricao,$this->nome,$this->custoProd,$this->valorVenda);
        if(!$cadProduto->execute()) echo "<span class='retorno' data-type='error'>Não foi possível cadastrar o produto:<p>$cadProduto->error</p></span>";
        else echo "<span class='retorno' data-type='success'>Cadastro do produto $this->nome, de ID $cadProduto->insert_id, finalizado com sucesso!</span>";
    }
    public function buscarDadosProduto(){
        if($this->verificarExistencia('produto','id',$this->idProduto)===false){return;}
        $this->nome=$this->pegarValor('nome','produto','id',$this->idProduto);
        $this->idRemessa=$this->pegarValor('remessa','produto','id',$this->idProduto);
        $this->descricao=$this->pegarValor('descricao','produto','id',$this->idProduto);
        $this->custoProd=$this->pegarValor('custo','produto','id',$this->idProduto);
        $custoProd=str_replace('.',',',$this->custoProd);
        $this->valorVenda=$this->pegarValor('valorVenda','produto','id',$this->idProduto);
        $valorVenda=str_replace('.',',',$this->valorVenda);
        echo "<input type='text' class='idProduto' value='$this->idProduto'>";
        echo "<input type='text' class='nomeProd' value='$this->nome'>";
        echo "<input type='text' class='idRemessa' value='$this->idRemessa'>";
        echo "<input type='text' class='descrProd' value='$this->descricao'>";
        echo "<input type='text' class='custoProd' value='R$ $custoProd'>";
        echo "<input type='text' class='valorVenda' value='R$ $valorVenda'>";
    }
    public function atualizarProduto(){
        $this->custoProd=str_replace('R$ ','',$this->custoProd);
        $custoProd=str_replace(',','.',$this->custoProd);
        $this->valorVenda=str_replace('R$ ','',$this->valorVenda);
        $valorVenda=str_replace(',','.',$this->valorVenda);
        $mysqli=$this->conectar();
        $updProduto=$mysqli->prepare("update produto set descricao=?,nome=?,custo=?,valorVenda=? where id=?");
        $updProduto->bind_param("ssddd",$this->descricao,$this->nome,$custoProd,$valorVenda,$this->idProduto);
        if(!$updProduto->execute()) echo "<span class='retorno' data-type='error'>Não foi possível atualizar o produto:<p>$updProduto->error</p></span>";
        else echo "<span class='retorno' data-type='success'>Atualização do produto $this->nome, de ID $this->idProduto, finalizada com sucesso!</span>";
    }
}