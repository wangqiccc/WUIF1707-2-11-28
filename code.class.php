<?php

class Code
{
    public $width;
    public $height;
    public $img;
    public $str="qwertyuiopasdfghjklmnbvcxz1234567890";
    function __construct($width,$height)
    {
        $this->width=$width;
        $this->height=$height;
        $this->img=imagecreatetruecolor($this->width,$this->height);
    }
    function getcolor($img,$type="l"){
        if ($type=="l"){
            $color=imagecolorallocate($img,mt_rand(130,255),mt_rand(130,255),mt_rand(130,255));
        }else{
            $color=imagecolorallocate($img,mt_rand(0,130),mt_rand(0,130),mt_rand(0,130));
        }
        return $color;
    }
    function drawBg(){
        imagefill($this->img,0,0,$this->getcolor($this->img,"d"));
        for($i=0;$i<10;$i++){
            imageline($this->img,mt_rand(0,$this->width),mt_rand(0,$this->height),mt_rand(0,$this->width),mt_rand(0,$this->height),$this->getcolor($this->img));
            imagesetpixel($this->img,mt_rand(0,$this->width),mt_rand(0,$this->height),$this->getcolor($this->img));
        }
    }
    function fillWords(){
        $length=strlen($this->str);
        $word="";
        for($i=0;$i<4;$i++){
            $pos=mt_rand(0,$length-1);
            $letter=substr($this->str,$pos,1);
            $word.=strtoupper($letter);
            imagettftext($this->img,mt_rand(25,35),mt_rand(-10,10),$i*40+10,mt_rand(30,40),$this->getcolor($this->img,"l"),"font.ttf",$letter);
        }
        session_start();
        $_SESSION["code.class"]=$word;
        header("Content-Type:image/png");
        imagepng($this->img);
        imagedestroy($this->img);
    }
}
$code=new Code(180,40);
$code->drawBg();
$code->fillWords();