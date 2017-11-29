<?php
class code{
    public $height;
    public $width;
    public $img="";
    public $color;
    public $str;
    public $len;
    public $word="";
    public $pos;
    public $leter;

    function __construct()
    {
        $this->height=40;
        $this->width=180;


        $this->img=imagecreatetruecolor($this->width,$this->height);
    }



     function getcolor($type="l"){
        if($type=="l"){ //随机颜色为亮色
            $this->color=imagecolorallocate($this->img,mt_rand(130,255),mt_rand(130,255),mt_rand(130,255));
        }else{  //随机颜色为暗色
            $this->color=imagecolorallocate($this->img,mt_rand(0,130),mt_rand(0,130),mt_rand(0,130));
        }
         return $this->color;
    }

    // 获取线
    function getline(){
        for($i=0;$i<10;$i++){
            imageline($this->img,mt_rand(0,$this->width),mt_rand(0,$this->height),mt_rand(0,$this->width),mt_rand(0,$this->height),$this->getcolor());
        }
    }
// 获取点
    function getdian(){
        for($i=0;$i<30;$i++){
            imagesetpixel($this->img,mt_rand(0,$this->width),mt_rand(0,$this->height),$this->getcolor());
        }
    }
//    不区分大小写
    function size(){
        $this->str="asdfsdvferhtrhdsfer4564651676";
        $this->len=strlen($this->str);
        for($i=0;$i<4;$i++){
            $this->pos=mt_rand(0,$this->len-1);
            $this->leter=substr($this->str,$this->pos,1);
            $this->word.=strtoupper($this->leter);//不区分大小写的写法

            imagettftext($this->img,mt_rand(18,20),mt_rand(-30,10),$i*20+10,mt_rand(20,30),$this->getcolor("d"),"font.ttf",$this->leter);
        }
    }
    function init(){
        imagefill($this->img,0,0,$this->getcolor());
        $this->getcolor();
        $this->getdian();
        $this->getline();
        $this->size();
        session_start();
        $_SESSION['code']=$this->word;
        header("Content-type:image/png");
        imagepng($this->img);
        imagedestroy($this->img);
    }
}
$obj=new code();
$obj->init();




