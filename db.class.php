<?php
//数据库增删改查方法封装
class db{
    public $host="localhost";
    public $user="root";
    public $password="";
    public $dbname="school";
    public $db="";
    public $table="";
    function __construct($table)
    {
        $this->db=new mysqli($this->host,$this->user,$this->password,$this->dbname);
        $this->table=$table;
        if($this->db->error){
            echo "数据库连接有误".$this->db->error;
            exit();
        }
    }
    function selectone($filed="*",$where){
        $sql="SELECT " .$filed." FROM ".$this->table." WHERE ".$where;
        $r=$this->db->query($sql);
        $r=$r->fetch_array(MYSQLI_ASSOC);
        return $r;
    }
    function selectall($filed="*",$where="1"){
        $sql="SELECT " .$filed." FROM ".$this->table." WHERE ".$where;
        $r=$this->db->query($sql);
        $r=$r->fetch_all(MYSQLI_ASSOC);
        return $r;
    }
    function add($arr){
        $keys="";
        $vals="";
        foreach ($arr as $k=>$v){
            $keys.="`".$k."`".",";
            $vals.="'".$v."'".",";
            $keys=substr($keys,0,strrpos($keys,","));
            $vals=substr($vals,0,strrpos($vals,","));
            $sql="INSERT INTO " .$this->table." (". keys .")VALUES(" . vals . ")";
            $r=$this->db->query($sql);
            return $this->db->affected_rows;
        }
    }
    function delete($pos){
        $sql="DELETE FROM ".$this->table." WHERE ".$pos;
        $this->db->query($sql);
        return $this->db->affected_rows;
    }
    function update($filed,$pos){
        $sql="UPDATE ".$this->table." SET ".$filed." WHERE ".$pos;
        $this->db->query($sql);
        return $this->db->affected_rows;
    }
    function close(){
        $this->db->close();
    }
}
$d=new db("student");
$r=$db->selectone("*","id=1");
var_dump($r);
$r=$db->add(["name"=>"lili","age"=>19,"sex"=>"女","cid"=>1]);
$db->close();
