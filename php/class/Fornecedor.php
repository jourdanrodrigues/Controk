<?php
class Fornecedor extends Contato {
    private $idFornecedor;
    private $nomeFantasia;
    private $cnpj;
    public function setAttrFornecedor($var){
        $obj=json_decode(fixJSON($var));
        if(isset($obj->idFornecedor)) $this->idFornecedor=$obj->idFornecedor;
        if(isset($obj->cnpj)){
            $this->nomeFantasia=$obj->nomeFantasia;
            $this->cnpj=$obj->cnpj;
        }
    }
    public function cadastrarFornecedor(){
        if($this->cadastrarEndereco()===false||$this->cadastrarContato()===false) return;
        $conn=$this->connect();
        $cadFornecedor=$conn->prepare("insert into fornecedor(nomeFantasia,cnpj,endereco,contato) values (?,?,?,?)");
        $cadFornecedor->bind_param("ssdd",$this->nomeFantasia,$this->cnpj,$this->idEndereco,$this->idContato);
        if(!$cadFornecedor->execute()) AJAXReturn("{'type':'error','msg':'Não foi possível cadastrar o fornecedor:<p>$cadFornecedor->error</p>'}");
        else AJAXReturn("{'type':'success','msg':'Cadastro do fornecedor $this->nomeFantasia, de ID $cadFornecedor->insert_id, finalizado com sucesso!'}");
    }
    public function buscarDadosFornecedor(){
        if($this->checkExistence("fornecedor","id",$this->idFornecedor)===false){return;}
        $this->idEndereco=$this->getValue("endereco","fornecedor","id",$this->idFornecedor);
        $this->idContato=$this->getValue("contato","fornecedor","id",$this->idFornecedor);
        echo fixJSON("{'idFornecedor':'$this->idFornecedor',
            'nomeFantasia':'".$this->getValue('nomeFantasia','fornecedor','id',$this->idFornecedor)."',
            'cnpj':'".$this->getValue('cnpj','fornecedor','id',$this->idFornecedor)."',".
            $this->buscarDadosEndereco().",".
            $this->buscarDadosContato()."}");
    }
    public function atualizarFornecedor(){
        $this->idContato=$this->getValue("contato","fornecedor","id",$this->idFornecedor);
        $this->idEndereco=$this->getValue("endereco","fornecedor","id",$this->idFornecedor);
        if($this->atualizarEndereco()===false||$this->atualizarContato()===false) return;
        $conn=$this->connect();
        $updFornecedor=$conn->prepare("update fornecedor set cnpj=?,nomeFantasia=? where id=?");
        $updFornecedor->bind_param("ssd",$this->cnpj,$this->nomeFantasia,$this->idFornecedor);
        if(!$updFornecedor->execute()) AJAXReturn("{'type':'error','msg':'Não foi possível atualizar o fornecedor:<p>$updFornecedor->error</p>'}");
        else AJAXReturn("{'type':'success','msg':'Atualização do fornecedor $this->nomeFantasia, de ID $this->idFornecedor, finalizada com sucesso!'}");
    }
    public function excluirFornecedor(){
        if($this->checkExistence('fornecedor','id',$this->idFornecedor)===false) return;
        $this->nomeFantasia=$this->getValue('nomeFantasia','fornecedor','id',$this->idFornecedor);
        $this->idContato=$this->getValue('contato','fornecedor','id',$this->idFornecedor);
        $this->idEndereco=$this->getValue('endereco','fornecedor','id',$this->idFornecedor);
        if($this->excluirEndereco()===false||$this->excluirContato()===false) return;
        $conn=$this->connect();
        $delFornecedor=$conn->prepare('delete from fornecedor where id=?');
        $delFornecedor->bind_param("d",$this->idFornecedor);
        if(!$delFornecedor->execute()) AJAXReturn("{'type':'error','msg':'Não foi possível excluir o fornecedor $this->nomeFantasia:<p>$delFornecedor->error</p>'}");
        else AJAXReturn("{'type':'success','msg':'Exclusão do fornecedor $this->nomeFantasia, de ID $this->idFornecedor, finalizada com sucesso!'}");
    }
}