<?php
include("./common.function.php");
$q = empty($_GET['q'])?"送你你一朵小红花":$_GET['q']; 
$q = urlencode($q);
$url = "https://i.maoyan.com/apollo/ajax/search?kw=$q&cityId=0&stype=-1";
$res = curlGet($url);
$res = json_decode($res,true);
foreach ($res['movies']['list'] as $value) {
    $data[]=array(
        'title' => $value['nm'],
        'img' => $value['img'],
        'id' => $value['id'],
        'act' => $value['act']
        );
}
header('content-type:application/json');
echo json_encode($data);