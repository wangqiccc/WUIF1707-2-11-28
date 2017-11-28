<?php

class Upload{
    public $data;
    public $type=["image/jpeg","image/jpg","image/gif","image/png"];
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
        $hz=array_pop($arr);
        $this->filename=md5(time()).".".$hz;
    }
    function getpathname(){
        if(!is_dir("./upload")){    //判断是否有upload这个文件夹
            mkdir("./upload");//创建一个文件夹
        }
        $this->pathname="./upload"."/".date("Y-m-d")."/";
        if(!is_dir($this->pathname)){//判断是否有文件路径
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
    function uplodes(){
        $this->getfilename();
        $this->getpathname();
       if($this->check()){
           $this->move();
       }
}

}
$upload=new Upload("file");
$upload->uplodes();
?>