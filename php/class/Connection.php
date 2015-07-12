<?php
public class connection{
	private $host='mysql.hostinger.com.br';
	private $db='u398318873_bda';
	private $user='u398318873_tj';
	private $password='Knowledge1';
	public function conectar(){
		$mysqli=mysqli_connect($this->host,$this->user,$this->password,$this->db);
		if (mysqli_connect_errno()) {
			echo '<script>alert("Falha ao se conectar ao MySQL:\n\n('.$mysqli->connect_errno.')\n\n'.$mysqli->connect_error.'");location.href="/trabalhos/gti/bda1/";</script>';
			return "erro";
		}else{
			return $mysqli;
		}
	}
	public function desconectar($mysqli){
		mysqli_close($mysqli);
	}
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
}
?>