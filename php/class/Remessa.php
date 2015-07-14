<?php
class Remessa extends Estoque {
	protected $idRemessa;
	private $idFornecedor;
	private $dataEntrega;
	private $dataPagamento;
	private $dataPedido;
	public function setAttrRemessa($idProduto,$qtdProd,$idFornecedor,$dataPedido,$dataPagamento,$dataEntrega){
		$this->idProduto=$idProduto;
		$this->idFornecedor=$idFornecedor;
		$this->dataEntrega=$dataEntrega;
		$this->dataPagamento=$dataPagamento;
		$this->dataPedido=$dataPedido;
		$this->qtdProd=$qtdProd;
	}
	public function cadastrarRemessa(){
		if($this->verificarExistencia('fornecedor','id',$this->idFornecedor)===false||$this->verificarExistencia('produto','id',$this->idProduto)===false){return;}
		$mysqli=$this->conectar();
		$cadRemessa='insert into remessa(produto,fornecedor,dataEntrega,dataPagamento,dataPedido,qtdProd) values ("'.$this->idProduto.'","'.$this->idFornecedor.'","'.$this->dataEntrega.'","'.$this->dataPagamento.'","'.$this->dataPedido.'","'.$this->qtdProd.'");';
		if(!mysqli_query($mysqli,$cadRemessa)){
			die ('<script>alert("Não foi possível cadastrar a remessa:\n\n'.mysqli_error($mysqli).'");location.href="/trabalhos/gti/bda1/";</script>');
		}else{
			$this->idRemessa=mysqli_insert_id($mysqli);
			$this->inserirRemessaEstoque();
		}
	}
	public function inserirRemessaEstoque(){
		echo '
			<script src="/trabalhos/gti/bda1/js/jQuery.js"></script>
			<script>
				alert("Cadastro da remessa nº '.$this->idRemessa.' finalizado com sucesso!");
				if(confirm("O produto será cadastrado no estoque.")){
					$(\'#div\').html("<form id=\'phpForm\' action=\'/trabalhos/gti/bda1/php/manager.php\' method=\'POST\'><input type=\'hidden\' id=\'idFuncionarioEstq\' name=\'idFuncionarioEstq\' value=\'\'><input type=\'hidden\' id=\'dataSaida\' name=\'dataSaida\' value=\'\'><input type=\'hidden\' id=\'idProdutoEstq\' name=\'idProdutoEstq\' value='.$this->idProduto.'><input type=\'hidden\' id=\'qtdProdEstq\' name=\'qtdProdEstq\' value='.$this->qtdProd.'><input type=\'hidden\' name=\'acao\' value=\'inserir\'><input type=\'hidden\' name=\'alvo\' value=\'estoque\'></form>");
					$(\'#phpForm\').submit();
				}else{
					location.href="/trabalhos/gti/bda1/";
				}
			</script>
			<div id="div"></div>';
	}
}
?>