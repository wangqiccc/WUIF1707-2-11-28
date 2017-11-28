<?php
    class db{
        public $host="localhost";
        public $username="root";
        public $password="";
        public $dbname="shopping";
        public $db="";
        public $table="";
        function __construct($table)
        {
            $this->db=new mysqli
            ($this->host,$this->username,$this->password,$this->dbname);
            $this->table=$table;
            if($this->db->errno){
                echo "数据库链接有误".$this->db->error;
                exit();
            }
        }
        function selectone($filed="*",$where){
            $sql="select ".$filed." from".$this->table." where ".$where;
            $r=$this->db->query($sql);
            $r=$r->fetch_array(MYSQLI_ASSOC);
            return $r;
        }
        function selectall($filed="*",$where="1"){
            $sql="select ".$filed." from".$this->table." where ".$where;
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
            $sql="insert into ".$this->table." (".$keys.")values(".$vals.")";
            $this->db->query($sql);
            return $this->db->affected_rows;
        }
        function delete($pos){
            $sql="delete from ".$this->table." where ".$pos;
            $this->db->query($sql);
            return $this->db->affected_rows;
        }
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