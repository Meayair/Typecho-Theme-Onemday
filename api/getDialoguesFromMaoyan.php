<?php
include("./common.function.php");
$data = array();
$id = empty($_GET['id'])?1304:$_GET['id'];
$url = "https://m.maoyan.com/apollo/movie/$id/extras/dialogues";
$html = str_get_html(curlGet($url));
foreach ($html->find("ul.list-view-wider li.list-view-item ") as $value) {
    $data[] = $value->innertext;
}
header('content-type:application/json');
echo json_encode($data);