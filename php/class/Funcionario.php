<?php
class Funcionario extends Cliente{
    private $idFuncionario;
    private $cargo;
    public function setAttrFuncionario($idFuncionario,$nome="",$cpf="",$cargo="",$obs=""){
        $this->idFuncionario=$idFuncionario;
        $this->nome=$nome;
        $this->cpf=$cpf;
        $this->cargo=$cargo;
        $this->obs=$obs;
    }
    public function cadastrarFuncionario(){
        if($this->cadastrarEndereco()===false||$this->cadastrarContato()===false) return;
        $mysqli=$this->connect();
        $cadFuncionario=$mysqli->prepare('insert into funcionario(nome,cpf,obs,cargo,endereco,contato) values (?,?,?,?,?,?)');
        $cadFuncionario->bind_param("ssssdd",$this->nome,$this->cpf,$this->obs,$this->cargo,$this->idEndereco,$this->idContato);
        if(!$cadFuncionario->execute()) echo "<span class='retorno' data-type='error'>Não foi possível cadastrar o funcionário:<p>$cadFuncionario->error<p></span>";
        else echo "<span class='retorno' data-type='success'>Cadastro do funcionário $this->nome, de ID $cadFuncionario->insert_id, finalizado com sucesso!</span>";
    }
    public function buscarDadosFuncionario(){
        if($this->checkExistence('funcionario','id',$this->idFuncionario)===false) return;
        $this->nome=$this->getValue('nome','funcionario','id',$this->idFuncionario);
        $this->cpf=$this->getValue('cpf','funcionario','id',$this->idFuncionario);
        $this->cargo=$this->getValue('cargo','funcionario','id',$this->idFuncionario);
        $this->obs=$this->getValue('obs','funcionario','id',$this->idFuncionario);
        $this->idEndereco=$this->getValue('endereco','funcionario','id',$this->idFuncionario);
        $this->idContato=$this->getValue('contato','funcionario','id',$this->idFuncionario);
        echo "<input type='text' class='idFuncionario' value='$this->idFuncionario'>";
        echo "<input type='text' class='nome' value='$this->nome'>";
        echo "<input type='text' class='cpf' value='$this->cpf'>";
        echo "<input type='text' class='cargo' value='$this->cargo'>";
        echo "<input type='text' class='obs' value='$this->obs'>";
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
        if(!$updFuncionario->execute()) echo "<span class='retorno' data-type='error'>Não foi possível atualizar o funcionário:<p>$updFuncionario->error</p></span>";
        else echo "<span class='retorno' data-type='success'>Atualização do funcionário $this->nome, de ID $this->idFuncionario, finalizada com sucesso!</span>";
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
        if(!$delFuncionario->execute()) echo "<span class='retorno' data-type='error'>Não foi possível excluir o funcionário:<p>$delFuncionario->error</p></span>";
        else echo "<span class='retorno' data-type='success'>Exclusão do funcionário $this->nome, de ID $this->idFuncionario, finalizada com sucesso!</span>";
    }
}