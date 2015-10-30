<?php
class Estoque extends Historico{
    public function setAttrEstoque($var){
        $obj=json_decode(fixJSON($var));
        $this->idProduto=$obj->idProduto;
        $this->qtdProd=$obj->qtdProd;
        if(isset($obj->dataSaida)) {
            $this->idFuncionario=$obj->idFuncionario;
            $this->dataSaida=$obj->dataSaida;
        }
    }
    public function inserirProduto(){
        if($this->checkExistence('produto','id',$this->idProduto)===false) return;
        $mysqli=$this->connect();
        if($this->checkExistence('estoque','produto',$this->idProduto)===false) $insEstoque=$mysqli->prepare("insert into estoque(qtdProd,produto) values (?,?)");
        else{
            $qtdProdEstq=$this->getValue('qtdProd','estoque','produto',$this->idProduto);
            $this->qtdProd+=$qtdProdEstq;
            $insEstoque=$mysqli->prepare("update estoque set qtdProd=? where produto=?");
        }
        $insEstoque->bind_param("dd",$this->qtdProd,$this->idProduto);
        $this->nomeProduto=$this->getValue('nome','produto','id',$this->idProduto);
        if(!$insEstoque->execute()) AJAXReturn("{'type':'error','msg':'Não foi possível inserir o produto no estoque:\n\n$insEstoque->error'}");
        else{
            $msg="Produto inserido no estoque com sucesso<p><br>Produto: $this->nomeProduto;</p><p>Quantidade";
            if(isset($qtdProdEstq)) $msg.=" anterior: $qtdProdEstq;</p><p>Quantidade atual: $this->qtdProd.</p>";
            else $msg.=": $this->qtdProd.</p>";
            AJAXReturn("{'type':'success','msg':'$msg'}");
        }
    }
    public function retirarProduto(){
        if($this->checkExistence('funcionario','id',$this->idFuncionario)===false||$this->checkExistence('produto','id',$this->idProduto)===false) return;
        $qtdProdEstq=$this->getValue('qtdProd','estoque','produto',$this->idProduto);
        $nomeProduto=$this->getValue('nome','produto','id',$this->idProduto);
        $unidade="unidade";
        if($qtdProdEstq>1) $unidade.="s";
        if($this->qtdProd>$qtdProdEstq) AJAXReturn("{'type':'error','msg':'Há somente $qtdProdEstq $unidade desse produto no estoque!'}");
        else{
            $qtdProdEstq-=$this->qtdProd;
            $mysqli=$this->connect();
            $retQtdEstoque=$mysqli->prepare('update estoque set qtdProd=? where produto=?');
            $retQtdEstoque->bind_param("dd",$qtdProdEstq,$this->idProduto);
            if(!$retQtdEstoque->execute()) AJAXReturn("{'type':'error','msg':'Não foi possível retirar o produto $nomeProduto do estoque:<p><br>$retQtdEstoque->error</p>'}");
            else{
                $this->cadastrarHistorico();
                AJAXReturn("{'type':'success','msg':'Retirado do estoque com sucesso<p><br>ID do funcionário: $this->idFuncionario;</p><p>Produto: $nomeProduto;</p><p>Quantidade retirada: $this->qtdProd;</p><p>Quantidade no estoque: $qtdProdEstq</p>'}");
            }
        }
    }
}