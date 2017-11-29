<?php
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
            echo "数据库链接有误".$this->db->error;
            exit();
        }
    }
    function selectOne($filed="*",$where){
        $sql="SELECT ".$filed." FROM ".$this->table." WHERE ".$where;
        $r=$this->db->query($sql);
        $r=$r->fetch_array(MYSQLI_ASSOC);
        return $r;
    }
    function selectAll($filed="*",$where="1"){
        $sql="SELECT ".$filed." FROM ".$this->table." WHERE ".$where;
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
        $vals=substr($vals,0,strrpos($vals,","));
        $sql="INSERT INTO ".$this->table." (" . $keys . ")VALUES(" . $vals .")";
        $this->db->query($sql);
        return $this->db->affected_rows;
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
$db=new db("student");
$r=$db->selectOne("*","id=1");
$r=$db->selectAll("id,sname","ssex='男' order by desc");
$r=$db->insert(["sname"=>"小米","sage"=>18,"ssex"=>"男","scid"=>2]);
$db->close();

