<?php
class Connection {
	private $host;
	private $db;
	private $user;
	private $password;
	private $usuarioLogin;
	private $senhaLogin;
	public function setAttrLogin($usuarioLogin,$senhaLogin){
		$this->usuarioLogin=$usuarioLogin;
		$this->senhaLogin=$senhaLogin;
	}
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
	public function getValueInBank($campo,$tabela,$campoPesquisa,$pesquisa){
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
	public function login(){
		if($this->verificarExistencia('usuario','nome',$this->usuarioLogin)!==true){
			echo '<script>alert("O usuário \"'.$this->usuarioLogin.'\" não está cadastrado no sistema.");location.href="/trabalhos/gti/bda1/login.php";</script>';
		}else{
			$id=$this->getValueInBank('id','usuario','nome',$this->usuarioLogin);
			$nome=$this->getValueInBank('nome','usuario','id',$id);
			$pw=$this->getValueInBank('senha','usuario','id',$id);
			if($this->usuarioLogin!=$nome||$this->senhaLogin!=$pw){
				echo '<script>alert("Não foi possível realizar o login.\n\nVerifique se e-mail e senha estão corretos.");location.href="/trabalhos/gti/bda1/login.php";</script>';
			}else{
				$this->iniciarSessao();
			}
		}
	}
	public function cadastrarUsuario(){
		if($conn->verificarExistencia('usuario','nome',$this->usuarioLogin)===true){
			echo '<script>alert("O usuário '.$this->usuarioLogin.' já está cadastrado no sistema.");location.href="/trabalhos/gti/bda1/login.php";</script>';
		}else{
			$mysqli=$conn->conectar();
			$cadUsuario='insert into usuario(nome,senha) values ("'.$this->usuarioLogin.'","'.$this->senhaLogin.'");';
			if(!mysqli_query($mysqli,$cadUsuario)){
				die ('<script>alert("Não foi possível cadastrar o usuário \"'.$this->usuarioLogin.'\":\n\n'.mysqli_error($mysqli).'");location.href="/trabalhos/gti/bda1/login.php";</script>');
			}else{
				echo '<script>alert("O usuário \"'.$this->usuarioLogin.'\" foi cadastrado com sucesso!");</script>';
				$this->iniciarSessao();
			}
		}
	}
	public function iniciarSessao(){
		session_start();
		$_SESSION['usuario']=$this->usuarioLogin;
		$_SESSION['tempo']=time();
		header("location:/trabalhos/gti/bda1/");
	}
}
?>