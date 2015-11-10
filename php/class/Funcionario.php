<?php
class Funcionario extends Cliente{
    private $id;
    private $cargo;
    public function Funcionario($var){
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
        $conn=$this->connect();
        $cadFuncionario=$conn->prepare('insert into funcionario(nome,cpf,obs,cargo,endereco,contato) values (?,?,?,?,?,?)');
        $cadFuncionario->bind_param("ssssdd",$this->nome,$this->cpf,$this->obs,$this->cargo,$this->idEndereco,$this->idContato);
        if(!$cadFuncionario->execute()) AJAXReturn("{'type':'error','msg':'Não foi possível cadastrar o funcionário:<p>$cadFuncionario->error<p>'}");
        else AJAXReturn("{'type':'success','msg':'Cadastro do funcionário $this->nome, de ID $cadFuncionario->insert_id, finalizado com sucesso!'}");
    }
    public function buscarDados(){
        if($this->checkExistence('funcionario','id',$this->id)===false) return;
        $this->idEndereco=$this->getValue('endereco','funcionario','id',$this->id);
        $this->idContato=$this->getValue('contato','funcionario','id',$this->id);
        echo fixJSON("{'id':$this->id,
            'nome':'".$this->getValue('nome','funcionario','id',$this->id)."',
            'cpf':'".$this->getValue('cpf','funcionario','id',$this->id)."',
            'cargo':'".$this->getValue('cargo','funcionario','id',$this->id)."',
            'obs':'".$this->getValue('obs','funcionario','id',$this->id)."',".
            $this->buscarDadosEndereco().",".
            $this->buscarDadosContato()."}");
    }
    public function atualizar(){
        $this->idEndereco=$this->getValue('endereco','funcionario','id',$this->id);
        $this->idContato=$this->getValue('contato','funcionario','id',$this->id);
        if($this->atualizarEndereco()===false||$this->atualizarContato()===false) return;
        $mysqli=$this->connect();
        $updFuncionario=$mysqli->prepare("update funcionario set nome=?,cpf=?,obs=?,cargo=? where id=?");
        $updFuncionario->bind_param("ssssd",$this->nome,$this->cpf,$this->obs,$this->cargo,$this->id);
        if(!$updFuncionario->execute()) AJAXReturn("{'type':'error','msg':'Não foi possível atualizar o funcionário:<p>$updFuncionario->error</p>'}");
        else AJAXReturn("{'type':'success','msg':'Atualização do funcionário $this->nome, de ID $this->id, finalizada com sucesso!'}");
    }
    public function excluir(){
        if($this->checkExistence('funcionario','id',$this->id)===false) return;
        $this->nome=$this->getValue('nome','funcionario','id',$this->id);
        $this->idContato=$this->getValue('contato','funcionario','id',$this->id);
        $this->idEndereco=$this->getValue('endereco','funcionario','id',$this->id);
        if($this->excluirEndereco()===false||$this->excluirContato()===false) return;
        $mysqli=$this->connect();
        $delFuncionario=$mysqli->prepare("delete from funcionario where id=?");
        $delFuncionario->bind_param("d",$this->id);
        if(!$delFuncionario->execute()) AJAXReturn("{'type':'error','msg':'Não foi possível excluir o funcionário:<p>$delFuncionario->error</p>'}");
        else AJAXReturn("{'type':'success','msg':'Exclusão do funcionário $this->nome, de ID $this->id, finalizada com sucesso!'}");
    }
}