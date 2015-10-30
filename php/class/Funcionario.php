<?php
class Funcionario extends Cliente{
    private $idFuncionario;
    private $cargo;
    public function setAttrFuncionario($var){
        $obj=json_decode(fixJSON($var));
        if(isset($obj->idFuncionario)) $this->idFuncionario=$obj->idFuncionario;
        if(isset($obj->cpf)){
            $this->nome=$obj->nome;
            $this->cpf=$obj->cpf;
            $this->cargo=$obj->cargo;
            $this->obs=$obj->obs;
        }
    }
    public function cadastrarFuncionario(){
        if($this->cadastrarEndereco()===false||$this->cadastrarContato()===false) return;
        $conn=$this->connect();
        $cadFuncionario=$conn->prepare('insert into funcionario(nome,cpf,obs,cargo,endereco,contato) values (?,?,?,?,?,?)');
        $cadFuncionario->bind_param("ssssdd",$this->nome,$this->cpf,$this->obs,$this->cargo,$this->idEndereco,$this->idContato);
        if(!$cadFuncionario->execute()) AJAXReturn("{'type':'error','msg':'Não foi possível cadastrar o funcionário:<p>$cadFuncionario->error<p>'}");
        else AJAXReturn("{'type':'success','msg':'Cadastro do funcionário $this->nome, de ID $cadFuncionario->insert_id, finalizado com sucesso!'}");
    }
    public function buscarDadosFuncionario(){
        if($this->checkExistence('funcionario','id',$this->idFuncionario)===false) return;
        $this->nome=$this->getValue('nome','funcionario','id',$this->idFuncionario);
        $this->cpf=$this->getValue('cpf','funcionario','id',$this->idFuncionario);
        $this->cargo=$this->getValue('cargo','funcionario','id',$this->idFuncionario);
        $this->obs=$this->getValue('obs','funcionario','id',$this->idFuncionario);
        $this->idEndereco=$this->getValue('endereco','funcionario','id',$this->idFuncionario);
        $this->idContato=$this->getValue('contato','funcionario','id',$this->idFuncionario);
        generateReturnInputs(array(
            array("idFuncionario",$this->idFuncionario),
            array("nome",$this->nome),
            array("cpf",$this->cpf),
            array("cargo",$this->cargo),
            array("obs",$this->obs),
        ));
        $this->buscarDadosEndereco();
        $this->buscarDadosContato();
    }
    public function atualizarFuncionario(){
        $this->idEndereco=$this->getValue('endereco','funcionario','id',$this->idFuncionario);
        $this->idContato=$this->getValue('contato','funcionario','id',$this->idFuncionario);
        if($this->atualizarEndereco()===false||$this->atualizarContato()===false) return;
        $mysqli=$this->connect();
        $updFuncionario=$mysqli->prepare("update funcionario set nome=?,cpf=?,obs=?,cargo=? where id=?");
        $updFuncionario->bind_param("ssssd",$this->nome,$this->cpf,$this->obs,$this->cargo,$this->idFuncionario);
        if(!$updFuncionario->execute()) AJAXReturn("{'type':'error','msg':'Não foi possível atualizar o funcionário:<p>$updFuncionario->error</p>'}");
        else AJAXReturn("{'type':'success','msg':'Atualização do funcionário $this->nome, de ID $this->idFuncionario, finalizada com sucesso!'}");
    }
    public function excluirFuncionario(){
        if($this->checkExistence('funcionario','id',$this->idFuncionario)===false) return;
        $this->nome=$this->getValue('nome','funcionario','id',$this->idFuncionario);
        $this->idContato=$this->getValue('contato','funcionario','id',$this->idFuncionario);
        $this->idEndereco=$this->getValue('endereco','funcionario','id',$this->idFuncionario);
        if($this->excluirEndereco()===false||$this->excluirContato()===false) return;
        $mysqli=$this->connect();
        $delFuncionario=$mysqli->prepare("delete from funcionario where id=?");
        $delFuncionario->bind_param("d",$this->idFuncionario);
        if(!$delFuncionario->execute()) AJAXReturn("{'type':'error','msg':'Não foi possível excluir o funcionário:<p>$delFuncionario->error</p>'}");
        else AJAXReturn("{'type':'success','msg':'Exclusão do funcionário $this->nome, de ID $this->idFuncionario, finalizada com sucesso!'}");
    }
}