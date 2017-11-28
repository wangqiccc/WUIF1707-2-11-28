<?php
error_reporting(0);
$fill=$_FILES["file"];
if(!is_dir("./update")){
    mkdir("./update");
}
// is_dir() 用来判断某个文件夹是否存在
// mkdir() 创建一个文件夹
// explode() 类似于js中split
// array_pop() 类似于js中pop方法
// time() 获取当前的时间
// is_uploaded_file() 判断某个文件是否为上传文件
// move_uploaded_file() 将某个上传的临时文件移动到另一个文件夹中
$houzhui=array_pop(explode(".",$fill["name"]));
$filename=md5(time()+mt_rand(0,1000)).".".$houzhui;
if(is_uploaded_file($fill["tmp_name"])){
    move_uploaded_file($fill["tmp_name"],"./update/".$filename);
    echo "./update/".$filename;
}