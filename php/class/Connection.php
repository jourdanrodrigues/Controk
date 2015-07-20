<?php
class Connection {
	protected $host;
	protected $db;
	protected $user;
	protected $password;
	public function conectar(){
		if($_SERVER['SERVER_ADDR']=='::1'||$_SERVER['SERVER_ADDR']=='127.0.0.1'){
			$this->host='localhost';
			$this->db='sefuncbd';
			$this->user='root';
			$this->password='';
		}else{
			$this->host='mysql.hostinger.com.br';
			$this->db='u398318873_bda';
			$this->user='u398318873_tj';
			$this->password='Knowledge1';
		}
		$mysqli=mysqli_connect($this->host,$this->user,$this->password,$this->db);
		if(mysqli_connect_errno()){
			echo '<script>alert("Falha ao se conectar ao MySQL:\n\n('.$mysqli->connect_errno.')\n\n'.$mysqli->connect_error.'");location.href="/trabalhos/gti/bda1/";</script>';
		}else{
			return $mysqli;
		}
	}
	public function pegarValor($campo,$tabela,$campoPesquisa,$pesquisa){
		$mysqli=$this->conectar();
		$getValue='select '.$campo.' from '.$tabela;
		if($campoPesquisa!=""||$pesquisa!=""){
			$getValue.=' where '.$campoPesquisa.'="'.$pesquisa.'";';
		}else{
			$getValue.=';';
		}
		$gotValue=mysqli_query($mysqli,$getValue);
		$value=mysqli_fetch_row($gotValue);
		return $value[0];
	}
	public function verificarExistencia($alvo,$campo,$valor){
		$mysqli=$this->conectar();
		$queryCheck='select * from '.$alvo.' where '.$campo.'="'.$valor.'";';
		$getCheck=mysqli_query($mysqli,$queryCheck);
		$check=mysqli_num_rows($getCheck);
		if($check==0){
			if($alvo!='estoque'||$alvo!='usuario'){
				if($alvo=='funcionario'){$alvo=str_replace('a','á',$alvo);}
				echo '<script>alert("O '.$alvo.' de '.$campo.' '.$valor.' não existe.");location.href="/trabalhos/gti/bda1/";</script>';
			}
			return false;
		}elseif($alvo=='usuario'){return true;}
	}
}
?>