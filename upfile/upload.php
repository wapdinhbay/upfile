<?php
set_time_limit(1000);
include 'set.php';
include 'function.php';
if(isset($_POST['submit'])){
if(isset($_FILES['file'])){
$nick = $_POST['nick'];
$token = trim($_POST['token']);
$error = $_FILES['file']['error'];
$size = $_FILES['file']['size'];
$name = $_FILES['file']['name'];
$name = trim(filename($name));
$type = $_FILES['file']['type'];
$mota = $_POST['mota'];
$pass = $_POST['pass'];
$checktoken = trim(file_get_contents($wap4.'/check.php?act=token&nick='.$nick));
$khoa = trim(file_get_contents($wap4.'/check.php?act=khoa&nick='.$nick));
$types = pathinfo($name, PATHINFO_EXTENSION);
$up = file_get_contents('up.txt');
if($khoa=='yes'){
header("Location: $wap4");
}elseif($up=='yes'){
header("Location: ".$wap4."/?er=error");
}elseif($error > 0){
header("Location: ".$wap4."/?er=error");
}elseif($checktoken!=$token){
header("Location: ".$wap4."/?er=token");
}elseif(!in_array($types,$typee)){
header("Location: ".$wap4."/?er=type");
}elseif($size > 104857600){
header("Location: ".$wap4."/?er=maxsize");
}else{
move_uploaded_file($_FILES['file']['tmp_name'], './files/'.$name);
$fp = @fopen('files/'.$name, "r");
if(!$fp){
header("Location: ".$wap4."/?er=error");
}else{
$data = fread($fp, filesize('files/'.$name));
$namefolder = rand_text(30);
$filename = trim(filename($name));
//Bắt đầu Upload
file_put_contents('up.txt','yes');
tao_file($namefolder,$filename);
tao_w4($nick,$token,$namefolder,$filename,$type,$size,$pass,$mota);
unlink('files/'.$name);
file_put_contents('up.txt','no');
$id = trim(file_get_contents($wap4.'/id.php'));
header("Location: ".$wap4."/files/".$id);
}}
}else{
header("Location: ".$wap4."/?er=error");
}
}else{
header("Location: ".$wap4."");
}
?>