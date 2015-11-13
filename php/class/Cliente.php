<?php
class Cliente extends Pessoa{
    protected $cpf;
    protected $obs;
    public function Cliente($var){
        $this->connect();
        $obj=json_decode(fixJSON($var));
        if(isset($obj->id)) $this->id=$obj->id;
        if(isset($obj->nome)){
            $this->nome=$obj->nome;
            $this->cpf=$obj->cpf;
            $this->obs=$obj->obs;
        }
    }
    public function cadastrar(){
        if($this->cadastrarEndereco()!==true||$this->cadastrarContato()!==true) return;
        $cad=$this->conn->prepare("insert into cliente(nome,cpf,obs,endereco,contato) values (?,?,?,?,?)");
        $cad->bind_param("sssdd",$this->nome,$this->cpf,$this->obs,$this->idEndereco,$this->idContato);
        if(!$cad->execute()) AJAXReturn("error","Não foi possível cadastrar o cliente:\n\n$cad->error.");
        else AJAXReturn("success","Cadastro do cliente $this->nome, de ID $cad->insert_id, finalizado com sucesso!");
    }
    public function atualizar(){
        $values=$this->getValue(["contato","endereco"],"cliente","id",$this->id);
        $this->idContato=$values->contato;
        $this->idEndereco=$values->endereco;
        if($this->atualizarEndereco()!==true||$this->atualizarContato()!==true) return;
        $upd=$this->conn->prepare("update cliente set nome=?,cpf=?,obs=? where id=?");
        $upd->bind_param("sssd",$this->nome,$this->cpf,$this->obs,$this->id);
        if(!$upd->execute()) AJAXReturn("error","Não foi possível atualizar o cliente:<p>$upd->error</p>");
        else AJAXReturn("success","Atualização do cliente $this->nome, de ID $this->id, finalizada com sucesso!");
    }
}