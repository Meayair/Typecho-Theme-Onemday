
<?php
$img = empty($_GET['img'])?"https://img9.doubanio.com/view/photo/s_ratio_poster/public/p2561305376.jpg":$_GET['img'];
?><!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta name="referrer" content="never">
        <title></title>
        <style>
        * {
            margin:0;
            padding:0;
        }
        html, body {
            height:100%;
        }
        img {
            width:100%;
        }
        </style>
    </head>
    
    <body>
        <img src="<?php echo $img?>"></img>
    </body>

</html>