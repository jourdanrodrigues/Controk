<?php
class Fornecedor extends Contato {
    private $idFornecedor;
    private $nomeFantasia;
    private $cnpj;
    public function setAttrFornecedor($idFornecedor,$nomeFantasia,$cnpj){
        $this->idFornecedor=$idFornecedor;
        $this->nomeFantasia=$nomeFantasia;
        $this->cnpj=$cnpj;
    }
    public function cadastrarFornecedor(){
        if($this->cadastrarEndereco()===false||$this->cadastrarContato()===false) return;
        $mysqli=$this->conectar();
        $cadFornecedor=$mysqli->prepare("insert into fornecedor(nomeFantasia,cnpj,endereco,contato) values (?,?,?,?)");
        $cadFornecedor->bind_param("ssdd",$this->nomeFantasia,$this->cnpj,$this->idEndereco,$this->idContato);
        if(!$cadFornecedor->execute()) echo "<span class='retorno' data-type='error'>Não foi possível cadastrar o fornecedor:<p>$cadFornecedor->error</p></span>";
        else echo "<span class='retorno' data-type='success'>Cadastro do fornecedor $this->nomeFantasia, de ID $cadFornecedor->insert_id, finalizado com sucesso!</span>";
    }
    public function buscarDadosFornecedor(){
            if($this->verificarExistencia('fornecedor','id',$this->idFornecedor)===false){return;}
        $this->nomeFantasia=$this->pegarValor('nomeFantasia','fornecedor','id',$this->idFornecedor);
        $this->cnpj=$this->pegarValor('cnpj','fornecedor','id',$this->idFornecedor);
        $this->idEndereco=$this->pegarValor('endereco','fornecedor','id',$this->idFornecedor);
        $this->idContato=$this->pegarValor('contato','fornecedor','id',$this->idFornecedor);
        echo "<input type='text' class='idFornecedor' value='$this->idFornecedor'>";
        echo "<input type='text' class='nomeFantasia' value='$this->nomeFantasia'>";
        echo "<input type='text' class='cnpj' value='$this->cnpj'>";
        $this->buscarDadosEndereco();
        $this->buscarDadosContato();
    }
    public function atualizarFornecedor(){
        $this->idContato=$this->pegarValor('contato','fornecedor','id',$this->idFornecedor);
        $this->idEndereco=$this->pegarValor('endereco','fornecedor','id',$this->idFornecedor);
        if($this->atualizarEndereco()===false||$this->atualizarContato()===false) return;
        $mysqli=$this->conectar();
        $updFornecedor=$mysqli->prepare("update fornecedor set cnpj=?,nomeFantasia=? where id=?");
        $updFornecedor->bind_param("ssd",$this->cnpj,$this->nomeFantasia,$this->idFornecedor);
        if(!$updFornecedor->execute()) echo "<span class='retorno' data-type='error'>Não foi possível atualizar o fornecedor:<p>$updFornecedor->error</p></span>";
        else echo "<span class='retorno' data-type='success'>Atualização do fornecedor $this->nomeFantasia, de ID $this->idFornecedor, finalizada com sucesso!</span>";
    }
    public function excluirFornecedor(){
        if($this->verificarExistencia('fornecedor','id',$this->idFornecedor)===false) return;
        $this->nomeFantasia=$this->pegarValor('nomeFantasia','fornecedor','id',$this->idFornecedor);
        $this->idContato=$this->pegarValor('contato','fornecedor','id',$this->idFornecedor);
        $this->idEndereco=$this->pegarValor('endereco','fornecedor','id',$this->idFornecedor);
        if($this->excluirEndereco()===false||$this->excluirContato()===false) return;
        $mysqli=$this->conectar();
        $delFornecedor=$mysqli->prepare('delete from fornecedor where id=?');
        $delFornecedor->bind_param("d",$this->idFornecedor);
        if(!$delFornecedor->execute()) echo "<span class='retorno' data-type='error'>Não foi possível excluir o fornecedor $this->nomeFantasia:<p>$delFornecedor->error</p></span>";
        else echo "<span class='retorno' data-type='success'>Exclusão do fornecedor $this->nomeFantasia, de ID $this->idFornecedor, finalizada com sucesso!</span>";
    }
}