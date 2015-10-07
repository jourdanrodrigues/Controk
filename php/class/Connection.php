<?php
class Connection {
    protected $host;
    protected $db;
    protected $user;
    protected $password;
    public function conectar(){
        if(server("SERVER_ADDR")=='::1'||server("SERVER_ADDR")=='127.0.0.1'){
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
        if(mysqli_connect_errno()) echo "<span class='retorno' data-type='error'>Falha ao se conectar ao MySQL:<p>($mysqli->connect_errno)</p><p>$mysqli->connect_error</p></span>";
        else return $mysqli;
    }
    public function pegarValor($campo,$tabela,$campoPesquisa,$pesquisa){
        $mysqli=$this->conectar();
        $getValue="select $campo from $tabela";
        if($campoPesquisa!=""||$pesquisa!=""){
            $getValue.=" where $campoPesquisa=?";
            $getValue=$mysqli->prepare($getValue);
            $getValue->bind_param("s",$pesquisa);
        }else $getValue=$mysqli->prepare($getValue);
        $getValue->execute();
        $getValue->bind_result($value);
        $getValue->fetch();
        return $value;
    }
    public function verificarExistencia($alvo,$campo,$valor){
        $mysqli=$this->conectar();
        $query=$mysqli->prepare("select * from $alvo where $campo=?");
        $query->bind_param("s",$valor);
        $query->execute();
        $query->store_result();
        if($query->num_rows==0){
            switch($alvo){
                case 'estoque':
                case 'usuario': break;
                default:
                    if($alvo=='funcionario') $alvo=str_replace('a','á',$alvo);
                    echo "<span class='retorno' data-type='error'>O $alvo de $campo $valor não existe.</span>";
            }
            return false;
        }elseif($alvo=='usuario') return true;
    }
}