<?php
class Connection {
	/*
	protected static $host='localhost';
	protected static $db='sefuncbd';
	protected static $user='root';
	protected static $password='';
	*/
	protected static $host='mysql.hostinger.com.br';
	protected static $db='u398318873_bda';
	protected static $user='u398318873_tj';
	protected static $password='Knowledge1';
	public static function conectar(){
		$mysqli=mysqli_connect(self::$host,self::$user,self::$password,self::$db);
		if (mysqli_connect_errno()) {
			echo '<script>alert("Falha ao se conectar ao MySQL:\n\n('.$mysqli->connect_errno.')\n\n'.$mysqli->connect_error.'");location.href="/trabalhos/gti/bda1/";</script>';
		}else{
			return $mysqli;
		}
	}
	public static function getValueInBank($campo,$tabela,$campoPesquisa,$pesquisa){
		$mysqli=self::conectar();
		$getValue='select '.$campo.' from '.$tabela;
		if($campoPesquisa!=""||$pesquisa!=""){
			$getValue.=' where '.$campoPesquisa.' = '.$pesquisa.';';
		}else{
			$getValue.=';';
		}
		$gotValue=mysqli_query($mysqli,$getValue);
		$value=mysqli_fetch_row($gotValue);
		return $value[0];
	}
	public static function verificarExistencia($alvo,$campo,$valor){
		$mysqli=self::conectar();
		$queryCheck='select * from '.$alvo.' where '.$campo.'='.$valor.';';
		$getCheck=mysqli_query($mysqli,$queryCheck);
		$check=mysqli_num_rows($getCheck);
		if($check==0){
			if($alvo=='funcionario'){
				$alvo=str_replace('a','á',$alvo);
			}
			if($alvo!='estoque'){
				echo '<script>alert("O '.$alvo.' de '.$campo.' '.$valor.' não existe.");location.href="/trabalhos/gti/bda1/";</script>';
			}
			return false;
		}
	}
}
?>