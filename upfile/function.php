<?php
function xuongdong($value)
{
$string = preg_replace('@[\s]{2,}@',' ',$value);
return trim(str_replace(array("/\n|\r/","\""),array("", "'"), $string));
}
//Hàm chuyển tên sang url đẹp
function rwurl($title){
$replacement = '-';
$map = array();
$quotedReplacement = preg_quote($replacement, '/');
$default = array(
'/à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ|å/' => 'a',
'/À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ/' => 'A',
'/e|è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ|ë/' => 'e',
'/È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ/' => 'e',
'/ì|í|ị|ỉ|ĩ|î/' => 'i',
'/Ì|Í|Ị|Ỉ|Ĩ/' => 'I',
'/ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ|ø/' => 'o',
'/Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ/' => 'O',
'/ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ|ů|û/' => 'u',
'/Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ/' => 'U',
'/ỳ|ý|ỵ|ỷ|ỹ/' => 'y',
'/Ỳ|Ý|Ỵ|Ỷ|Ỹ/' => 'Y',
'/đ/' => 'd',
'/Đ/' => 'D',
'/ç/' => 'c',
'/ñ/' => 'n',
'/æ/' => 'ae',
'/ä/' => 'a',
'/ö/' => 'o',
'/ü/' => 'u',
'/Ä/' => 'A',
'/Ü/' => 'U',
'/Ö/' => 'O',
'/ß/' => 'b',
'/̃|̉|̣|̀|́/' => '',
'/\\s+/' => $replacement,
sprintf('/^[%s]+|[%s]+$/', $quotedReplacement, $quotedReplacement) => '',
);
$title = urldecode($title);
mb_internal_encoding('UTF-8');
$map = array_merge($map, $default);
return preg_replace(array_keys($map), array_values($map), $title) ;
}
function catmota($str, $length, $minword = 3)
{
$sub = '';
$len = 0;
foreach (explode(' ', $str) as $word)
{
$part = (($sub != '') ? ' ' : '') . $word;
$sub .= $part;
$len += strlen($part);
if(strlen($word) > $minword && strlen($sub) >= $length){
break;
}}
return $sub . (($len < strlen($str)) ? '...' : '');
}
// hàm tạo thư mục và tập tin
function tao_file($namefolder,$filename){
include 'set.php';
$url = 'http://'.$_SERVER['SERVER_NAME'].'/upfile/files/'.$filename;
$ch = curl_init();    
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);    
curl_setopt($ch, CURLOPT_USERAGENT, 'UCWEB/2.0 (Java; U; MIDP-2.0; vi; NokiaE71-1) U2/1.0.0 UCBrowser/9.4.1.377 U2/1.0.0 Mobile UNTRUSTED/1.0');    
curl_setopt($ch, CURLOPT_URL, $server.'/upload.php');     
$nguyenpro = array('folder' => $namefolder, 'url' => $url, 'pass' => 'nguyenpro');
curl_setopt($ch, CURLOPT_POST,count($nguyenpro));
curl_setopt($ch, CURLOPT_POSTFIELDS,$nguyenpro);
curl_exec($ch);
curl_close($ch);
}
function tao_w4($nick,$token,$folder,$filename,$filetype,$filesize,$pass,$mota){
@set_time_limit(0);
include 'set.php';
$ch = curl_init();
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);    
curl_setopt($ch, CURLOPT_USERAGENT, 'UCWEB/2.0 (Java; U; MIDP-2.0; vi; NokiaE71-1) U2/1.0.0 UCBrowser/9.4.1.377 U2/1.0.0 Mobile UNTRUSTED/1.0');    
curl_setopt($ch, CURLOPT_URL, $wap4.'/upload.php');
$nguyenpro = array('nick' => $nick, 'folder' => $folder, 'token' => $token, 'filename' => $filename, 'filesize' => $filesize, 'filetype' => $filetype, 'pass' => $pass, 'mota' => $mota, 'submit' => 'Gửi');
curl_setopt($ch, CURLOPT_POST,count($nguyenpro));
curl_setopt($ch, CURLOPT_POSTFIELDS,$nguyenpro);
curl_exec($ch);
curl_close($ch);
}
function tao_w4_khach($folder,$filename,$filetype,$filesize,$mota){
@set_time_limit(0);
include 'set.php';
$ch = curl_init();    
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);    
curl_setopt($ch, CURLOPT_USERAGENT, 'UCWEB/2.0 (Java; U; MIDP-2.0; vi; NokiaE71-1) U2/1.0.0 UCBrowser/9.4.1.377 U2/1.0.0 Mobile UNTRUSTED/1.0');    
curl_setopt($ch, CURLOPT_URL, $wap4.'/upload_khach.php');     
$nguyenpro = array('nick' => '', 'folder' => $folder, 'filename' => $filename, 'filesize' => $filesize, 'filetype' => $filetype, 'pass' => '', 'mota' => $mota, 'check' => 'nguyenpro');
curl_setopt($ch, CURLOPT_POST,count($nguyenpro));
curl_setopt($ch, CURLOPT_POSTFIELDS,$nguyenpro);
curl_exec($ch);
curl_close($ch);
}
function rand_text( $length ) {
$chars = "abcdefghijklmnopqrstuvwxyz0123456789";
$size = strlen($chars);
for($i = 0; $i < $length; $i++ ){
$str.= $chars[rand(0, $size - 1) ];
}
return $str;
}
function filename($text){
$mang = explode('.',$text);
$demmang = count($mang);
if($demmang==1){
$nd=rwurl($text);
}else{
$cuoi = rwurl(array_pop($mang));
$dau = rwurl(implode('.',$mang));
$nd=$dau.'.'.$cuoi;
}
return $nd;
}
function cURL($url, $cookie=NULL, $p=NULL) 
{
$ch = curl_init(); 
curl_setopt($ch, CURLOPT_URL, $url); 
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0); 
curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie);		#writing
curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie);	
curl_setopt($ch, CURLOPT_USERAGENT, 'Opera/9.80 (J2ME/MIDP; Opera Mini/9.80 (S60; SymbOS; Opera Mobi/23.348; U; en) Presto/2.5.25 Version/10.54'); 
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0); 
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1); 
if($p){
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST"); 
curl_setopt($ch, CURLOPT_POST, 1); 
curl_setopt($ch, CURLOPT_POSTFIELDS, $p);
}
$result = curl_exec($ch);
if($result){
return $result;
}else{
return curl_error($ch);
}
curl_close($ch);
}
function grab($url, $ref = '', $cookie = '', $user_agent = '', $header = ''){
if(function_exists('curl_init')){
$ch = curl_init();
$headers[] = 'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8';
$headers[] = 'Accept-Language: en-us,en;q=0.5';
$headers[] = 'Accept-Charset: ISO-8859-1,utf-8;q=0.7,*;q=0.7';
$headers[] = 'Keep-Alive: 300';
$headers[] = 'Connection: Keep-Alive';
$headers[] = 'Content-type: application/x-www-form-urlencoded;charset=UTF-8';
curl_setopt($ch, CURLOPT_URL, $url);
if($user_agent)
curl_setopt($ch, CURLOPT_USERAGENT, $user_agent);
else
curl_setopt($ch, CURLOPT_USERAGENT, 'Nokia3110c/2.0 (04.91) Profile/MIDP-2.0 Configuration/CLDC-1.1');
if($header)
curl_setopt($ch, CURLOPT_HEADER, 1);
else
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
if($ref)
curl_setopt($ch, CURLOPT_REFERER, $ref);
else
curl_setopt($ch, CURLOPT_REFERER, 'http://www.google.com.vn/search?hl=vi&client=firefox-a&rls=org.mozilla:en-US:official&hs=hKS&q=video+clip&start=20&sa=N');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
if(strncmp($url, 'https', 6))
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
if($cookie)
curl_setopt($ch, CURLOPT_COOKIE, $cookie);
curl_setopt($ch, CURLOPT_TIMEOUT, 100);
$html = curl_exec($ch);
$mess_error = curl_error($ch);
curl_close($ch);
}else{
$matches = parse_url($url);
$host = $matches['host'];
$link = (isset($matches['path']) ? $matches['path'] : '/') . (isset($matches['query']) ? '?' . $matches['query'] : '') . (isset($matches['fragment']) ? '#' . $matches['fragment'] : '');
$port = !empty($matches['port']) ? $matches['port'] : 80;
$fp = @fsockopen($host, $port, $errno, $errval, 30);
if(!$fp){
$html = "$errval ($errno)<br />\n";
}else{
if(!$ref)
$ref = 'http://www.google.com.vn/search?hl=vi&client=firefox-a&rls=org.mozilla:en-US:official&hs=hKS&q=video+clip&start=20&sa=N';
$rand_ip = rand(1, 254) . "." . rand(1, 254) . "." . rand(1, 254) . "." . rand(1, 254);
$out = "GET $link HTTP/1.1\r\n" .
"Host: $host\r\n" .
"Referer: $ref\r\n" .
"Accept: text/xml,application/xml,application/xhtml+xml,text/html;q=0.9,text/plain;q=0.8,image/png,*/*;q=0.5\r\n";
if($cookie)
$out .= "Cookie: $cookie\r\n";
if($user_agent)
$out .= "User-Agent: " . $user_agent . "\r\n";
else
$out .= "User-Agent: " . 'Nokia3110c/2.0 (04.91) Profile/MIDP-2.0 Configuration/CLDC-1.1' . "\r\n";
$out .= "X-Forwarded-For: $rand_ip\r\n".
"Via: CB-Prx\r\n" .
"Connection: Close\r\n\r\n";
fwrite($fp, $out);
while(!feof($fp))
$html .= fgets($fp, 4096);
fclose($fp);
}}
return $html;
}
function import($url, $path){
$binarys = grab($url);
if(!file_put_contents($path, $binarys)){
@unlink($path);
return false;
}
return true;
}
function isURL($url){
if(function_exists('filter_var'))
return filter_var($url, FILTER_VALIDATE_URL);
else
return preg_match("/^(http|https|ftp):\/\/([A-Z0-9][A-Z0-9_-]*(?:\.[A-Z0-9][A-Z0-9_-]*)+):?(\d+)?\/?/i", $url);
}
?>