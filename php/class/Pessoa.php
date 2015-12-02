<?php
class Pessoa extends Contato{
    protected $id;
    protected $nome;
    public function cadastrar($target){
        $targetSC=str_replace("a","á",$target);
        $fields="\$this->nome".($target=="fornecedor"?",\$this->cnpj":($target=="cliente"?",\$this->cpf":",\$this->cpf,\$this->cargo"));
        $typeBind="sss".($target!="funcionario"?"s":"ss");
        $cad=$this->conn->prepare("insert into $target(".str_replace('$this->',"",$fields).",endereco,contato) values (?".($target!="funcionario"?",?":",?,?").",?,?)");
        eval("\$cad->bind_param('$typeBind',$fields,\$this->idEndereco,\$this->idContato);");
        if(gettype($cadE=$this->cadastrarEndereco())=="string"){
            $er=json_decode(fixJSON($cadE));
            $er="($er->errno) $er->error.";
        }elseif(gettype($cadC=$this->cadastrarContato())=="string"){
            $this->excluirEndereco();
            $er=json_decode(fixJSON($cadC));
            $er="($er->errno) $er->error";
        }elseif(!$cad->execute()){
            $this->excluirEndereco(); $this->excluirContato();
            $er="($cad->errno) $cad->error";
        }
        if(!isset($er)) AJAXReturn("success","Cadastro do $targetSC $this->nome, de ID $cad->insert_id, finalizado com sucesso!");
        else AJAXReturn("error","Erro ao cadastrar o $targetSC:<p>$er.</p>");
    }
    public function listar($target){
        $fields='$id,$nome'.($target=="funcionario"?',$cargo':($target=="fornecedor"?',$cnpj':""));
        $list=$this->conn->prepare("select ".str_replace("$","",$fields)." from $target");
        if(!$list->execute()){
            $s=($target=="fornecedor"?"es":"s");
            AJAXReturn("error","Erro ao listar os ".str_replace("a","á",$target)."$s<p>($list->errno) $list->error<p>");
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
        echo fixJSON("{".($target=="fornecedor"?"'cnpj':'$values->cnpj',":"'cpf':'$values->cpf',").$this->dadosEndereco().",".$this->dadosContato()."}");
    }
    public function buscarDados($target){
        $fields=["contato","endereco","nome"];
        switch($target){
            case "fornecedor":array_push($fields,"cnpj"); break;
            case "funcionario":array_push($fields,"cargo");
            case "cliente":array_push($fields,"cpf"); break;
        }
        $values=$this->getValue($fields,$target,"id",$this->id);
        $this->idEndereco=$values->endereco;
        $this->idContato=$values->contato;
        echo fixJSON("{'id':$this->id,
            'nome':'$values->nome',".
            $this->dadosEndereco().",".$this->dadosContato().",".
            ($target=="fornecedor"?"'cnpj':'$values->cnpj'":
                ($target=="cliente"?"'cpf':'$values->cpf'":
                    "'cpf':'$values->cpf','cargo':'$values->cargo'"))."}");
    }
    public function atualizar($target){
        $targetSC=str_replace("a","á",$target);
        $values=$this->getValue(["contato","endereco"],$target,"id",$this->id);
        $this->idContato=$values->contato;
        $this->idEndereco=$values->endereco;
        $query=$bind=$attr="";
        switch($target){
            case "fornecedor":
                $query.=",cnpj=?";
                $bind.="s";
                $attr.="\$this->cnpj";
                break;
            case "funcionario":
                $query.=",cargo=?";
                $bind.="s";
                $attr.="\$this->cargo,";
            case "cliente":
                $query.=",cpf=?";
                $bind.="s";
                $attr.="\$this->cpf";
                break;
        }
        $upd=$this->conn->prepare("update $target set nome=?$query where id=?");
        eval("\$upd->bind_param('s$bind"."d',\$this->nome,$attr,\$this->id);");
        if(gettype($updE=$this->atualizarEndereco())=="string"){
            $er=json_decode(fixJSON($updE));
            $er="($er->errno) $er->error";
        }elseif(gettype($updC=$this->atualizarContato())=="string"){
            $er=json_decode(fixJSON($updC));
            $er="($er->errno) $er->error";
        }elseif(!$upd->execute()) $er="($upd->errno) $upd->error";
        if(isset($er)) AJAXReturn("error","Erro ao atualizar o $targetSC<p>$er.</p>");
        else AJAXReturn("success","Atualização do $targetSC $this->nome, de ID $this->id, finalizada com sucesso!");
    }
    public function excluir($target){
        $targetSC=str_replace("a","á",$target);
        $del=$this->conn->prepare("delete from $target where id=?");
        $del->bind_param("d",$id);
        $errors=[];
        foreach($this->id as $id){
            $values=$this->getValue(["contato","endereco"],$target,"id",$id);
            $this->idContato=$values->contato;
            $this->idEndereco=$values->endereco;
            if(gettype($delE=$this->excluirEndereco())=="string"){
                $er=json_decode(fixJSON($delE));
                $er=[$er->errno,$er->error];
            }elseif(gettype($delC=$this->excluirContato())=="string"){
                $er=json_decode(fixJSON($delC));
                $er=[$er->errno,$er->error];
            }elseif(!$del->execute()) $er=[$del->errno,$del->error]; // Erro 2006
            if(isset($er)) array_push($errors,[$this->getValue("nome",$target,"id",$id),$er]);
        }
        $es=(($s=(count($errors)!=0?count($errors):count($this->id))>1?"s":"")=="s"?($target=="fornecedor"?"es":"s"):"");
        if(count($errors)!=0){
            $errorList="";
            foreach($errors as $error) $errorList.="<p>$error[0]: erro ".$error[1][0]." (".$error[1][1].");</p>";
            $success=count($this->id)-count($errors);
            AJAXReturn("error",($success==0?"Nenhum":$success)." $targetSC$es excluído$s, com o$s erro$s a seguir$errorList");
        }else AJAXReturn("success","Exclusão de ".count($this->id)." $targetSC$es finalizada com sucesso!");
    }
}