<?php
class Fornecedor extends Pessoa {
    protected $cnpj;
    function __construct($var){
        $this->connect();
        $obj=json_decode(fixJSON($var));
        if(isset($obj->id)) $this->id=$obj->id;
        if(isset($obj->cnpj)){
            $this->nome=$obj->nome;
            $this->cnpj=$obj->cnpj;
        }
    }
}