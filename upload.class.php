<?php
class Upload{
    public $data;//接收上传文件
    public $type = ["image/png", "image/jpg", "image/gif", "image/jpeg"];
    public $filename="";
    public $pathname="";
    public $fullname="";
    function __construct($f)
    {
        $this->data=$_FILES[$f];
        $this->size=1024*1024*10;
    }
    function getfilename(){
        $arr=explode(".",$this->data["name"]);
        $houzhui=array_pop($arr);
        $this->filename=md5(time()).".".$houzhui;
    }
    function  getpathname(){
        if(!is_dir("./upload")){
            mkdir("./upload");
        }
        $this->pathname="./upload"."/".date("Y-m-d")."/";
        if(!is_dir($this->pathname)){
            mkdir($this->pathname);
        }
        $this->fullname=$this->pathname.$this->filename;
    }
    function check(){
        if($this->data["size"]>$this->size){
            return false;
        }
        if(!in_array($this->data["type"],$this->type)){
            return false;
        }
        return true;
    }
    function move(){
        if(is_uploaded_file($this->data["tmp_name"])){
            move_uploaded_file($this->data["tmp_name"],$this->fullname);
            echo $this->fullname;
        }
    }
    function upload(){
        $this->getfilename();
        $this->getpathname();
        if($this->check()){
            $this->move();
        }
    }
}
$upload = new Upload("f");
$upload->upload();
