<?php
class Cliente extends Contato{
    private $idCliente;
    protected $nome;
    protected $cpf;
    protected $obs;
    public function setAttrCliente($var){
        $obj=json_decode(fixJSON($var));
        if(isset($obj->idCliente)) $this->idCliente=$obj->idCliente;
        if(isset($obj->nome)){
            $this->nome=$obj->nome;
            $this->cpf=$obj->cpf;
            $this->obs=$obj->obs;
        }
    }
    public function cadastrarCliente(){
        if($this->cadastrarEndereco()===false||$this->cadastrarContato()===false) return;
        $conn=$this->connect();
        $cadCliente=$conn->prepare('insert into cliente(nome,cpf,obs,endereco,contato) values (?,?,?,?,?)');
        $cadCliente->bind_param("sssdd",$this->nome,$this->cpf,$this->obs,$this->idEndereco,$this->idContato);
        if(!$cadCliente->execute()) AJAXReturn("{'type':'error','msg':'Não foi possível cadastrar o cliente:\n\n$cadCliente->error.'}");
        else AJAXReturn("{'type':'success','msg':'Cadastro do cliente $this->nome, de ID $cadCliente->insert_id, finalizado com sucesso!'}");
    }
    public function buscarDadosCliente(){
        if($this->checkExistence('cliente','id',$this->idCliente)===false) return;
        $this->nome=$this->getValue('nome','cliente','id',$this->idCliente);
        $this->cpf=$this->getValue('cpf','cliente','id',$this->idCliente);
        $this->obs=$this->getValue('obs','cliente','id',$this->idCliente);
        $this->idEndereco=$this->getValue('endereco','cliente','id',$this->idCliente);
        $this->idContato=$this->getValue('contato','cliente','id',$this->idCliente);
        generateReturnInputs(array(
            array("idCliente",$this->idCliente),
            array("nome",$this->nome),
            array("cpf",$this->cpf),
            array("obs",$this->obs)
        ));
        $this->buscarDadosEndereco();
        $this->buscarDadosContato();
    }
    public function atualizarCliente(){
        $conn=$this->connect();
        $this->idContato=$this->getValue('contato','cliente','id',$this->idCliente);
        $this->idEndereco=$this->getValue('endereco','cliente','id',$this->idCliente);
        if($this->atualizarEndereco()===false||$this->atualizarContato()===false) return;
        $updCliente=$conn->prepare("update cliente set nome=?,cpf=?,obs=? where id=?");
        $updCliente->bind_param("sssd",$this->nome,$this->cpf,$this->obs,$this->idCliente);
        if(!$updCliente->execute()) AJAXReturn("{'type':'error','msg':'Não foi possível atualizar o cliente:<p>$updCliente->error</p>'}");
        else AJAXReturn("{'type':'success','msg':'Atualização do cliente $this->nome, de ID $this->idCliente, finalizada com sucesso!'}");
    }
    public function excluirCliente(){
        if($this->checkExistence('cliente','id',$this->idCliente)===false) return;
        $this->nome=$this->getValue('nome','cliente','id',$this->idCliente);
        $this->idContato=$this->getValue('contato','cliente','id',$this->idCliente);
        $this->idEndereco=$this->getValue('endereco','cliente','id',$this->idCliente);
        if($this->excluirEndereco()===false||$this->excluirContato()===false) return;
        $conn=$this->connect();
        $delCliente=$conn->prepare("delete from cliente where id=?");
        $delCliente->bind_param("d",$this->idCliente);
        if(!$delCliente->execute()) AJAXReturn("{'type':'error','msg':'Não foi possível excluir o cliente:<p>$delCliente->error</p>'}");
        else AJAXReturn("{'type':'success','msg':'Exclusão do cliente $this->nome, de ID $this->idCliente, finalizada com sucesso!'}");
    }
}