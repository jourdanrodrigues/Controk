<?php
class Sessao extends Connection{
    private $usuario;
    private $senha;
    public function setAttrSessao($usuario,$senha){
        $this->usuario=$this->getValue("nome","usuario","nome",$usuario);
        $this->senha=$senha;
    }
    public function login(){
        if($this->checkExistence('usuario','nome',$this->usuario)!==true) AJAXReturn("{'type':'error','msg':'O usuário \'$this->usuario\' não está cadastrado no sistema.'}");
        elseif($this->senha!=$this->getValue('senha','usuario','nome',$this->usuario)) AJAXReturn("{'type':'error','msg':'Não foi possível realizar o login pois a senha digitada está incorreta.'}");
        else{
            AJAXReturn("{'type':'redirect','msg':'/trabalhos/gti/bda1/'}");
            $this->iniciarSessao();
        }
    }
    public function logout(){
        session_start();
        session_unset();
    }
    public function cadastrarUsuario(){
        if($this->checkExistence("usuario","nome",$this->usuario)===true) AJAXReturn("{'type':'error','msg':'O usuário \'$this->usuario\' já está cadastrado no sistema.'}");
        else{
            $mysqli=$this->connect();
            $cadUsuario=$mysqli->prepare("insert into usuario(nome,senha) values (?,?)");
            $cadUsuario->bind_param("ss",$this->usuario,$this->senha);
            if(!$cadUsuario->execute()) AJAXReturn("{'type':'error','msg':'Não foi possível cadastrar o usuário \'$this->usuario\':<p>$cadUsuario->error.</p>'}");
            else{
                AJAXReturn("{'type':'success','msg':'O usuário \'$this->usuario\' foi cadastrado com sucesso!'}");
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