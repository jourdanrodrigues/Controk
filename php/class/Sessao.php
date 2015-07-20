<?php
class Sessao extends Connection{
	private $usuario;
	private $senha;
	public function setAttrSessao($usuario,$senha){
		$this->usuario=$usuario;
		$this->senha=$senha;
	}
	public function login(){
		if($this->verificarExistencia('usuario','nome',$this->usuario)!==true){
			echo '<script>alert("O usuário \"'.$this->usuario.'\" não está cadastrado no sistema.");location.href="/trabalhos/gti/bda1/login.php";</script>';
		}else{
			$pw=$this->pegarValor('senha','usuario','nome',$this->usuario);
			if($this->senha!=$pw){
				echo '<script>alert("Não foi possível realizar o login pois a senha digitada está incorreta.");location.href="/trabalhos/gti/bda1/login.php";</script>';
			}else{
				$this->iniciarSessao();
			}
		}
	}
	public function logout(){
		session_start();
		session_unset();
		echo '<script>alert("Logout efetuado com sucesso!");location.href="/trabalhos/gti/bda1/login.php";</script>';
	}
	public function cadastrarUsuario(){
		if($this->verificarExistencia('usuario','nome',$this->usuario)===true){
			echo '<script>alert("O usuário '.$this->usuario.' já está cadastrado no sistema.");location.href="/trabalhos/gti/bda1/login.php";</script>';
		}else{
			$mysqli=$this->conectar();
			$cadUsuario='insert into usuario(nome,senha) values ("'.$this->usuario.'","'.$this->senha.'");';
			if(!mysqli_query($mysqli,$cadUsuario)){
				die ('<script>alert("Não foi possível cadastrar o usuário \"'.$this->usuario.'\":\n\n'.mysqli_error($mysqli).'");location.href="/trabalhos/gti/bda1/login.php";</script>');
			}else{
				echo '<script>alert("O usuário \"'.$this->usuario.'\" foi cadastrado com sucesso!");</script>';
				$this->iniciarSessao();
			}
		}
	}
	public function iniciarSessao(){
		session_start();
		$_SESSION['usuario']=$this->usuario;
		$_SESSION['tempo']=time();
		header("location:/trabalhos/gti/bda1/");
	}
}
?>