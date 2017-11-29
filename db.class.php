
<?php
class db
 {
        public $host = "localhost";
     public $username = "root";
     public $password = "";
     public $dbname = "school";
     public $db = "";
     public $table = "";

     function __construct($table)
     {
                $this->db = new mysqli($this->host, $this->username, $this->password, $this->dbname);
                $this->table = $table;
                $sql = "set names utf8";
                $this->db->query($sql);

            }

     function selectOne($filed = "*", $where)
     {
                $sql = "SELECT " . $filed . " FROM " . $this->table . " WHERE " . $where;
                $r = $this->db->query($sql);
                $r = $r->fetch_array(MYSQLI_ASSOC);
                return $r;
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
         $sql = "insert into " . $this->table . " (" . $keys . ")values(" . $vals . ")";
         $this->db->query($sql);
         echo $sql;
         return $this->db->affected_rows;
     }

     function delete($where)
     {
                $sql = "delete from " . $this->table . " where " . $where;
                $this->db->query($sql);
                return $this->db->affected_rows;
     }

     function update($filed, $where)
     {
                $sql = "update " . $this->table . " set " . $filed . " where " . $where;
                $this->db->query($sql);
                return $this->db->affected_rows;
     }

     function close()
     {
                $this->db->close();
            }
 }

 $db = new db("student");
 $r = $db->selectOne("*", "id=2");
 $r = $db->selectAll("sname,id", "ssex='男'");
 $r = $db->delete("id=2");
 $r = $db->insert(["id" => "2", "sname" => "李四", "sage" => "15", "ssex" => "女", "cid" => "2"]);
 $r = $db->update("sage=24", "id=1");
 $db->close();
 ?>