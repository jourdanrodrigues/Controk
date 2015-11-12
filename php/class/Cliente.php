<?php
class Cliente extends Contato{
    protected $id;
    protected $nome;
    protected $cpf;
    protected $obs;
    public function Cliente($var){
        $this->connect();
        $obj=json_decode(fixJSON($var));
        if(isset($obj->id)) $this->id=$obj->id;
        if(isset($obj->nome)){
            $this->nome=$obj->nome;
            $this->cpf=$obj->cpf;
            $this->obs=$obj->obs;
        }
    }
    public function cadastrar(){
        if($this->cadastrarEndereco()!==true||$this->cadastrarContato()!==true) return;
        $cad=$this->conn->prepare("insert into cliente(nome,cpf,obs,endereco,contato) values (?,?,?,?,?)");
        $cad->bind_param("sssdd",$this->nome,$this->cpf,$this->obs,$this->idEndereco,$this->idContato);
        if(!$cad->execute()) AJAXReturn("error","Não foi possível cadastrar o cliente:\n\n$cad->error.");
        else AJAXReturn("success","Cadastro do cliente $this->nome, de ID $cad->insert_id, finalizado com sucesso!");
    }
    public function listar(){
        $list=$this->conn->prepare("select id,nome,cpf,obs from cliente");
        if(!$list->execute()) AJAXReturn("error","Não foi possível listar os clientes:<p>($list->errno) $list->error<p>");
        else{
            $list->bind_result($id,$nome,$cpf,$obs);
            $listResult="";
            while($list->fetch()) $listResult.="{'id':$id,'nome':'$nome','cpf':'$cpf','obs':'$obs'},";
            echo fixJSON("[".str_replace(",]","]","$listResult]"));
        }
    }
    public function mostrarDados($target){
        $values=$this->getValue(["endereco","contato","obs"],$target,"id",$this->id);
        $this->idEndereco=$values->endereco;
        $this->idContato=$values->contato;
        echo fixJSON("{'obs':'$values->obs',".$this->mostrarDadosEndereco().",".$this->mostrarDadosContato()."}");
    }
    public function atualizar(){
        $values=$this->getValue(["contato","endereco"],"cliente","id",$this->id);
        $this->idContato=$values->contato;
        $this->idEndereco=$values->endereco;
        if($this->atualizarEndereco()!==true||$this->atualizarContato()!==true) return;
        $upd=$this->conn->prepare("update cliente set nome=?,cpf=?,obs=? where id=?");
        $upd->bind_param("sssd",$this->nome,$this->cpf,$this->obs,$this->id);
        if(!$upd->execute()) AJAXReturn("error","Não foi possível atualizar o cliente:<p>$upd->error</p>");
        else AJAXReturn("success","Atualização do cliente $this->nome, de ID $this->id, finalizada com sucesso!");
    }
    public function excluir($target){
        $targetSC=str_replace("a","á",$target);
        $del=$this->conn->prepare("delete from $target where id=?");
        $del->bind_param("d",$id);
        $errors="";
        foreach($this->id as $id){
            $values=$this->getValue(["contato","endereco"],$target,"id",$id);
            $this->idContato=$values->contato;
            $this->idEndereco=$values->endereco;
            if($delE=$this->excluirEndereco()!==true||$delC=$this->excluirContato()!==true||!$del->execute()){
                switch(true){
                    case $delE:$errorDet=[$delE->errno,$delE->error]; break;
                    case $delC:$errorDet=[$delC->errno,$delC->error]; $delE->rollback(); break;
                    case $del:$errorDet=[$del->errno,$del->error]; $delE->rollback(); $delC->rollback();
                }
                array_push($errors,[$this->getValue("nome",$target,"id",$id),$errorDet]);
            }
        }
        $s=(is_array($errors)?count($errors):count($this->id))>1?"s":"";
        if(is_array($errors)){
            $errorList="";
            foreach($errors as $error) $errorList.="<p>".$error[0].": erro ".$error[1][0]." (".$error[1][1].");</p>";
            AJAXReturn("error",count($this->id)-count($errors)." $targetSC$s excluído$s, com o$s erro$s a seguir:$errorList");
        }else AJAXReturn("success","Exclusão de ".count($this->id)." $targetSC$s finalizada com sucesso!");
    }
}