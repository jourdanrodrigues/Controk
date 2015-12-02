<?php
class Produto extends Remessa{
    private $id;
    private $nome;
    private $descricao;
    private $custo;
    private $valorVenda;
    function __construct($var){
        $this->connect();
        $obj=json_decode(fixJSON($var));
        if(isset($obj->id)) $this->id=$obj->id;
        if(isset($obj->nome)){
            $this->nome=$obj->nome;
            $this->idRemessa=$obj->idRemessa;
            $this->descricao=$obj->descricao;
            $this->custo=$obj->custo;
            $this->valorVenda=$obj->valorVenda;
        }
    }
    public function cadastrar(){
        $cad=$this->conn->prepare("insert into produto(remessa,descricao,nome,custo,valorVenda) values (?,?,?,?,?)");
        $cad->bind_param("dssdd",$this->idRemessa,$this->descricao,$this->nome,$this->custo,$this->valorVenda);
        if(!$cad->execute()) AJAXReturn("error","Não foi possível cadastrar o produto:<p>($cad->errno) ".str_replace("'","\'",$cad->error).".</p>");
        else AJAXReturn("success","Cadastro do produto $this->nome, de ID $cad->insert_id, finalizado com sucesso!");
    }
    public function listar(){
        $list=$this->conn->prepare("select id,nome,descricao,remessa from produto");
        if(!$list->execute()) AJAXReturn("error","Erro ao listar os produtos:<p>($list->errno) $list->error<p>");
        else{
            $list->bind_result($id,$nome,$descricao,$remessa);
            $listResult="";
            while($list->fetch()) $listResult.="{'id':$id,'nome':'$nome','descricao':'$descricao','remessa':$remessa},";
            echo fixJSON("[".str_replace(",]","]","$listResult]"));
        }
    }
    public function mostrarDados(){
        $values=$this->getValue(["descricao","custo","valorVenda"],"produto","id",$this->id);
        echo fixJSON("{'descricao':'$values->descricao','custo':$values->custo,'valorVenda':$values->valorVenda}");
    }
    public function buscarDados(){
        if($this->checkExistence("produto","id",$this->id)===false) return;
        $values=$this->getValue(["custo","valorVenda","nome","remessa","descricao"],"produto","id",$this->id);
        echo fixJSON("{'id':$this->id,
            'custo':$values->custo,
            'valorVenda':$values->valorVenda,
            'nome':'$values->nome',
            'idRemessa':$values->remessa,
            'descricao':'$values->descricao'}");
    }
    public function atualizar(){
        $upd=$this->conn->prepare("update produto set descricao=?,nome=?,custo=?,valorVenda=? where id=?");
        $upd->bind_param("ssddd",$this->descricao,$this->nome,$this->custo,$this->valorVenda,$this->id);
        if(!$upd->execute()) AJAXReturn("error","Não foi possível atualizar o produto:<p>($upd->errno) $upd->error.</p>");
        else AJAXReturn("success","Atualização do produto $this->nome, de ID $this->id, finalizada com sucesso!");
    }
}