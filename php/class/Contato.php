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
    public function cadastrarContato(){
        $mysqli=$this->connect();
        $cadContato=$mysqli->prepare('insert into contato(email,telCel,telFixo) values (?,?,?)');
        $cadContato->bind_param("sss",$this->email,$this->telCel,$this->telFixo);
        if(!$cadContato->execute()){
            AJAXReturn("{'type':'error','msg':'Não foi possível cadastrar o contato:<p>$cadContato->error</p>'}");
            return false;
        }else{
            $this->idContato=$cadContato->insert_id;
            return true;
        }
    }
    public function buscarDadosContato(){
        $this->email=$this->getValue('email','contato','id',$this->idContato);
        $this->telCel=$this->getValue('telCel','contato','id',$this->idContato);
        $this->telFixo=$this->getValue('telFixo','contato','id',$this->idContato);
        generateReturnInputs(array(
            array("email",$this->email),
            array("telCel",$this->telCel),
            array("telFixo",$this->telFixo)
        ));
    }
    public function atualizarContato(){
        $mysqli=$this->connect();
        $updContato=$mysqli->prepare("update contato set email=?,telCel=?,telFixo=? where id=?");
        $updContato->bind_param("sssd",$this->email,$this->telCel,$this->telFixo,$this->idContato);
        if(!$updContato->execute()){
            AJAXReturn("{'type':'error','msg':'Não foi possível atualizar o contato:<p>$updContato->error</p>'}");
            return false;
        }
        return true;
    }
    public function excluirContato(){
        $mysqli=$this->connect();
        $delContato=$mysqli->prepare("delete from contato where id=?");
        $delContato->bind_param("d",$this->idContato);
        if(!$delContato->execute()){
            AJAXReturn("{'type':'error','msg':'Não foi possível excluir o contato:<p>$delContato->error</p>'}");
            return false;
        }
        return true;
    }
}