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
    public function cadastrar(){
        if($this->cadastrarEndereco()===false||$this->cadastrarContato()===false) return;
        $cad=$conn->prepare('insert into funcionario(nome,cpf,obs,cargo,endereco,contato) values (?,?,?,?,?,?)');
        $cad->bind_param("ssssdd",$this->nome,$this->cpf,$this->obs,$this->cargo,$this->idEndereco,$this->idContato);
        if(!$cad->execute()) AJAXReturn("error","Não foi possível cadastrar o funcionário:<p>$cad->error<p>");
        else AJAXReturn("success","Cadastro do funcionário $this->nome, de ID $cad->insert_id, finalizado com sucesso!");
    }
    public function listar(){
        $list=$this->conn->prepare("select id,nome,cpf,obs,cargo from funcionario");
        if(!$list->execute()) AJAXReturn("error","Não foi possível listar os funcionários:<p>($list->errno) $list->error<p>");
        else{
            $list->bind_result($id,$nome,$cpf,$obs,$cargo);
            $listResult="";
            while($list->fetch()) $listResult.="{'id':$id,'nome':'$nome','cpf':'$cpf','cargo':'$cargo','obs':'$obs'},";
            echo fixJSON("[".str_replace(",]","]","$listResult]"));
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