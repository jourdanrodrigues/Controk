<?php
class Connection {
    protected $conn;
    public function connect($i=0){
        $env=server("SERVER_ADDR")=="::1"||server("SERVER_ADDR")=="127.0.0.1"?true:false;
        $conn=mysqli_connect(
            ($env?"localhost":"mysql.hostinger.com.br"),
            ($env?"root":"u398318873_tj"),
            ($env?"":"Knowledge1"),
            ($env?"controk":"u398318873_bda"));
        if(mysqli_connect_errno()) AJAXReturn("error","Falha ao se conectar ao MySQL:<p>($conn->connect_errno)</p><p>$conn->connect_error</p>");
        elseif($i==0) $this->conn=$conn;
        elseif($i==1) return $conn;
    }
    public function getValue($fields,$table,$searchField,$search){
        $conn=$this->connect(1);
        if(!is_array($fields)) $fields=[$fields];
        $bind=$f=$json="";
        foreach($fields as $a){
            $comma=$fields[count($fields)-1]!=$a?",":"";
            $f.="$$a$comma";
            $json.=count($fields)>1?"'$a':'$$a'$comma":"$$a";
            $bind.="s";
        }
        if(count($fields)>1) $json="{ $json}";
        $query="select ".str_replace("$","",$f)." from $table";
        if($searchField!=""){
            $query.=" where $searchField=?";
            $query=$conn->prepare($query);
            $query->bind_param("s",$search);
        }else $query=$conn->prepare($query);
        $query->execute();
        eval("\$query->bind_result($f);");
        $query->fetch();
        eval("\$value=\"$json\";");
        $conn->close();
        return count($fields)==1?$value:json_decode(fixJSON($value));
    }
    public function checkExistence($target,$field,$value){
        $conn=$this->connect(1);
        $query=$conn->prepare("select * from $target where $field=?");
        $query->bind_param("s",$value);
        $query->execute();
        $query->store_result();
        $conn->close();
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