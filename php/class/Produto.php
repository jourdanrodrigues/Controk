<?php
class Produto extends Remessa{
	private $nome;
	private $descricao;
	private $custoProd;
	private $valorVenda;
	public function setAttrProduto($idProduto,$nome,$idRemessa,$descricao,$custoProd,$valorVenda){
		$this->idProduto=$idProduto;
		$this->nome=$nome;
		$this->idRemessa=$remessa;
		$this->descricao=$descricao;
		$this->custoProd=$custoProd;
		$this->valorVenda=$valorVenda;
	}
	public function cadastrarProduto(){
		$this->custoProd=str_replace('R$ ','',$this->custoProd);
		$this->custoProd=str_replace(',','.',$this->custoProd);
		$this->valorVenda=str_replace('R$ ','',$this->valorVenda);
		$this->valorVenda=str_replace(',','.',$this->valorVenda);
		$mysqli=$this->conectar();
		$cadProduto='insert into produto(remessa,descricao,nome,custo,valorVenda) values ("'.$this->idRemessa.'","'.$this->descricao.'","'.$this->nome.'","'.$this->custoProd.'","'.$this->valorVenda.'");';
		if(!mysqli_query($mysqli,$cadProduto)){
			die ('<script>alert("Não foi possível cadastrar o produto:\n\n'.mysqli_error($mysqli).'");location.href="/trabalhos/gti/bda1/";</script>');
		}else{
			$this->idProduto=mysqli_insert_id($mysqli);
			echo '<script>alert("Cadastro do produto '.$this->nome.', de ID '.$this->idProduto.', finalizado com sucesso!");location.href="/trabalhos/gti/bda1/";</script>';
		}
	}
	public function buscarDadosProduto(){
		$this->nome=$this->getValueInBank('nome','produto','id',$this->idProduto);
		$this->idRemessa=$this->getValueInBank('remessa','produto','id',$this->idProduto);
		$this->descricao=$this->getValueInBank('descricao','produto','id',$this->idProduto);
		$this->custoProd=$this->getValueInBank('custo','produto','id',$this->idProduto);
		$custoProd=str_replace('.',',',$this->custoProd);
		$this->valorVenda=$this->getValueInBank('valorVenda','produto','id',$this->idProduto);
		$valorVenda=str_replace('.',',',$this->valorVenda);
		echo '<form id="phpForm" action="/trabalhos/gti/bda1/" method="POST">';
		echo '<input type="hidden" name="idProduto" value="'.$this->idProduto.'">';
		echo '<input type="hidden" name="nomeProd" value="'.$this->nome.'">';
		echo '<input type="hidden" name="idRemessa" value="'.$this->idRemessa.'">';
		echo '<input type="hidden" name="descrProd" value="'.$this->descricao.'">';
		echo '<input type="hidden" name="custoProd" value="R$ '.$custoProd.'">';
		echo '<input type="hidden" name="valorVenda" value="R$ '.$valorVenda.'">';
		echo '</form>';
		echo '<script src="/trabalhos/gti/bda1/js/jQuery.js"></script>';
		echo "<script>$('#phpForm').submit();</script>";
	}
	public function atualizarProduto(){
		$this->custoProd=str_replace('R$ ','',$this->custoProd);
		$custoProd=str_replace(',','.',$this->custoProd);
		$valorVenda=str_replace('R$ ','',$valorVenda);
		$this->valorVenda=str_replace(',','.',$valorVenda);
		$mysqli=$this->conectar();
		$updProduto='update produto set descricao="'.$this->descricao.'",nome="'.$this->nome.'",custo="'.$custoProd.'",valorVenda="'.$this->valorVenda.'" where id='.$this->idProduto.';';
		if(!mysqli_query($mysqli,$updProduto)){
			die ('<script>alert("Não foi possível atualizar o produto:\n\n'.mysqli_error($mysqli).'");location.href="/trabalhos/gti/bda1/";</script>');
		}else{
			echo '<script>alert("Atualização do produto '.$this->nome.', de ID '.$id.', finalizada com sucesso!");location.href="/trabalhos/gti/bda1/";</script>';
		}
	}
}
?>