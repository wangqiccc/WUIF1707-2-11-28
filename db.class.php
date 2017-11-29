<?php
header("Content-Type:text/html;charset=utf-8");
class db{
    public $host = "localhost";
    public $username = "root";
    public $password = "";
    public $dbname = "zuoye";
    public $db = "";
    public $table = "";
    function __construct($table)
    {
        $this->db = new mysqli($this->host, $this->username, $this->password, $this->dbname);
        $this->table = $table;
        if ($this->db->errno) {
            echo "数据库链接错误" . $this->db->error;
            exit();
        }
        $sql="set names utf8";
        $this->db->query($sql);
    }

    function selectOne($filed = "*", $where)
    {
        $sql = "SELECT " . $filed . " FROM " . $this->table . " WHERE " . $where;
        $r = $this->db->query($sql);
        $v = $r->fetch_array(MYSQLI_ASSOC);
        return $v;
    }

    function selectAll($filed = "*", $where = "1")
    {
        $sql = "SELECT " . $filed . " FROM " . $this->table . " WHERE " . $where;
        $r = $this->db->query($sql);
        $r = $r->fetch_all(MYSQLI_ASSOC);
        return $r;
    }

    function insert($arr)
    {
        $keys = "";
        $vals = "";
        foreach ($arr as $k => $v) {
            $keys .= "`" . $k . "`" . ",";
            $vals .= "'" . $v . "'" . ",";
        }
        $keys = substr($keys, 0, strrpos($keys, ","));
        $vals = substr($vals, 0, strrpos($vals, ","));
        $sql = "INSERT INTO " . "$this->table" . " (" . $keys . ")VALUES(" . $vals . ")";
        $this->db->query($sql);
        return $this->db->affected_rows;
    }

    function delete($pos)
    {
        $sql = "DELETE FROM " ."$this->table". " WHERE " . $pos;
        $this->db->query($sql);
        return $this->db->affected_rows;
    }

    function update($filed, $pos)
    {
        $sql = "UPDATE " . $this->table . " SET " . $filed . " WHERE " . $pos;
        $this->db->query($sql);
        return $this->db->affected_rows;
    }
    function close()
    {
        $this->db->close();
    }
}

$db = new db("spb");
//$r = $db->selectOne("*","id=1");
//$r = $db->selectAll("id,spmc", "splxid=1 order by id DESC");
//$r = $db->insert(["spmc" => "青龙偃月", "spjg" => 780, "splxid" => 3, "chl" => 77]);
//$r = $db->delete("id=12");
//$r = $db->update("chl=30", "id=11");
//$db->close();
var_dump($r);

