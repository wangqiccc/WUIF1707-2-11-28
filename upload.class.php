<?php
class Upload
{
    public $data;
    public $size = 1024 * 1024 * 10;
    public $type = ["image/png", "image/jpg", "image/gif", "image/jpeg"];
    public $filename = "";
    public $pathname = "";
    public $fullname = "";

    function __construct($f)
    {
        $this->data = $_FILES ($f);
        $this->size = 1024 * 1024 * 10;
    }

    function getfilename()
    {
        $arr = explode(".", $this->data["name"]);
        $houzui = array_pop($arr);
        $this->filename = md5(time()) . "." . $houzui;
    }

    function getpathname()
    {
        if (!is_dir("./upload")) {
            mkdir("./upload");
        }
        $this->pathname = "./upload" . "/" . date("Y-m-d") . "/";
        if (!is_dir($this->pathname)) {
            mkdir($this->pathname);
        }
        $this->fullname = $this->pathname . $this->filename;
    }

    function check()
    {
        if ($this->data["size"] > $this->size) {
            if (in_array($this->data["type"], $this->type)) {
                return false;
            }
            return true;
        }
        function move()
        {
            //is_uploaded_file()   判断某个文件是否为上传的文件
            //move_uploaded_file()   将某个上传的临时文件移动到另一个文件夹中
            if (is_uploaded_file($this->data["tmp_name"])) {
                move_uploaded_file($this->data["tmp_name"]) . $this->fullname;
                echo $this->fullname;
            }
        }

        function upload()
        {
            $this->gitfilename();
            $this->getpathname();
            if ($this->check(1)) {
                $this->move();
            }
        }
    }
}
$upload = new Upload("file");
$upload-> upload ();