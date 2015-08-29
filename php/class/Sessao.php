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
			echo "<span class='retorno' data-type='error'>O usuário \"$this->usuario\" não está cadastrado no sistema.</span>";
		}else{
			$pw=$this->pegarValor('senha','usuario','nome',$this->usuario);
			if($this->senha!=$pw){
				echo "<span class='retorno' data-type='error'>Não foi possível realizar o login pois a senha digitada está incorreta.</span>";
			}else{
				echo "<span class='retorno' data-type='redirect'>/trabalhos/gti/bda1/</span>";
				$this->iniciarSessao();
			}
		}
	}
	public function logout(){
		session_start();
		session_unset();
	}
	public function cadastrarUsuario(){
		if($this->verificarExistencia('usuario','nome',$this->usuario)===true){
			echo "<span class='retorno' data-type='error'>O usuário \"$this->usuario\" já está cadastrado no sistema.</span>";
		}else{
			$mysqli=$this->conectar();
			$cadUsuario=$mysqli->prepare('insert into usuario(nome,senha) values (?,?)');
			$cadUsuario->bind_param("ss",$this->usuario,$this->senha);
			if(!$cadUsuario->execute()) echo "<span class='retorno' data-type='error'>Não foi possível cadastrar o usuário \"$this->usuario\":<p>$cadUsuario->error.</p></span>";
			else{
				echo "<span class='retorno' data-type='success'>O usuário \"$this->usuario\" foi cadastrado com sucesso!</span>";
				$this->iniciarSessao();
			}
		}
	}
	public function iniciarSessao(){
		session_start();
		$_SESSION['usuario']=$this->usuario;
		$_SESSION['tempo']=time();
	}
}