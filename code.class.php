<?php
class Code{
    public $width;
    public $height;
    public $img;
    public $str="qwertyuopasdfghkzxcvbnmQWERTYUOPASDFGHKZXCVBNM234567890";
    function __construct($width,$height)
    {
        $this->width=$width;
        $this->height=$height;
        //创建画布
        $this->img=imagecreatetruecolor($this->width,$this->height);
    }
    function getcolor($img, $type = "l")
    {
        if ($type == "l") {
            $color = imagecolorallocate($img, mt_rand(130, 255), mt_rand(130, 255), mt_rand(130, 255));
        } else {
            $color = imagecolorallocate($img, mt_rand(0, 130), mt_rand(0, 130), mt_rand(0, 130));
        }
        return $color;
    }
    function drawline()
    {
        imagefill($this->img, 0, 0, $this->getcolor($this->img));
        for ($i = 0; $i < 10; $i++) {
//            画线
            imageline($this->img, mt_rand(0, $this->width), mt_rand(0, $this->height), mt_rand(0, $this->width), mt_rand(0, $this->height), $this->getcolor($this->img));
//            画点
            imagesetpixel($this->img, mt_rand(0, $this->width), mt_rand(0, $this->height), $this->getcolor($this->img));
        }
    }
    function fill()
    {
        $len = strlen($this->str);
        $word = "";
        for ($i = 0; $i < 4; $i++) {
            $pos = mt_rand(0, $len - 1);
            $letter = substr($this->str, $pos, 1);
            $word .= strtoupper($letter);
            imagettftext($this->img, mt_rand(25, 35), mt_rand(-10, 10), $i * 40+20, mt_rand(30, 40), $this->getcolor($this->img, "l"), "font.TTf", $letter);
        }
        session_start();
        $_SESSION["code.class"] = $word;
        header("Content-Type:image/png");
        imagepng($this->img);
        imagedestroy($this->img);
    }
}

$code = new Code(180, 40);
$code->drawline();
$code->fill();