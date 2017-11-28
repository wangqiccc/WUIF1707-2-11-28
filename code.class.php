


<?php
//这是自己理解加上参考秦超的写的，我跟他的不一样，现在也有BUG，然后老师帮忙看看
class code
{
    public $width;
    public $height;
    public $img;
    public $str = "qwertyupasdfghjkzxcvbnm23456789";
    public $word = "";
    public $color = "";

    function __construct($width, $height)
    {
        $this->width = $width;
        $this->height = $height;
        $this->img = imagecreatetruecolor($width, $height);
    }

    function getcolor($type = "1")  //给颜色赋值
    {
        if ($type == "l") {
            $this->color = imagecolorallocate($this->img, mt_rand(130, 255), mt_rand(130, 255), mt_rand(130, 255));
        } else {
            $this->color = imagecolorallocate($this->img, mt_rand(0, 130), mt_rand(0, 130), mt_rand(0, 130));
        }
    }

    function imageFill()
    {
        //生成图片
        imagefill($this->img, 0, 0, $this->color);
        //随机画10条长短不一的线
        for($i=0;$i<10;$i++){
            imageline($this->img,mt_rand(0,$this->width),mt_rand(0,$this->height),mt_rand(0,$this->width),mt_rand(0,$this->height),$this->color);

        }
        echo $this->img;
        //随机画50点点
        for($i=0;$i<50;$i++){
            imagesetpixel($this->img,mt_rand(0,$this->width),mt_rand(0,$this->height),$this->color);
        }
    }
    function imagefont(){   //添加字母
        $len=strlen($this->str);
        for ($i = 0; $i < 4; $i++) {
            $pos = mt_rand(0, $len - 1);
            $letter = substr($this->str, $pos, 1);
            $this->word .= strtoupper($letter);
            imagettftext($this->img, mt_rand(25, 35), mt_rand(-20, 20), $i * $this->height + ($this->width - $this->height*4), mt_rand(30, 40), $this->color, "font.TTF", $letter);
        }
        session_start();
        $_SESSION["word"]=$this->word;
        header("Content-type:image/png");
        imagepng($this->img);
        imagedestroy($this->img);
    }
    function start(){
        $this->getcolor("q");
        $this->imageFill();
        $this->imagefont();
    }
}
$image=new code(180,40);
//$image->start();
$this->getcolor();
$this->imageFill();
$this->imagefont();