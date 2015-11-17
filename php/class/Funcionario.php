<?php
class Funcionario extends Cliente{
    private $cargo;
    public function Funcionario($var){
        $this->connect();
        $obj=json_decode(fixJSON($var));
        if(isset($obj->id)) $this->id=$obj->id;
        if(isset($obj->cpf)){
            $this->nome=$obj->nome;
            $this->cpf=$obj->cpf;
            $this->cargo=$obj->cargo;
            $this->obs=$obj->obs;
        }
    }
    public function atualizar(){
        $values=$this->getValue(["endereco","contato"],"funcionario","id",$this->id);
        $this->idEndereco=$values->endereco;
        $this->idContato=$values->contato;
        if($this->atualizarEndereco()===false||$this->atualizarContato()===false) return;
        $upd=$this->conn->prepare("update funcionario set nome=?,cpf=?,obs=?,cargo=? where id=?");
        $upd->bind_param("ssssd",$this->nome,$this->cpf,$this->obs,$this->cargo,$this->id);
        if(!$upd->execute()) AJAXReturn("error","Não foi possível atualizar o funcionário:<p>$upd->error</p>");
        else AJAXReturn("success","Atualização do funcionário $this->nome, de ID $this->id, finalizada com sucesso!");
    }
}