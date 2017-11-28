<?php

 class Upload
 {
     public $img;
     public $size;
     public $type = ["image/jpeg", "image/jpg", "image/png", "image/gif"];
     public $filename = "";
     public $pathname = "";
     public $fullname = "";

     function __construct($img)
     {
         $this->img = $_FILES[$img];
        $this->size = 1024 * 1024 * 10;
    }

    function getfullname()
    {
        $d = explode(".", $this->img["name"]);
        $type = array_pop($d);
        $this->filename = md5(time()  mt_rand(0, 1000)) . "." . $type;
        $this->pathname = "./imgs" . "/" . date("Y-m-d") . "/";
        if (!is_dir("./imgs")) {
            mkdir("./imgs");
        }
        if (!is_dir($this->pathname)) {
            mkdir($this->pathname);
        }
        $this->fullname = $this->pathname . $this->filename;

    }

    function check()
    {
        if ($this->img["size"] > $this->size) {
            return false;
        }
        if (!in_array($this->img["type"], $this->type)) {
            return false;
        }
        return true;
    }

    function move()
    {
        if (is_uploaded_file($this->img["tmp_name"])) {
            move_uploaded_file($this->img["tmp_name"], $this->fullname);
        }
    }
}

$upload = new Upload("img");
$f = $upload->check();
if (!$f) {
    exit;
}
$upload->getfullname();
$upload->move();
echo $upload->fullname;
