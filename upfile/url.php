<?php
set_time_limit(1000);
include 'set.php';
include 'function.php';
$url = isset($_POST['url']) ? $_POST['url'] : NULL;
if($url != NULL){
$nick = $_POST['nick'];
$mota = $_POST['mota'];
$pass = $_POST['pass'];
$token = trim($_POST['token']);
$name = basename($url);
$name = trim(filename($name));
$types = pathinfo($url, PATHINFO_EXTENSION);
$checktoken = trim(file_get_contents($wap4.'/check.php?act=token&nick='.$nick));
$khoa = trim(file_get_contents($wap4.'/check.php?act=khoa&nick='.$nick));
$size = strlen(file_get_contents($url));
if($khoa=='yes'){
header("Location: $wap4");
}elseif(!isURL($url)){
header("Location: ".$wap4."/?er=error");
}elseif($checktoken != $token) {
header("Location: ".$wap4."/?er=token");
}elseif($size > 209715200)
{
header("Location: ".$wap4."/?er=maxsize");
}elseif(strlen($name) < '3'){
header("Location: ".$wap4."/?er=notopen");
}
elseif(!in_array($types,$typee)){
header("Location: ".$wap4."/?er=type");
}elseif(import($url,'files/'.$name)){
$type = mime_content_type('files/'.$name);
$size = filesize('files/'.$name);
$fp = @fopen('files/'.$name, "r");
if(!$fp){
header("Location: ".$wap4."/?er=error");
}else{
$namefolder = rand_text(30);
$data = fread($fp, filesize('files/'.$name));
$filename = trim(filename($name));
file_put_contents('up.txt','yes');
tao_file($namefolder,$filename);
tao_w4($nick,$token,$namefolder,$filename,$type,$size,$pass,$mota);
unlink('files/'.$name);
file_put_contents('up.txt','no');
$id = trim(file_get_contents($wap4.'/id.php'));
header("Location: ".$wap4."/files/".$id);
}}
}else{
header("Location: $wap4");
}
?>