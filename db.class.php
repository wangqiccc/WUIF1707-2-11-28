<?php
header("Content-type:text/html;charset=utf-8");
class db{
    public $host="localhost";
    public $username="root";
    public $password="";
    public $dbname="school";
    public $db="";
    public $table="";
    function __construct($table)
    {
        $this->db=new mysqli($this->host,$this->username,$this->password,$this->dbname);
        $this->table=$table;
        if($this->db->errno){
            echo "数据库连接有误".$this->db->error;
            exit();
        }
        $sql="set names utf8";
        $this->db->query($sql);
    }
    function selectOne($filed="*",$where){
        $sql="select ".$filed." FROM ".$this->table." WHERE ".$where;
        $r=$this->db->query($sql);
        $r=$r->fetch_array(MYSQLI_ASSOC);
        return $r;
    }
    function selectAll($filed="*",$where="1"){
        $sql="select ".$filed." FROM ".$this->table." WHERE ".$where;
        $r=$this->db->query($sql);
        $r=$r->fetch_all(MYSQLI_ASSOC);
        return $r;
    }
    function insert($arr){
        $keys="";
        $vals="";
        foreach ($arr as $k=>$v){
            $keys.="`".$k."`".",";
            $vals.="'".$v."'".",";
        }
        $keys=substr($keys,0,strrpos($keys,","));

        $sql="INSERT INTO ".$this->table." (" .$keys . ")VALUES(" . $vals . ")";
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
$db = new db("student");
//$r=$db->selectOne("*","id=2");
//$r=$db->selectAll("id,sname","ssex='男' order by id desc");
//$r=$db->delete("id=1");
$r=$db->update("ssex='女'","id=3");
var_dump($r);
?>

//验证码类
