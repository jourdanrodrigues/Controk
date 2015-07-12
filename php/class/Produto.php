<?php
function __autoload($className) {
    require_once $className.'.php';
}
public class Produto extends Connection{
	private $idProduto;
	private $nome;
	private $remessa;
	private $descricao;
	private $custoProd;
	private $valorVenda;
	public function cadastrarProduto($nome,$remessa,$descricao,$custoProd,$valorVenda){
		$this->nome=$nome;
		$this->remessa=$remessa;
		$this->descricao=$descricao;
		$custoProd=str_replace('R$ ','',$custoProd);
		$this->custoProd=str_replace(',','.',$custoProd);
		$valorVenda=str_replace('R$ ','',$valorVenda);
		$this->valorVenda=str_replace(',','.',$valorVenda);
		$cadProduto='insert into produto(remessa,descricao,nome,custo,valorVenda) values ("'.$this->remessa.'","'.$this->descricao.'","'.$this->nome.'","'.$this->custoProd.'","'.$this->valorVenda.'");';
		if(!mysqli_query($mysqli,$cadProduto)){
			die ('<script>alert("Não foi possível cadastrar o produto:\n\n'.mysqli_error($mysqli).'");location.href="/trabalhos/gti/bda1/";</script>');
		}else{
			$this->idProduto=mysqli_insert_id($mysqli);
			echo '<script>alert("Cadastro do produto '.$this->nome.', de ID '.$this->idProduto.', finalizado com sucesso!");location.href="/trabalhos/gti/bda1/";</script>';
		}
	}
	public function buscarDadosProduto($id){
		if($this->idProduto!=$id){
			$this->nome=getValueInBank('nome','produto','id',$id);
			$this->remessa=getValueInBank('remessa','produto','id',$id);
			$this->descricao=getValueInBank('descricao','produto','id',$id);
			$this->custoProd=getValueInBank('custoProd','produto','id',$id);
			$custoProd=str_replace('.',',',$this->custoProd);
			$this->valorVenda=getValueInBank('valorVenda','produto','id',$id)
			$valorVenda=str_replace('.',',',$this->valorVenda);
			$this->idProduto=$id;
		}
		echo '<form id="phpForm" action="/trabalhos/gti/bda1/" method="POST">';
		echo '<input type="hidden" name="idProduto" value="'.$this->idProduto.'">';
		echo '<input type="hidden" name="nomeProd" value="'.$this->nome.'">';
		echo '<input type="hidden" name="idRemessa" value="'.$this->remessa.'">';
		echo '<input type="hidden" name="descrProd" value="'.$this->descricao.'">';
		echo '<input type="hidden" name="custoProd" value="R$ '.$custoProd.'">';
		echo '<input type="hidden" name="valorVenda" value="R$ '.$valorVenda.'">';
		echo '</form>';
		echo '<script src="/trabalhos/gti/bda1/js/jQuery.js"></script>';
		echo "<script>$('#phpForm').submit();</script>";
	}
	public function atualizarProduto($id,$nome,$remessa,$descricao,$custoProd,$valorVenda){
		$this->idProduto=$id;
		$this->nome=$nome;
		$this->remessa=$remessa;
		$this->descricao=$descricao;
		$custoProd=str_replace('R$ ','',$custoProd);
		$this->custoProd=str_replace(',','.',$custoProd);
		$valorVenda=str_replace('R$ ','',$valorVenda);
		$this->valorVenda=str_replace(',','.',$valorVenda);
		$updProduto='update produto set descricao="'.$this->descricao.'",nome="'.$this->nome.'",custo="'.$this->custoProd.'",valorVenda="'.$this->valorVenda.'" where id='.$id.';';
		if(!mysqli_query($mysqli,$updProduto)){
			die ('<script>alert("Não foi possível atualizar o produto:\n\n'.mysqli_error($mysqli).'");location.href="/trabalhos/gti/bda1/";</script>');
		}else{
			echo '<script>alert("Atualização do produto '.$this->nome.', de ID '.$id.', finalizada com sucesso!");location.href="/trabalhos/gti/bda1/";</script>';
		}
	}
}
?>