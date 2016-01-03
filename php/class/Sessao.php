<?php
class Sessao extends Connection{
    private $usuario;
    private $senha;
    public function setAttrSessao($usuario,$senha){
        $this->connect();
        $this->usuario=$this->getValue("nome","usuario","nome",$usuario)?:$usuario;
        $this->senha=$senha;
    }
    public function login(){
        if($this->checkExistence('usuario','nome',$this->usuario)!==true)
            AJAXReturn("error","O usuário '$this->usuario' não está cadastrado no sistema.");
        elseif($this->senha!=$this->getValue('senha','usuario','nome',$this->usuario))
            AJAXReturn("error","Não foi possível realizar o login pois a senha digitada está incorreta.");
        else{
            AJAXReturn("redirect","/trabalhos/gti/bda1/");
            $this->iniciarSessao();
        }
    }
    public function logout(){
        session_start();
        session_unset();
    }
    public function cadastrarUsuario(){
        if($this->checkExistence("usuario","nome",$this->usuario)===true)
            AJAXReturn("error","O usuário \'$this->usuario\' já está cadastrado no sistema.");
        else{
            $cad=$this->conn->prepare("insert into usuario(nome,senha) values (?,?)");
            $cad->bind_param("ss",$this->usuario,$this->senha);
            if(!$cad->execute())
                AJAXReturn("error","Não foi possível cadastrar o usuário \'$this->usuario\':<p>$cad->error.</p>");
            else{
                AJAXReturn("success","O usuário \'$this->usuario\' foi cadastrado com sucesso!");
                $this->iniciarSessao();
            }
        }
    }
    public function iniciarSessao(){
        session_start();
        $_SESSION["usuario"]=$this->usuario;
        $_SESSION["tempo"]=time();
    }
}