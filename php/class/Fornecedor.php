<?php
class Fornecedor extends Pessoa {
    private $cnpj;
    public function Fornecedor($var){
        $this->connect();
        $obj=json_decode(fixJSON($var));
        if(isset($obj->id)) $this->id=$obj->id;
        if(isset($obj->cnpj)){
            $this->nome=$obj->nome;
            $this->cnpj=$obj->cnpj;
        }
    }
    public function atualizar(){
        $values=$this->getValue(["endereco","contato"],"fornecedor","id",$this->id);
        $this->idEndereco=$values->endereco;
        $this->idContato=$values->contato;
        if($this->atualizarEndereco()===false||$this->atualizarContato()===false) return;
        $upd=$this->conn->prepare("update fornecedor set cnpj=?,nome=? where id=?");
        $upd->bind_param("ssd",$this->cnpj,$this->nome,$this->id);
        if(!$upd->execute()) AJAXReturn("error","Não foi possível atualizar o fornecedor:<p>$upd->error</p>");
        else AJAXReturn("success","Atualização do fornecedor $this->nome, de ID $this->id, finalizada com sucesso!");
    }
}