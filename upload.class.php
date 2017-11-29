<?php
    class Upload{
        public $data;   //接收上传文件
        public $type=["image/png","image/jpg","image/gif","image/jpeg"];
        public $filename="";
        public $pathname="";
        public $fullname="";
        function __construct($f)
        {
            $this->data=$_FILES[$f];
            $this->size=1024*1024*10;  //10兆
        }
        function getfilename()      //获取文件名称
        {
            $arr=explode(".",$this->data["name"]);  //分隔
            $houzhui=array_pop($arr);   //删除数组中的最后一个数，并返回删除的这个数
            var_dump($houzhui);
            $this->filename=md5(time()).".".$houzhui;
            echo ($this->filename);
        }
        function getpathname(){     //获取路径
            if(!is_dir("./upload")){
                mkdir("./upload");
            }
            $this->pathname="./upload"."/".date("Y-m-d")."/";
            if(!is_dir($this->pathname)){
                mkdir($this->pathname);
            }
            $this->fullname=$this->pathname.$this->filename;
        }
        function check(){   //执行判断
            if($this->data["size"]>$this->size){
                return false;
            }
            if(!in_array($this->data["type"],$this->type)){     //判断是否某一数组的成员之一
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
$upload=new Upload("f");
$upload->upload();

