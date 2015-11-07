<?php
require_once("Remessa.php");
class Produto extends Remessa{
    private $nome;
    private $descricao;
    private $custo;
    private $valorVenda;
    public function setAttr($var){
        $obj=json_decode(fixJSON($var));
        if(isset($obj->idProduto)) $this->idProduto=$obj->idProduto;
        if(isset($obj->nome)){
            $this->nome=$obj->nome;
            $this->idRemessa=$obj->idRemessa;
            $this->descricao=$obj->descricao;
            $this->custo=$obj->custo;
            $this->valorVenda=$obj->valorVenda;
        }
    }
    public function handleMonetary($value,$action="goCur"){
        return $action==="goNum"?str_replace(',','.',str_replace('R$ ','',$value)):"R$ ".str_replace('.',',',$value);
    }
    public function cadastrar(){
        $this->custo=$this->handleMonetary($this->custo,"goNum");
        $this->valorVenda=$this->handleMonetary($this->valorVenda,"goNum");
        $conn=$this->connect();
        $cadProduto=$conn->prepare("insert into produto(remessa,descricao,nome,custo,valorVenda) values (?,?,?,?,?)");
        $cadProduto->bind_param("dssdd",$this->idRemessa,$this->descricao,$this->nome,$this->custo,$this->valorVenda);
        if(!$cadProduto->execute()) AJAXReturn("{'type':'error','msg':'Não foi possível cadastrar o produto:<p>($cadProduto->errno) ".str_replace("'","\'",$cadProduto->error).".</p>'}");
        else AJAXReturn("{'type':'success','msg':'Cadastro do produto $this->nome, de ID $cadProduto->insert_id, finalizado com sucesso!'}");
    }
    public function buscarDados(){
        if($this->checkExistence("produto","id",$this->idProduto)===false){return;}
        echo fixJSON("{'id':$this->idProduto,
            'custo':'".$this->handleMonetary($this->getValue('custo','produto','id',$this->idProduto))."',
            'valorVenda':'".$this->handleMonetary($this->getValue('valorVenda','produto','id',$this->idProduto))."',
            'nome':'".$this->getValue('nome','produto','id',$this->idProduto)."',
            'idRemessa':".$this->getValue('remessa','produto','id',$this->idProduto).",
            'descricao':'".$this->getValue('descricao','produto','id',$this->idProduto)."'}");
    }
    public function atualizar(){
        $mysqli=$this->connect();
        $updProduto=$mysqli->prepare("update produto set descricao=?,nome=?,custo=?,valorVenda=? where id=?");
        $custoProd=$this->handleMonetary($this->custo,"goNum");
        $valorVenda=$this->handleMonetary($this->valorVenda,"goNum");
        $updProduto->bind_param("ssddd",$this->descricao,$this->nome,$custoProd,$valorVenda,$this->idProduto);
        if(!$updProduto->execute()) AJAXReturn("{'type':'error','msg':'Não foi possível atualizar o produto:<p>$updProduto->error</p>'}");
        else AJAXReturn("{'type':'success','msg':'Atualização do produto $this->nome, de ID $this->idProduto, finalizada com sucesso!'}");
    }
}