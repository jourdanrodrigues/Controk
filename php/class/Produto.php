<?php
function __autoload($className) {
    require_once $className.'.php';
}
public class Produto extends Connection{
	private $id;
	private $remessa;
	private $descricao;
	private $custoProd;
	private $valorVenda;
	public function cadastrarProduto($remessa,$descricao,$custoProd,$valorVenda){
		
	}
	public function buscarDadosProduto($id){
		
	}
	public function atualizarProduto($remessa,$descricao,$custoProd,$valorVenda){
		
	}
}
?>