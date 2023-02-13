<?php
include("./simple_html_dom.php");
function curlGet($url,$type=0) 
{
    $header[]= 'text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9';  
    $curl = curl_init(); 
    curl_setopt($curl, CURLOPT_URL, $url); 
    curl_setopt($curl, CURLOPT_REFERER, $url);
    curl_setopt($curl, CURLOPT_HTTPHEADER,$header); 
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); 
    return curl_exec($curl); 
    curl_close($curl); 
}
function mon2han($num){
    $mon = [1,2,3,4,5,6,7,8,9,10,11,12];
    $han=["壹","贰","叁","肆","伍","陆","柒","捌","玖","拾","拾壹","拾贰"];
    if($num && !1 !== $i = array_search($num, $mon)){
        //echo $i;
        return $han[$i];
    }
    return false;
}
function year2han($year){
    $res= "";
    $han = ["零","壹","贰","叁","肆","伍","陆","柒","捌","玖","拾"];
    foreach (str_split($year) as $value) {
        $res .= $han[$value];// code...
    }
    return $res;
}