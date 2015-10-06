<?php
class Contato extends Endereco {
    protected $idContato;
    protected $email;
    protected $telCel;
    protected $telFixo;
    public function setAttrContato($email,$telCel,$telFixo){
        $this->email=$email;
        $this->telCel=$telCel;
        $this->telFixo=$telFixo;
    }
    public function cadastrarContato(){
        $mysqli=$this->conectar();
        $cadContato=$mysqli->prepare('insert into contato(email,telCel,telFixo) values (?,?,?)');
        $cadContato->bind_param("sss",$this->email,$this->telCel,$this->telFixo);
        if(!$cadContato->execute()){
            echo "<span class='retorno' data-type='error'>Não foi possível cadastrar o contato:<p>$cadContato->error</p></span>";
            return false;
        }else{
            $this->idContato=$cadContato->insert_id;
            return true;
        }
    }
    public function buscarDadosContato(){
        $this->email=$this->pegarValor('email','contato','id',$this->idContato);
        $this->telCel=$this->pegarValor('telCel','contato','id',$this->idContato);
        $this->telFixo=$this->pegarValor('telFixo','contato','id',$this->idContato);
        echo "<input type='text' class='email' value='$this->email'>";
        echo "<input type='text' class='telCel' value='$this->telCel'>";
        echo "<input type='text' class='telFixo' value='$this->telFixo'>";
    }
    public function atualizarContato(){
        $mysqli=$this->conectar();
        $updContato=$mysqli->prepare("update contato set email=?,telCel=?,telFixo=? where id=?");
        $updContato->bind_param("sssd",$this->email,$this->telCel,$this->telFixo,$this->idContato);
        if(!$updContato->execute()){
            echo "<span class='retorno' data-type='error'>Não foi possível atualizar o contato:<p>$updContato->error</span>";
            return false;
        }
        return true;
    }
    public function excluirContato(){
        $mysqli=$this->conectar();
        $delContato=$mysqli->prepare("delete from contato where id=?");
        $delContato->bind_param("d",$this->idContato);
        if(!$delContato->execute()){
            echo "<span class='retorno' data-type='error'>Não foi possível excluir o contato:<p>$delContato->error</p></span>";
            return false;
        }
        return true;
    }
}