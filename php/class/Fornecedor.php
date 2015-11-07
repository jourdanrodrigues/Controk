<?php
class Fornecedor extends Contato {
    private $id;
    private $nome;
    private $cnpj;
    public function setAttr($var){
        $obj=json_decode(fixJSON($var));
        if(isset($obj->id)) $this->id=$obj->id;
        if(isset($obj->cnpj)){
            $this->nome=$obj->nome;
            $this->cnpj=$obj->cnpj;
        }
    }
    public function cadastrarFornecedor(){
        if($this->cadastrarEndereco()===false||$this->cadastrarContato()===false) return;
        $conn=$this->connect();
        $cadFornecedor=$conn->prepare("insert into fornecedor(nomeFantasia,cnpj,endereco,contato) values (?,?,?,?)");
        $cadFornecedor->bind_param("ssdd",$this->nome,$this->cnpj,$this->idEndereco,$this->idContato);
        if(!$cadFornecedor->execute()) AJAXReturn("{'type':'error','msg':'Não foi possível cadastrar o fornecedor:<p>$cadFornecedor->error</p>'}");
        else AJAXReturn("{'type':'success','msg':'Cadastro do fornecedor $this->nome, de ID $cadFornecedor->insert_id, finalizado com sucesso!'}");
    }
    public function buscarDados(){
        if($this->checkExistence("fornecedor","id",$this->id)===false){return;}
        $this->idEndereco=$this->getValue("endereco","fornecedor","id",$this->id);
        $this->idContato=$this->getValue("contato","fornecedor","id",$this->id);
        echo fixJSON("{'id':$this->id,
            'nome':'".$this->getValue('nomeFantasia','fornecedor','id',$this->id)."',
            'cnpj':'".$this->getValue('cnpj','fornecedor','id',$this->id)."',".
            $this->buscarDadosEndereco().",".
            $this->buscarDadosContato()."}");
    }
    public function atualizar(){
        $this->idContato=$this->getValue("contato","fornecedor","id",$this->id);
        $this->idEndereco=$this->getValue("endereco","fornecedor","id",$this->id);
        if($this->atualizarEndereco()===false||$this->atualizarContato()===false) return;
        $conn=$this->connect();
        $updFornecedor=$conn->prepare("update fornecedor set cnpj=?,nomeFantasia=? where id=?");
        $updFornecedor->bind_param("ssd",$this->cnpj,$this->nome,$this->id);
        if(!$updFornecedor->execute()) AJAXReturn("{'type':'error','msg':'Não foi possível atualizar o fornecedor:<p>$updFornecedor->error</p>'}");
        else AJAXReturn("{'type':'success','msg':'Atualização do fornecedor $this->nome, de ID $this->id, finalizada com sucesso!'}");
    }
    public function excluir(){
        if($this->checkExistence('fornecedor','id',$this->id)===false) return;
        $this->nome=$this->getValue('nomeFantasia','fornecedor','id',$this->id);
        $this->idContato=$this->getValue('contato','fornecedor','id',$this->id);
        $this->idEndereco=$this->getValue('endereco','fornecedor','id',$this->id);
        if($this->excluirEndereco()===false||$this->excluirContato()===false) return;
        $conn=$this->connect();
        $delFornecedor=$conn->prepare('delete from fornecedor where id=?');
        $delFornecedor->bind_param("d",$this->id);
        if(!$delFornecedor->execute()) AJAXReturn("{'type':'error','msg':'Não foi possível excluir o fornecedor $this->nome:<p>$delFornecedor->error</p>'}");
        else AJAXReturn("{'type':'success','msg':'Exclusão do fornecedor $this->nome, de ID $this->id, finalizada com sucesso!'}");
    }
}