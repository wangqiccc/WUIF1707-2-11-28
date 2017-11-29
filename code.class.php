<?php
class Code{
    public $width;
    public $height;
    public $img;
    public $st="qwertyuoplkjhgfdsazxcvbnm23456789";
    function __construct($width,$height)
    {
        $this->width = $width;
        $this->height = $height;
        $this->img = imagecreatetruecolor("$this->width", "$this->height");

    }
    function getcolor($img, $type = "l"){
    if ($type == "l") {
        $color = imagecolorallocate($img, mt_rand(130, 255), mt_rand(130, 255), mt_rand(130, 255));
    } else {
        $color = imagecolorallocate($img, mt_rand(0, 130), mt_rand(0, 130), mt_rand(0, 130));
    }
    return $color;
}
    function drawbg(){
        imagefill($this->img, 0, 0, $this->getcolor($this->img, "q"));
        for ($i = 0; $i < 20; $i++) {
            imageline($this->img, mt_rand(0, $this->width), mt_rand(0, $this->height), mt_rand(0, $this->width), mt_rand(0, $this->height), $this->getcolor($this->img));
        };
        for ($i = 0; $i < 200; $i++) {
            imagesetpixel($this->img, mt_rand(0, $this->width), mt_rand(0, $this->height), $this->getcolor($this->img));
        }
    }

    function Words(){
        $len=strlen($this->st);
        $font="";
        for ($i = 0; $i < 4; $i++) {
            $pot = mt_rand(0, $len - 1);
            $letter = substr($this->st, $pot, 1);
            $font .= strtoupper($letter);
            imagettftext($this->img, mt_rand(20, 40), mt_rand(-30, 30), $i * 40 + 20, mt_rand(30, 40), $this->getcolor($this->img,"l"), "AGAINTS.OTF", $letter);
        }
        session_start();
        $_SESSION["code.class"]=$font;
        header("Content-type:image/png");
        imagepng($this->img);
        imagedestroy($this->img);
    }

}
$code=new Code(180,60);
$code->drawbg();
$code->Words();
