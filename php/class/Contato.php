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
        if($cad->execute()) $this->idContato=$cad->insert_id;
        else return "{'errno':'$cad->errno','error':'$cad->error'}";
    }
    protected function dadosContato(){
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
        if(!$upd->execute()) return "{'errno':'$upd->errno','error':'$upd->error'}";
    }
    protected function excluirContato(){
        $del=$this->conn->prepare("delete from contato where id=?");
        $del->bind_param("d",$this->idContato);
        if(!$del->execute()) return "{'errno':'$del->errno','error':'$del->error'}";
    }
}