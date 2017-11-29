<?php
//对于数据库操作的类
class db{
    public $host="localhost";
    public $username="root";
    public $password="";
    public $dbname="school";
    public $table="";
    public $db="";
    function __construct($table){
        $this->db=new mysqli(
            $this->host,
            $this->username,
            $this->password,
            $this->dbname);
        $this->table=$table;
        if($this->db->error){
            echo "数据库连接有误".$this->db->error;
            exit();
        }
    }
    function selectOne($filed="*",$where){
        $sql="select ".$filed." from ".$this->table." where ".$where;
        $r=$this->db->query($sql);
        $r=$r->fetch_array("MYSQLI_ASSOC");
        return $r;
    }
    function selectAll($filed="*",$where="1"){
        $sql="select ".$filed." from ".$this->table." where ".$where;
        $r=$this->db->query($sql);
        $r=$r->fetch_all("MYSQLI_ASSOC");
        return $r;
    }
//   增加
    function add($arr){
        $keys="";
        $vals="";
        foreach($arr as $k=>$v){
            $keys.="`".$k."`".",";
            $vals.="'".$v."'".",";
        }
        $keys=substr($keys,0,strrpos($keys,","));
        $vals=substr($vals,0,strrpos($vals,","));
        $sql="insert into ".$this->table." (".$keys.")  values(".$vals.")";
        $this->db->query($sql);
        return $this->db->affected_rows;
    }
    function delete($pos){
        $sql="delete from ".$this->table." where ".$pos;
        $this->db->query($sql);
        return $this->db->affected_rows;
    }
//    删除的位置
    function update($filed,$pos){
        $sql="update ".$this->table." set ".$filed." where ".$pos;
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
$r=$db->add(["sname"=>"小明","sage"=>18,"ssex"=>"男","cid"=>1]);
$r=$db->delete("id=2");
$r=$db->update("grade=100","id=2");
$db->close();


//验证码封装类

?>