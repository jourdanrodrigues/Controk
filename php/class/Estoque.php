<?php
class Estoque extends Historico{
    public function setAttrEstoque($idProduto,$idFuncionario,$qtdProd,$dataSaida){
        $this->idProduto=$idProduto;
        $this->qtdProd=$qtdProd;
        $this->idFuncionario=$idFuncionario;
        $this->dataSaida=$dataSaida;
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
        if(!$insEstoque->execute()) echo "<span class='retorno' data-type='error'>Não foi possível inserir o produto no estoque:\n\n$insEstoque->error</span>";
        else{
            echo "<span class='retorno' data-type='success'>Produto inserido no estoque com sucesso<p><br>Produto: $this->nomeProduto;</p><p>Quantidade";
            if(isset($qtdProdEstq)) echo " anterior: $qtdProdEstq;</p><p>Quantidade atual: $this->qtdProd.</p>";
            else echo ": $this->qtdProd.</p>";
            echo "</span>";
        }
    }
    public function retirarProduto(){
        if($this->checkExistence('funcionario','id',$this->idFuncionario)===false||$this->checkExistence('produto','id',$this->idProduto)===false) return;
        $qtdProdEstq=$this->getValue('qtdProd','estoque','produto',$this->idProduto);
        $nomeProduto=$this->getValue('nome','produto','id',$this->idProduto);
        $qtdProdEstq==1?$unidade="unidade":$unidade="unidades";
        if($this->qtdProd>$qtdProdEstq) echo "<span class='retorno' data-type='error'>Há somente $qtdProdEstq $unidade desse produto no estoque!</span>";
        else{
            $qtdProdEstq-=$this->qtdProd;
            $mysqli=$this->connect();
            $retQtdEstoque=$mysqli->prepare('update estoque set qtdProd=? where produto=?');
            $retQtdEstoque->bind_param("dd",$qtdProdEstq,$this->idProduto);
            if(!$retQtdEstoque->execute()) echo "<span class='retorno' data-type='error'>Não foi possível retirar o produto $nomeProduto do estoque:<p><br>$retQtdEstoque->error</p></span>";
            else{
                $this->cadastrarHistorico();
                echo "<span class='retorno' data-type='success'>Retirado do estoque com sucesso<p><br>ID do funcionário: $this->idFuncionario;</p><p>Produto: $nomeProduto;</p><p>Quantidade retirada: $this->qtdProd;</p><p>Quantidade no estoque: $qtdProdEstq</p></span>";
            }
        }
    }
}