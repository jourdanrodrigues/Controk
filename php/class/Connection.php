<?php
class Connection {
	protected static $host='localhost';
	protected static $db='sefuncbd';
	protected static $user='root';
	protected static $password='';
	/*
	private $host='mysql.hostinger.com.br';
	private $db='u398318873_bda';
	private $user='u398318873_tj';
	private $password='Knowledge1';
	*/
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
	public static function verifyId($alvo,$id){
		$mysqli=self::conectar();
		$queryCheck='select * from '.$alvo.' where id='.$id.';';
		$getCheck=mysqli_query($mysqli,$queryCheck);
		$check=mysqli_num_rows($getCheck);
		if($check==0){
			if($alvo=='funcionario'){
				$alvo=str_replace('a','á',$alvo);
			}
			echo '
			<script>
				alert("O '.$alvo.' de ID '.$id.' não existe.");
				location.href="/trabalhos/gti/bda1/";
			</script>';
			return false;
		}
	}
}
?>