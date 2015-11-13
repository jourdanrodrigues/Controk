<?php
class Contato extends Endereco {
    protected $idContato;
    protected $email;
    protected $telCel;
    protected $telFixo;
    public function setAttrContato($var){
        $obj=json_decode(fixJSON($var));
        $this->email=$obj->email;
        $this->telCel=$obj->telCel;
        $this->telFixo=$obj->telFixo;
    }
    protected function cadastrarContato(){
        $cad=$this->conn->prepare('insert into contato(email,telCel,telFixo) values (?,?,?)');
        $cad->bind_param("sss",$this->email,$this->telCel,$this->telFixo);
        return !$cad->execute()?$cad:true;
    }
    protected function mostrarDadosContato(){
        $data=$this->conn->prepare("select email,telCel,telFixo from contato where id=?");
        $data->bind_param("d",$this->idContato);
        if(!$data->execute()) AJAXReturn("error","Não foi possível obter os dados:<p>($data->errno) $data->error</p>");
        else{
            $data->bind_result($email,$telCel,$telFixo);
            $data->fetch();
            return "'email':'$email','telCel':'$telCel','telFixo':'$telFixo'";
        }
    }
    protected function atualizarContato(){
        $upd=$this->conn->prepare("update contato set email=?,telCel=?,telFixo=? where id=?");
        $upd->bind_param("sssd",$this->email,$this->telCel,$this->telFixo,$this->idContato);
        return !$upd->execute()?$upd:true;
    }
    protected function excluirContato(){
        $del=$this->conn->prepare("delete from contato where id=?");
        $del->bind_param("d",$this->idContato);
        return !$del->execute()?$del:true;
    }
}