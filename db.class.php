<?php
class db{
    public $host="localhost";
    public $username="root";
    public $paseword="root";
    public $dbname="school";
    public $db="";
    public $table="";
    function __construct($table)
    {
        $this->db=new mysqli($this->host,$this->username,$this->paseword,$this->dbname,$this->table=$table);
        if($this->db->errno){
            echo"数据库链接错误".$this->db->error;
            exit();
        }
    }
    function selectOne($filed="*",$where){
        $sql=" SELECT " .$filed ." FROM ".$this->table. " WHERE " .$where;
        $r=$this->db->query($sql);
        $r=$r->fetch_array(MYSQLI_ASSOC);
        return $r;
    }
    function selectAll($filed="*",$where="1"){
        $sql=" SELECT ".$filed." FROM ".$this->table." WHERE ".$where;
        $r=$this->db->query($sql);
        $r->fetch_all(MYSQLI_ASSOC);
        return $r;
    }
    function add($arr){
        $keys="";
        $vals="";
        foreach ($arr as $k=>$v){
            $keys .= "`" .$k. "`" . ",";
            $vals .= "''" .$v."''". ",";
        }
        $keys=substr($keys,0,strrpos($keys,","));
        $sql="INSERT INTO ".$this->table."(".$keys.")VALUES(". $vals .")";
        $this->db->query($sql);
        return $this->db->affected_rows;
    }
    function delete($pos){
        $sql="DELETE FROM ".$this->table." WHERE "."pos";
        $this->db->query($sql);
        return $this->db->affected_rows;
    }
    function update($filed,$pos){
        $sql="UPDATE ".$this->table." SET ".$filed." WHERE ".$pos;
        $this->db->query($sql);
        return $this->db->affected_rows;
    }
}
$db=new db("student");
