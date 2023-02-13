<?php
include("./common.function.php");
$q = empty($_GET['q'])?"送你你一朵小红花":$_GET['q']; 
$q = urlencode($q);
$url = "https://movie.douban.com/j/subject_suggest?q=$q";
$res = curlGet($url);
$res = json_decode($res,true);
foreach ($res as $value) {
    $data[]=array(
        'title' => $value['title'],
        'img' => $value['img'],
        'id' => $value['id']
        );
}
header('content-type:application/json');
echo json_encode($data);