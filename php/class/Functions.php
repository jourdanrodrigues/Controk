<?php
	function getValueInBank($campo,$tabela,$campoPesquisa,$pesquisa){
		$getValue='select '.$campo.' from '.$tabela;
		if($campoPesquisa!=""||$pesquisa!=""){
			$getValue.='where '.$campoPesquisa.' = '.$pesquisa.';';
		}else{
			$getValue.=';';
		}
		$gotValue=mysqli_query($mysqli,$getValue);
		$value=mysqli_fetch_row($gotValue);
		return $value[0];
	}
?>