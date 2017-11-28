<?php
class db{
    public $host="localhost";
    public $username="root";
    public $password="";
    public $dbname="school";
    public $db="";
    public $table="";//当前查询表的名字
    function __construct($table)//连接和判断
    {
        header("Content-type:text/html;charset=utf-8");
        $this->db=new mysqli($this->host,$this->username,$this->password,$this->dbname);
        $this->table=$table;
//        连接测试
        if($this->db->error){
            echo "数据库连接有误".$this->db->error;
            exit();
        }
    }
//    定义数据库查询方法
    function selectOne($filed="*",$where){
        $sql="set names utf8";
        $this->db->query($sql);
        $sql="SELECT ".$filed." FROM ".$this->table." WHERE ".$where;
        $r=$this->db->query($sql);
        $r=$r->fetch_array(MYSQLI_ASSOC);
        return $r;
    }
    function selectall($filed='*',$where="1"){
        $sql="SELECT ".$filed." FROM ".$this->table." WHERE ".$where;
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
        }
//        最后出现的位置strrpos;第一次出现的位置strpos
        $keys=substr($keys,0,strrpos($keys,","));
        $vals=substr($vals,0,strrpos($vals,","));
        $sql="INSERT INTO ".$this->table."(".$keys.")VALUES (" .$vals .")";
        return $this->db->affected_rows;
    }
    function delete($pos){
        $sql="DELETE FROM ".$this->table." WHERE ".$pos;
        $this->db->query($sql);
        return $this->db->affected_rows;
    }
    function update($filed,$pos){
        $sql="UPDATE ".$this->table."SET ".$filed. "WHERE ".$pos;
        $this->db->query($sql);
        return $this->db->affected_rows;
    }
    function close(){
        $this->db->close();
    }

}
$db=new db("student");
$r=$db->selectOne("*","id=1");
var_dump($r);
$r=$db->selectall("sname","ssex='女'");
var_dump($r);
?>