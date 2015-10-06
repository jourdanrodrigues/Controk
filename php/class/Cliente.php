<?php
class Cliente extends Contato{
    private $idCliente;
    protected $nome;
    protected $cpf;
    protected $obs;
    public function setAttrCliente($idCliente,$nome="",$cpf="",$obs=""){
        $this->idCliente=$idCliente;
        $this->nome=$nome;
        $this->cpf=$cpf;
        $this->obs=$obs;
    }
    public function cadastrarCliente(){
        if($this->cadastrarEndereco()===false||$this->cadastrarContato()===false) return;
        $mysqli=$this->conectar();
        $cadCliente=$mysqli->prepare('insert into cliente(nome,cpf,obs,endereco,contato) values (?,?,?,?,?)');
        $cadCliente->bind_param("sssdd",$this->nome,$this->cpf,$this->obs,$this->idEndereco,$this->idContato);
        if(!$cadCliente->execute()) echo "<span class='retorno' data-type='error'>Não foi possível cadastrar o cliente:\n\n$cadCliente->error.</span>";
        else echo "<span class='retorno' data-type='success'>Cadastro do cliente $this->nome, de ID $cadCliente->insert_id, finalizado com sucesso!</span>";
    }
    public function buscarDadosCliente(){
        if($this->verificarExistencia('cliente','id',$this->idCliente)===false) return;
        $this->nome=$this->pegarValor('nome','cliente','id',$this->idCliente);
        $this->cpf=$this->pegarValor('cpf','cliente','id',$this->idCliente);
        $this->obs=$this->pegarValor('obs','cliente','id',$this->idCliente);
        $this->idEndereco=$this->pegarValor('endereco','cliente','id',$this->idCliente);
        $this->idContato=$this->pegarValor('contato','cliente','id',$this->idCliente);
        echo "<input type='text' class='idCliente' value='$this->idCliente'>";
        echo "<input type='text' class='nome' value='$this->nome'>";
        echo "<input type='text' class='cpf' value='$this->cpf'>";
        echo "<input type='text' class='obs' value='$this->obs'>";
        $this->buscarDadosEndereco();
        $this->buscarDadosContato();
    }
    public function atualizarCliente(){
        $mysqli=$this->conectar();
        $this->idContato=$this->pegarValor('contato','cliente','id',$this->idCliente);
        $this->idEndereco=$this->pegarValor('endereco','cliente','id',$this->idCliente);
        if($this->atualizarEndereco()===false||$this->atualizarContato()===false) return;
        $updCliente=$mysqli->prepare("update cliente set nome=?,cpf=?,obs=? where id=?");
        $updCliente->bind_param("sssd",$this->nome,$this->cpf,$this->obs,$this->idCliente);
        if(!$updCliente->execute()) echo "<span class='retorno' data-type='error'>Não foi possível atualizar o cliente:<p>$updCliente->error</p></span>";
        else echo "<span class='retorno' data-type='success'>Atualização do cliente $this->nome, de ID $this->idCliente, finalizada com sucesso!</span>";
    }
    public function excluirCliente(){
        if($this->verificarExistencia('cliente','id',$this->idCliente)===false) return;
        $this->nome=$this->pegarValor('nome','cliente','id',$this->idCliente);
        $this->idContato=$this->pegarValor('contato','cliente','id',$this->idCliente);
        $this->idEndereco=$this->pegarValor('endereco','cliente','id',$this->idCliente);
        if($this->excluirEndereco()===false||$this->excluirContato()===false) return;
        $mysqli=$this->conectar();
        $delCliente=$mysqli->prepare("delete from cliente where id=?");
        $delCliente->bind_param("d",$this->idCliente);
        if(!$delCliente->execute()) echo "<span class='retorno' data-type='error'>Não foi possível excluir o cliente:<p>$delCliente->error</p></span>";
        else echo "<span class='retorno' data-type='success'>Exclusão do cliente $this->nome, de ID $this->idCliente, finalizada com sucesso!</span>";
    }
}
?>