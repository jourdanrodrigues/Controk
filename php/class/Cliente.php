<?php
class Cliente extends Pessoa{
    protected $cpf;
    public function Cliente($var){
        $this->connect();
        $obj=json_decode(fixJSON($var));
        if(isset($obj->id)) $this->id=$obj->id;
        if(isset($obj->nome)){
            $this->nome=$obj->nome;
            $this->cpf=$obj->cpf;
        }
    }
    public function atualizar(){
        $values=$this->getValue(["contato","endereco"],"cliente","id",$this->id);
        $this->idContato=$values->contato;
        $this->idEndereco=$values->endereco;
        if($this->atualizarEndereco()!==true||$this->atualizarContato()!==true) return;
        $upd=$this->conn->prepare("update cliente set nome=?,cpf=? where id=?");
        $upd->bind_param("sssd",$this->nome,$this->cpf,$this->id);
        if(!$upd->execute()) AJAXReturn("error","Não foi possível atualizar o cliente:<p>$upd->error</p>");
        else AJAXReturn("success","Atualização do cliente $this->nome, de ID $this->id, finalizada com sucesso!");
    }
}