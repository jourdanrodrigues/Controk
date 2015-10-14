<?php
class Connection {
    protected $host;
    protected $db;
    protected $user;
    protected $password;
    public function connect(){
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
        $conn=mysqli_connect($this->host,$this->user,$this->password,$this->db);
        if(mysqli_connect_errno()) echo "<span class='retorno' data-type='error'>Falha ao se conectar ao MySQL:<p>($conn->connect_errno)</p><p>$conn->connect_error</p></span>";
        else return $conn;
    }
    public function getValue($field,$table,$searchField,$search){
        $mysqli=$this->connect();
        $query="select $field from $table";
        if($searchField!=""||$search!=""){
            $query.=" where $searchField=?";
            $query=$mysqli->prepare($query);
            $query->bind_param("s",$search);
        }else $query=$mysqli->prepare($query);
        $query->execute();
        $query->bind_result($value);
        $query->fetch();
        return $value;
    }
    public function checkExistence($target,$field,$value){
        $mysqli=$this->connect();
        $query=$mysqli->prepare("select * from $target where $field=?");
        $query->bind_param("s",$value);
        $query->execute();
        $query->store_result();
        if($query->num_rows==0){
            switch($target){
                case 'estoque':
                case 'usuario': break;
                default:
                    if($target=='funcionario') $target=str_replace('a','á',$target);
                    echo "<span class='retorno' data-type='error'>O $target de $field $value não existe.</span>";
            }
            return false;
        }elseif($target=='usuario') return true;
    }
}