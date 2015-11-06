<?php
class Endereco extends Connection {
    protected $idEndereco;
    protected $rua;
    protected $numero;
    protected $complemento;
    protected $cep;
    protected $bairro;
    protected $cidade;
    protected $estado;
    public function setAttrEndereco($var){
        $obj=json_decode(fixJSON($var));
        $this->rua=$obj->rua;
        $this->numero=$obj->numero;
        $this->complemento=$obj->complemento;
        $this->cep=$obj->cep;
        $this->bairro=$obj->bairro;
        $this->cidade=$obj->cidade;
        $this->estado=$obj->estado;
    }
    public function cadastrarEndereco(){
        $mysqli=$this->connect();
        $cadEndereco=$mysqli->prepare('insert into endereco(rua,numero,complemento,cep,bairro,cidade,estado) values (?,?,?,?,?,?,?)');
        $cadEndereco->bind_param("sdsssss",$this->rua,$this->numero,$this->complemento,$this->cep,$this->bairro,$this->cidade,$this->estado);
        if(!$cadEndereco->execute()){
            AJAXReturn("{'type':'error','msg':'Não foi possível cadastrar o endereço:<p>$cadEndereco->error</p>'}");
            return false;
        }else{
            $this->idEndereco=$cadEndereco->insert_id;
            return true;
        }
    }
    public function buscarDadosEndereco(){
        return "'rua':'".$this->getValue('rua','endereco','id',$this->idEndereco)."',
                'numero':".$this->getValue('numero','endereco','id',$this->idEndereco).",
                'complemento':'".$this->getValue('complemento','endereco','id',$this->idEndereco)."',
                'cep':'".$this->getValue('cep','endereco','id',$this->idEndereco)."',
                'bairro':'".$this->getValue('bairro','endereco','id',$this->idEndereco)."',
                'cidade':'".$this->getValue('cidade','endereco','id',$this->idEndereco)."',
                'estado':'".$this->getValue('estado','endereco','id',$this->idEndereco)."'";
    }
    public function atualizarEndereco(){
        $mysqli=$this->connect();
        $updEndereco=$mysqli->prepare("update endereco set rua=?,numero=?,complemento=?,cep=?,bairro=?,cidade=?,estado=? where id=?");
        $updEndereco->bind_param("sdsssssd",$this->rua,$this->numero,$this->complemento,$this->cep,$this->bairro,$this->cidade,$this->estado,$this->idEndereco);
        if(!$updEndereco->execute()){
            AJAXReturn("{'type':'error','msg':'Não foi possível atualizar o endereço:<p>$updEndereco->error</p>'}");
            return false;
        }
        return true;
    }
    public function excluirEndereco(){
        $mysqli=$this->connect();
        $delEndereco=$mysqli->prepare("delete from endereco where id=?");
        $delEndereco->bind_param("d",$this->idEndereco);
        if(!$delEndereco->execute()){
            AJAXReturn("{'type':'error','msg':'Não foi possível excluir o endereço:<p>$delEndereco->error</p>'}");
            return false;
        }
        return true;
    }
}