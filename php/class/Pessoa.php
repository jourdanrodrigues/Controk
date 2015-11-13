<?php
class Pessoa extends Contato{
    protected $id;
    protected $nome;
    public function listar($target){
        $fields='$id,$nome'.($target=="cliente"?',$cpf':($target=="funcionario"?',$cpf,$cargo':($target=="fornecedor"?',$cnpj':"")));
        $list=$this->conn->prepare("select ".str_replace("$","",$fields)." from $target");
        if(!$list->execute()){
            $s=($target=="fornecedor"?"es":"s");
            AJAXReturn("error","Não foi possível listar os $target$s:<p>($list->errno) $list->error<p>");
        }
        else{
            eval("\$list->bind_result($fields);");
            $fields="{'id':'\$id','nome':'\$nome'".($target=="cliente"?",'cpf':'\$cpf'":($target=="funcionario"?",'cpf':'\$cpf','cargo':'\$cargo'":($target=="fornecedor"?",'cnpj':'\$cnpj'":"")))."},";
            $listResult="";
            while($list->fetch()) eval("\$listResult.=\"$fields\";");
            echo fixJSON("[".str_replace(",]","]","$listResult]"));
        }
    }
    public function mostrarDados($target){
        $fields=["endereco","contato"];
        if($target!="fornecedor") array_push($fields,"obs");
        $values=$this->getValue($fields,$target,"id",$this->id);
        $this->idEndereco=$values->endereco;
        $this->idContato=$values->contato;
        echo fixJSON("{".($target!="fornecedor"?"'obs':'$values->obs',":"").$this->mostrarDadosEndereco().",".$this->mostrarDadosContato()."}");
    }
    public function buscarDados($target){
        /* Para implementação
        $values=$this->getValue(["contato","endereco","nome","cpf","obs"],"cliente","id",$this->id);
        $this->idEndereco=$values->endereco;
        $this->idContato=$values->contato;
        echo fixJSON("{'id':$this->id,
            'nome':'$values->nome',
            'cpf':'$values->cpf',
            'obs':'$values->obs',".
            $this->mostrarDadosEndereco().",".
            $this->mostrarDadosContato()."}");
         * 
         */
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