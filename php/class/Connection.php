<?php
class Connection {
    protected $conn;
    public function connect(){
        $env=server("SERVER_ADDR")=="::1"||server("SERVER_ADDR")=="127.0.0.1"?true:false;
        $conn=$this->conn=mysqli_connect(
            ($env?"localhost":"mysql.hostinger.com.br"),
            ($env?"root":"u398318873_tj"),
            ($env?"":"Knowledge1"),
            ($env?"sefuncbd":"u398318873_bda"));
        if(mysqli_connect_errno()) AJAXReturn("error","Falha ao se conectar ao MySQL:<p>($conn->connect_errno)</p><p>$conn->connect_error</p>");
    }
    public function getValue($fields,$table,$searchField,$search){
        $this->connect();
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