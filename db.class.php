<?php
class db{
    public $host="localhost";
    public $username="root";
    public $password="";
    public $dbname="school";
    public $db="school";
    public $table="";
    public function __construct($table)
    {
        header("Content-type:text/html;charset=utf-8");
        $this->db=new mysql(
            $this->host,$this->dbname,$this->username,$this->password
        );
        $this->table=$table;
        if($this->db->error){
            echo "数据库链接有误".$this->db->error;
            exit();
        }
    }
    function selectOne($filed="*",$where){
        $sql="set names utf8";
        $this->db->query($sql);
        $sql=" SELECT ".$filed." FROM ".$this->table." WHERE ".$where;
        $r=$this->db->query($sql);
        $r=$r->fetch_array(MYSQLI_ASSOC);
        return $r;
    }
    function selectAll($filed="*",$where=1){
        $sql=" SELECT ".$filed." FROM ".$this->table." WHERE ".$where;
        $r=$this->db->query($sql);
        $r=$r->fetch_All(MYSQLI_ASSOC);
        return $r;
    }
    function add($arr){
        $keys="";
        $vals="";
        foreach ($arr as $k=>$v){
            $keys.="`".$k."`".",";
            $vals.="'".$v."'".",";
        }
        $keys=substr($keys,0,strrpos($keys,","));
        $vals=substr($vals,0,strrpos($vals,","));
        $sql="INSERT INTO ". $this->table . " ( ".$keys. " )VALUES( " . $vals ." ) ";
        $this->db->query($sql);
        return $this->db->affected_rows;
    }
    function delete($pos){
        $sql="DELETE FROM" .$this->table ." WHERE " . $pos;
        $this->db->query($sql);
        return $this->db->affected_rows;
    }
    function updata($filed,$pos){
        $sql="UPDATA " .$this->table." SET "."$filed". ." WHERE " . $pos;
        $this->db->query($sql);
        return $this->db->affected_rows;
    }
    function close(){
        $this->db->close();
    }
}

$db=new db("student");
$r=$db->selectOne("*","id=1");
$r=$db->selectAll("id,sname","ssex='男' order by id desc");





?>