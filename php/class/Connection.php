<?php
class Connection {
    protected $conn;
    protected $host;
    protected $db;
    protected $user;
    protected $password;
    public function connect(){
        if(server("SERVER_ADDR")=="::1"||server("SERVER_ADDR")=="127.0.0.1"){
            $this->host="localhost";
            $this->db="sefuncbd";
            $this->user="root";
            $this->password="";
        }else{
            $this->host="mysql.hostinger.com.br";
            $this->db="u398318873_bda";
            $this->user="u398318873_tj";
            $this->password="Knowledge1";
        }
        $conn=$this->conn=mysqli_connect($this->host,$this->user,$this->password,$this->db);
        if(mysqli_connect_errno()) AJAXReturn("error","Falha ao se conectar ao MySQL:<p>($conn->connect_errno)</p><p>$conn->connect_error</p>");
    }
    public function getValue($fields,$table,$searchField,$search){
        if(!is_array($fields)) $fields=[$fields];
        $values="{";
        foreach($fields as $i=>$field){
            $query="select $field from $table";
            if($searchField!=""){
                $query.=" where $searchField=?";
                $query=$this->conn->prepare($query);
                $query->bind_param("s",$search);
            }else $query=$this->conn->prepare($query);
            $query->execute();
            $query->bind_result($value);
            $query->fetch();
            if(count($fields)>1) $values.="'$field':'$value'".($i!=count($fields)-1?",":"");
        }
        return count($fields)==1?$value:json_decode(fixJSON("$values}"));
    }
    public function checkExistence($target,$field,$value){
        $query=$this->conn->prepare("select * from $target where $field=?");
        $query->bind_param("s",$value);
        $query->execute();
        $query->store_result();
        if($query->num_rows==0){
            switch($target){
                case "estoque":
                case "usuario":break;
                default:AJAXReturn("error","O ".($target=="funcionario"?str_replace("a","á",$target):$target)." de $field $value não existe.");
            }
            return false;
        }elseif($target=="usuario") return true;
    }
}