<?php
class Funcionario extends Cliente{
    protected $cargo;
    function __construct($var){
        $this->connect();
        $obj=json_decode(fixJSON($var));
        if(isset($obj->id)) $this->id=$obj->id;
        if(isset($obj->nome)){
            $this->nome=$obj->nome;
            $this->cpf=$obj->cpf;
            $this->cargo=$obj->cargo;
        }
    }
}