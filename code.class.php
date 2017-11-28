<?php
 class Code{
     public $width;
     public $height;
     public $hb;
     public $color;
     function __construct($width=180,$height=40)
     {
         $this->width = $width;
         $this->height = $height;
         $this->hb=imagecreatetruecolor($this->width,$this->height);
     }
     function getcolor($hb,$type="l"){
         if($type=="l"){
            $this->color=imagecolorallocate($hb,mt_rand(130,255),mt_rand(130,255),mt_rand(130,255));
         }else{
             $this->color=imagecolorallocate($hb,mt_rand(0,130),mt_rand(0,130),mt_rand(0,130));
         }
         return $this->color;
     }
     function bjcolor(){
         imagefill($this->hb,0,0,$this->getcolor($this->hb,"d"));
         for($i=0;$i<10;$i++){
             imageline($this->hb,mt_rand(0,$this->width),mt_rand(0,$this->height),mt_rand(0,$this->width),mt_rand(0,$this->height),$this->getcolor());
         }
         for($i=0;$i<1000;$i++){
             imagesetpixel($this->hb,mt_rand(0,$this->width),mt_rand(0,$this->height),$this->getcolor());
         }
     }
     function words(){
         $str="qwertyuiopasdfghjklmnbvcxz1234567890";
         $len=strlen($str);
         $word="";
         for($i=0;$i<4;$i++){
             $pos=mt_rand(0,$len-1);    
             $letter=substr($str,$pos,1);
             $word.=strtoupper($letter); 
             imagettftext($this->hb,mt_rand(30,35),mt_rand(-40,30),$i*40+10,mt_rand(25,30),$this->getcolor("d"),"fontsile.TTF",$letter);
         }
         imagepng($this->hb);
         imagedestroy($this->hb);
     }
     function yanzhengma(){
         $this->words();
         $this->bjcolor();
     }
 
 }
 $code=new Code();
 $code->yanzhengma();
 
 ?> 