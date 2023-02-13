<?php
header('Cache-Control: no-cache');
header('X-Accel-Buffering: no');
set_time_limit(0);
ob_end_clean();
ob_implicit_flush(1);
include("./common.function.php");
function getDoubanIdAndDialogue($cikeeeId){
    $url = "https://www.cikeee.com/mov/$cikeeeId/";
    $html = str_get_html(curlGet($url));
    preg_match('/subject\\/(.*)\\//',$html->find("a#rate-box",0)->href,$_doubanId);
    // print_r($_doubanId[1]);
    preg_match('/“(.*)”/',$html->find("div#movie-text",0)->innertext,$_Dialogue);
    //print_r($_Dialogue[1]);
    $title = $html->find("div#movie-title",0)->innertext;
    $similarId = array();
    foreach ($html->find("a.similar-movie") as $value){
        preg_match('/mov\\/(.*)\\//',$value->href,$_similarId);
        $similarId[] = $_similarId[1];
    }
    
    return array(
        "doubanId" => $_doubanId[1],
        "dialogue" => $_Dialogue[1],
        "title" => $title,
        "similarId"=>$similarId
    );
    
}
//echo getDoubanIdAndDialogue(674319702628852);
$cikeeeId = "";
do{
$arr = json_decode(file_get_contents("./data.json"),true);
if(!$arr){
    $arr = array(
        "count"=>"0",
        "data"=>array()
    );
}
if(!$cikeeeId){
    $cikeeeId = 675706755552613;
}
$_data = getDoubanIdAndDialogue($cikeeeId);
$data = array(
    "doubanId" => $_data['doubanId'],
    "dialogue" => $_data['dialogue'],
    "title" => $_data['title'],
    "cikeeeId"=>$cikeeeId
);
if($data["doubanId"]&&!in_array($data,$arr['data'])){
    $arr['data'][]=$data;
    $arr['count']++;
    file_put_contents("./data.json",json_encode($arr));
}
//$cikeeeId = $_data['similarId'][0];
foreach($_data['similarId'] as $value){
    $cikeeeId = $value;
    if(in_array($value, array_column($arr['data'], 'cikeeeId'))){
        break;
    }
}
echo $arr["count"];
}
while($arr["count"]<200)
?>