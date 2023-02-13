<?php
error_reporting(E_ALL^E_NOTICE^E_WARNING);
include("./common.function.php");
$data = array();
$id = empty($_GET['id'])?35096844:$_GET['id'];
$url = "https://movie.douban.com/subject/$id/";
$html = str_get_html(curlGet($url));
$info = $html->find("div[id=info]",0);
//print_r($info);
$directedBys = "";
foreach ($info->find("a[rel=v:directedBy]") as $key => $value) {
    $directedBys .= $key?"、":"";
    $directedBys .= $data['directedBys'][]=$value->innertext;
}
$stars = "";
foreach ($info->find("a[rel=v:starring]") as $key => $value) {
    $stars .= $key?"、":"";
    $stars .= $data['stars'][]=$value->innertext;// code...
}
//span property="v:genre">
foreach ($info->find("span[property=v:genre]") as $value) {
    $data['genres'][]=$value->innertext;// code...
}
$initialReleaseDate = explode(" ",str_replace(["(",")"]," ",$info->find("span[property=v:initialReleaseDate]",0)->innertext));
$data['date'] = $initialReleaseDate[0];
$date_=explode("-",$initialReleaseDate[0]);
$data['year'] = $date_[0];
$data['desc'] = preg_replace("/<br(\s|)(\s|)\\/>/x","",trim($html->find("span[property=v:summary]",0)->innertext));
$data['point'] = $html->find("strong[property=v:average]",0)->innertext;
$data['title'] = str_replace("的演职员","",$html->find("div[id=celebrities] h2 i",0)->innertext);
preg_match("/<spanclass=\"pl\">制片国家\\/地区:<\\/span>(.*?)<br\\/>/", str_replace(" ","" ,$info->innertext), $matches_);
$area_  = explode("/",$matches_[1]);
$data['area'] = $area_[0];
// 《木乃伊》是由斯蒂芬·索莫斯导演的剧情电影，由布兰登·费舍、蕾切尔·薇兹、约翰·汉纳、阿诺德·沃斯洛、凯文·J·奥康纳等主演，于1999年在美国上映。
// 电影《木乃伊》又名《盗墓迷城》、《神鬼传奇》。
// 台词金句：我相信有备无患。
//<span class="pl">又名:</span> 地洞 / The Hole<br/>
preg_match("/<span class=\"pl\">又名:<\\/span>(.*?)<br\\/>/", $info->innertext, $matches_);
$names_ = explode("/",$matches_[1]);
$names = "";
foreach ($names_ as $key => $value) {
    $names .= $key?"、":"";
    $names .= "《".$value."》";// code...
}
$names = $names?"电影《".$data['title']."》又名".$names."。":"";
$data['text']="《".$data['title']."》是由".$directedBys."导演的剧情电影，由".$stars."等主演，于".$data['year']."年在".$data['area']."上映。
".$names;
header('content-type:application/json');
echo json_encode($data);
