<?php
set_time_limit(1000);
include 'set.php';
include 'function.php';
if(isset($_POST['submit'])){
if(isset($_FILES['file'])){
$mota = $_POST['mota'];
$token = trim($_POST['token']);
$error = $_FILES['file']['error'];
$size = $_FILES['file']['size'];
$name = $_FILES['file']['name'];
$name = trim(filename($name));
$type = $_FILES['file']['type'];
$types = pathinfo($name, PATHINFO_EXTENSION);
$up = file_get_contents('up.txt');
if($up=='yes'){
header("Location: ".$wap4."/?er=error");
}elseif($error > 0){
header("Location: ".$wap4."/?er=error");
}elseif(!in_array($types,$typee)){
header("Location: ".$wap4."/?er=type");
}elseif($size > 10485760){
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
tao_w4_khach($namefolder,$filename,$type,$size,$mota);
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