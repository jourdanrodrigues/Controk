<?php
class Pessoa extends Contato{
    protected $id;
    protected $nome;
    public function cadastrar($target){
        $fields="\$nome".($target=="fornecedor"?",\$cnpj":($target=="cliente"?",\$cpf":",\$cpf,\$cargo"));
        $typeBind="s".($target!="funcionario"?"s":"ss");
        echo "insert into $target(".str_replace("$","",$fields).") values (?".($target!="funcionario"?",?":",?,?").")";
        $cad=$this->conn->prepare("insert into $target(".str_replace("$","",$fields).") values (?".($target!="funcionario"?",?":",?,?").")");
        eval("\$cad->bind_param('$typeBind',$fields);");
        try{
            if($cadE=$this->cadastrarEndereco()!==true||$cadC=$this->cadastrarContato()!==true||!$cad->execute()){
                switch(true){
                    case $cadE:throw new Exception([$cadE->errno,$cadE->error]);
                    case $cadC:$cadE->rollback(); throw new Exception([$cadC->errno,$cadC->error]);
                    case $cad:$cadE->rollback(); $cadC->rollback(); throw new Exception([$cad->errno,$cad->error]);
                }
            }
            AJAXReturn("success","Cadastro do cliente $this->nome, de ID $cad->insert_id, finalizado com sucesso!");
        } catch (Exception $ex) {
            AJAXReturn("error","Não foi possível cadastrar o cliente:\n\n(".$ex[0].") ".$ex[1].".");
        }
    }
    public function listar($target){
        $fields='$id,$nome'.($target=="funcionario"?',$cargo':($target=="fornecedor"?',$cnpj':""));
        $list=$this->conn->prepare("select ".str_replace("$","",$fields)." from $target");
        if(!$list->execute()){
            $s=($target=="fornecedor"?"es":"s");
            AJAXReturn("error","Não foi possível listar os $target$s:<p>($list->errno) $list->error<p>");
        }
        else{
            eval("\$list->bind_result($fields);");
            $fields="{'id':'\$id','nome':'\$nome'".($target=="funcionario"?",'cargo':'\$cargo'":($target=="fornecedor"?",'cnpj':'\$cnpj'":""))."},";
            $listResult="";
            while($list->fetch()) eval("\$listResult.=\"$fields\";");
            echo fixJSON("[".str_replace(",]","]","$listResult]"));
        }
    }
    public function mostrarDados($target){
        $fields=["endereco","contato"];
        array_push($fields,$target=="fornecedor"?"cnpj":"cpf");
        $values=$this->getValue($fields,$target,"id",$this->id);
        $this->idEndereco=$values->endereco;
        $this->idContato=$values->contato;
        echo fixJSON("{".($target=="fornecedor"?"'cnpj':'$values->cnpj',":"'cpf':'$values->cpf',").$this->mostrarDadosEndereco().",".$this->mostrarDadosContato()."}");
    }
    public function buscarDados($target){
        $fields=["contato","endereco","nome"];
        if($target=="fornecedor") array_push($fields,"cnpj");
        else array_push($fields,"cpf");
        $values=$this->getValue($fields,$target,"id",$this->id);
        $this->idEndereco=$values->endereco;
        $this->idContato=$values->contato;
        echo fixJSON("{'id':$this->id,
            'nome':'$values->nome',".
            $this->mostrarDadosEndereco().",".$this->mostrarDadosContato().",".
            ($target!="fornecedor"?"'cpf':'$values->cpf'":"'cnpj':'$values->cnpj'")."}");
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
        $es=(($s=(is_array($errors)?count($errors):count($this->id))>1?"s":"")=="s"?($target=="fornecedor"?"es":"s"):"");
        if(is_array($errors)){
            $errorList="";
            foreach($errors as $error) $errorList.="<p>".$error[0].": erro ".$error[1][0]." (".$error[1][1].");</p>";
            AJAXReturn("error",count($this->id)-count($errors)." $targetSC$es excluído$s, com o$s erro$s a seguir:$errorList");
        }else AJAXReturn("success","Exclusão de ".count($this->id)." $targetSC$es finalizada com sucesso!");
    }
}