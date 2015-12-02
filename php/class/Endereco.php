<?php
class Endereco extends Connection {
    protected $idEndereco;
    protected $logradouro;
    protected $log_nome;
    protected $numero;
    protected $complemento;
    protected $cep;
    protected $bairro;
    protected $cidade;
    protected $estado;
    public function setAttrEndereco($var){
        $obj=json_decode(fixJSON($var));
        $this->logradouro=$obj->logradouro;
        $this->log_nome=$obj->log_nome;
        $this->numero=$obj->numero;
        $this->complemento=$obj->complemento;
        $this->cep=$obj->cep;
        $this->bairro=$obj->bairro;
        $this->cidade=$obj->cidade;
        $this->estado=$obj->estado;
    }
    protected function cadastrarEndereco(){
        $cad=$this->conn->prepare('insert into endereco(logradouro,log_nome,numero,complemento,cep,bairro,cidade,estado) values (?,?,?,?,?,?,?,?)');
        $cad->bind_param("ssdsssss",$this->logradouro,$this->log_nome,$this->numero,$this->complemento,$this->cep,$this->bairro,$this->cidade,$this->estado);
        if($cad->execute()) $this->idEndereco=$cad->insert_id;
        else return "{'errno':'$cad->errno','error':'$cad->error'}";
    }
    protected function dadosEndereco(){
        $data=$this->conn->prepare("select log_nome,logradouro,numero,complemento,cep,bairro,cidade,estado from endereco where id=?");
        $data->bind_param("d",$this->idEndereco);
        if(!$data->execute()) AJAXReturn("{'type':'error','msg':'Não foi possível obter os dados:<p>($data->errno) $data->error</p>'}");
        else{
            $data->bind_result($log_nome,$logradouro,$numero,$complemento,$cep,$bairro,$cidade,$estado);
            $data->fetch();
            return "'log_nome':'$log_nome','logradouro':'$logradouro','numero':'$numero','complemento':'$complemento',
                    'cep':'$cep','bairro':'$bairro','cidade':'$cidade','estado':'$estado'";
        }
    }
    protected function atualizarEndereco(){
        $upd=$this->conn->prepare("update endereco set logradouro=?,log_nome=?,numero=?,complemento=?,cep=?,bairro=?,cidade=?,estado=? where id=?");
        $upd->bind_param("ssdsssssd",$this->logradouro,$this->log_nome,$this->numero,$this->complemento,$this->cep,$this->bairro,$this->cidade,$this->estado,$this->idEndereco);
        if(!$upd->execute()) return "{'errno':'$upd->errno','error':'$upd->error'}";
    }
    protected function excluirEndereco(){
        $del=$this->conn->prepare("delete from endereco where id=?");
        $del->bind_param("d",$this->idEndereco);
        if(!$del->execute()) return "{'errno':'$del->errno','error':'$del->error'}";
    }
}