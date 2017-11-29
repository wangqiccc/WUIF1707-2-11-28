<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        *{
            font-size: 18px;

        }
        #container{
            width: 500px;
            height: 400px;
            border:1px solid red;
            margin:0 auto;
        }
        input:not([type=button]){
            display: block;
        }
        #showarea{
            width: 100%;
            background: #ccc;
        }
        #showarea img{
            width: 100px;
            height:auto;
            display: block;
        }
    </style>
</head>
<body>
<!--filteReader()文件预览h5-->
<!--Formdate（）h5新增加的-->
<div id="container">
    <input type="file" name="myfile">
    <progress min="0" max="100" value="0" id="pro"></progress>
<!--    表示当前进度 h5新增加的-->
    <input type="button" id="btn" value="上传">
    <div id="showarea" >

    </div>
    <input type="hidden" name="image">
</div>
</body>
<script>
    var fileobj=document.querySelector('[name=myfile]');
    var showobj=document.querySelector('#showarea');
    var btnobj=document.querySelector('#btn');
    var hiddenobj=document.querySelector('[name=image]');
    var proobj=document.querySelector('#pro');
    var maxSize=1024*1024*10;
    var typeReg=/^image\/(jpe?g|png|gif)$/;
    fileobj.onchange=function(){//当选择按钮发生改变的时候
        var file=this.files[0];
        console.log(file);
        var r=check(file);
        console.log(r);
        if(!r){
            this.value='';
            return false;
        }
        var fr=new FileReader();
        fr.readAsDataURL(file);
        fr.onload=function(){
            var img=new Image();
            img.src=this.result;
            showobj.appendChild(img);
        }
    }
    function check(file){
        if(file.size>maxSize){
            alert("文件大小超过10M");
            return false;
        }
        if(!typeReg.test(file.type)){
            alert("文件类型不符合");
            return false;
        }
        return true;
    }
    btnobj.onclick=function(){
        var file=fileobj.files[0]
        var fd=new FormData();
        fd.append('f',file);
        var xhr=new XMLHttpRequest();
        xhr.upload.onprogress=function(e){
            var bili=e.loaded/e.total;
            proobj.value=bili*100;
        }
        xhr.open("post","upload.class.php");
        xhr.send(fd);
        xhr.onload=function(){
            var r=xhr.response;
            hiddenobj.src=r;
        }
    }

</script>
</html>