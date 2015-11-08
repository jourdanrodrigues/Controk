<?php
class Cliente extends Contato{
    private $id;
    protected $nome;
    protected $cpf;
    protected $obs;
    public function setAttr($var){
        $obj=json_decode(fixJSON($var));
        if(isset($obj->id)) $this->id=$obj->id;
        if(isset($obj->nome)){
            $this->nome=$obj->nome;
            $this->cpf=$obj->cpf;
            $this->obs=$obj->obs;
        }
    }
    public function cadastrar(){
        if($this->cadastrarEndereco()===false||$this->cadastrarContato()===false) return;
        $conn=$this->connect();
        $cadCliente=$conn->prepare("insert into cliente(nome,cpf,obs,endereco,contato) values (?,?,?,?,?)");
        $cadCliente->bind_param("sdsdd",$this->nome,$this->cpf,$this->obs,$this->idEndereco,$this->idContato);
        if(!$cadCliente->execute()) AJAXReturn("{'type':'error','msg':'Não foi possível cadastrar o cliente:\n\n$cadCliente->error.'}");
        else AJAXReturn("{'type':'success','msg':'Cadastro do cliente $this->nome, de ID $cadCliente->insert_id, finalizado com sucesso!'}");
    }
    public function buscarDados(){
        if($this->checkExistence('cliente','id',$this->id)===false) return;
        $this->idEndereco=$this->getValue('endereco','cliente','id',$this->id);
        $this->idContato=$this->getValue('contato','cliente','id',$this->id);
        echo fixJSON("{'id':$this->id,
            'nome':'".$this->getValue('nome','cliente','id',$this->id)."',
            'cpf':".$this->getValue('cpf','cliente','id',$this->id).",
            'obs':'".$this->getValue('obs','cliente','id',$this->id)."',".
            $this->buscarDadosEndereco().",".
            $this->buscarDadosContato()."}");
    }
    public function atualizar(){
        $conn=$this->connect();
        $this->idContato=$this->getValue("contato","cliente","id",$this->id);
        $this->idEndereco=$this->getValue("endereco","cliente","id",$this->id);
        if($this->atualizarEndereco()===false||$this->atualizarContato()===false) return;
        $updCliente=$conn->prepare("update cliente set nome=?,cpf=?,obs=? where id=?");
        $updCliente->bind_param("sdsd",$this->nome,$this->cpf,$this->obs,$this->id);
        if(!$updCliente->execute()) AJAXReturn("{'type':'error','msg':'Não foi possível atualizar o cliente:<p>$updCliente->error</p>'}");
        else AJAXReturn("{'type':'success','msg':'Atualização do cliente $this->nome, de ID $this->id, finalizada com sucesso!'}");
    }
    public function excluir(){
        if($this->checkExistence("cliente","id",$this->id)===false) return;
        $this->nome=$this->getValue("nome","cliente","id",$this->id);
        $this->idContato=$this->getValue("contato","cliente","id",$this->id);
        $this->idEndereco=$this->getValue("endereco","cliente","id",$this->id);
        if($this->excluirEndereco()===false||$this->excluirContato()===false) return;
        $conn=$this->connect();
        $delCliente=$conn->prepare("delete from cliente where id=?");
        $delCliente->bind_param("d",$this->id);
        if(!$delCliente->execute()) AJAXReturn("{'type':'error','msg':'Não foi possível excluir o cliente:<p>$delCliente->error</p>'}");
        else AJAXReturn("{'type':'success','msg':'Exclusão do cliente $this->nome, de ID $this->id, finalizada com sucesso!'}");
    }
}