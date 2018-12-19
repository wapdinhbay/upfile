<?php
$up = $_POST['up'];
include 'set.php';
if(!$_POST['submit']){
header("Location: $wap4");
}else{
if($up=='1'){
include 'upload.php';
}elseif($up=='2'){
include 'url.php';
}}
?>