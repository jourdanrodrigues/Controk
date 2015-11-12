<?php
class Fornecedor extends Contato {
    private $id;
    private $nome;
    private $cnpj;
    public function Fornecedor($var){
        $this->connect();
        $obj=json_decode(fixJSON($var));
        if(isset($obj->id)) $this->id=$obj->id;
        if(isset($obj->cnpj)){
            $this->nome=$obj->nome;
            $this->cnpj=$obj->cnpj;
        }
    }
    public function cadastrar(){
        if($this->cadastrarEndereco()===false||$this->cadastrarContato()===false) return;
        $cad=$this->conn->prepare("insert into fornecedor(nomeFantasia,cnpj,endereco,contato) values (?,?,?,?)");
        $cad->bind_param("ssdd",$this->nome,$this->cnpj,$this->idEndereco,$this->idContato);
        if(!$cad->execute()) AJAXReturn("error","Não foi possível cadastrar o fornecedor:<p>$cad->error</p>");
        else AJAXReturn("success","Cadastro do fornecedor $this->nome, de ID $cad->insert_id, finalizado com sucesso!");
    }
    public function listar(){
        $list=$this->conn->prepare("select id,nomeFantasia,cnpj from fornecedor");
        if(!$list->execute()) AJAXReturn("error","Não foi possível listar os fornecedor:<p>($list->errno) $list->error<p>");
        else{
            $list->bind_result($id,$nome,$cnpj);
            $listResult="";
            while($list->fetch()) $listResult.="{'id':$id,'nome':'$nome','cpf':'$cnpj'},";
            echo fixJSON("[".str_replace(",]","]","$listResult]"));
        }
    }
    public function mostrarDados(){
        $values=$this->getValue(["endereco","contato"],"fornecedor","id",$this->id);
        $this->idEndereco=$values->endereco;
        $this->idContato=$values->contato;
        echo fixJSON("{".$this->mostrarDadosEndereco().",".$this->mostrarDadosContato()."}");
    }
    public function atualizar(){
        $values=$this->getValue(["endereco","contato"],"fornecedor","id",$this->id);
        $this->idEndereco=$values->endereco;
        $this->idContato=$values->contato;
        if($this->atualizarEndereco()===false||$this->atualizarContato()===false) return;
        $upd=$this->conn->prepare("update fornecedor set cnpj=?,nomeFantasia=? where id=?");
        $upd->bind_param("ssd",$this->cnpj,$this->nome,$this->id);
        if(!$upd->execute()) AJAXReturn("error","Não foi possível atualizar o fornecedor:<p>$upd->error</p>");
        else AJAXReturn("success","Atualização do fornecedor $this->nome, de ID $this->id, finalizada com sucesso!");
    }
    public function excluir(){
        $del=$this->conn->prepare("delete from fornecedor where id=?");
        $del->bind_param("d",$id);
        $errors="";
        foreach($this->id as $id){
            $values=$this->getValue(["contato","endereco"],"fornecedor","id",$id);
            $this->idContato=$values->contato;
            $this->idEndereco=$values->endereco;
            if($delE=$this->excluirEndereco()!==true||$delC=$this->excluirContato()!==true||!$del->execute()){
                switch(true){
                    case $delE:$errorDet=[$delE->errno,$delE->error]; break;
                    case $delC:$errorDet=[$delC->errno,$delC->error]; $delE->rollback(); break;
                    case $del:$errorDet=[$del->errno,$del->error]; $delE->rollback(); $delC->rollback();
                }
                array_push($errors,[$this->getValue("nome","fornecedor","id",$id),$errorDet]);
            }
        }
        $es=($s=(is_array($errors)?count($errors):count($this->id))>1?"s":"")=="s"?"es":"";
        if(is_array($errors)){
            $errorList="";
            foreach($errors as $error) $errorList.="<p>".$error[0].": erro ".$error[1][0]." (".$error[1][1].");</p>";
            AJAXReturn("error",count($this->id)-count($errors)." fornecedor$es excluído$s, com o$s erro$s a seguir:$errorList");
        }else AJAXReturn("success","Exclusão de ".count($this->id)." fornecedor$es finalizada com sucesso!");
    }
}