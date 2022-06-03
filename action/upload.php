<?php
$thumbw = 450;
$resizew = 1800;
$log = '/home/web/storage/upload.log';
file_put_contents($log,json_encode($_FILES['file']));

if (preg_match('/image/', $_FILES['file']['type'])) {
$fileName = $_FILES['file']['name'];
$targetFile = '/home/web/storage/'.$fileName;
$file_ext = strtolower(substr($fileName, strrpos($fileName,'.')+1));
$tmpFile = $_FILES['file']['tmp_name'];
//do some stuff with the image
$resizedFile = preg_replace('/\/([^\/\.]+)(\..{3,4})$/','/r-\1\2', $targetFile);
$thumbFile = preg_replace('/\/([^\/\.]+)(\..{3,4})$/','/t-\1\2', $targetFile);


list($width, $height) = getimagesize($tmpFile);
$r = $height / $width;
// if needed, resize
if ($width > $resizew) {
$resized = imagecreatetruecolor($resizew, $r * $resizew);
}
// create thumb images
$thumbh = $r * $thumbw;
$thumb = imagecreatetruecolor($thumbw, $thumbh);


switch($file_ext){
case 'jpg':
$source = imagecreatefromjpeg($tmpFile);
break;
case 'jpeg':
$source = imagecreatefromjpeg($tmpFile);
break;


case 'png':
$source = imagecreatefrompng($tmpFile);
break;
case 'gif':
$source = imagecreatefromgif($tmpFile);
break;
default:
$source = imagecreatefromjpeg($tmpFile);
}
imagecopyresampled($thumb,$source,0,0,0,0,$thumbw,$thumbh,$width,$height);
imagecopyresampled($resized,$source,0,0,0,0,$resizew,$resizew * $r,$width,$height);


switch($file_ext){
case 'jpg' || 'jpeg':
if (isset($resized)) {
imagejpeg($resized,$resizedFile,100);
}
imagejpeg($thumb,$thumbFile,100);
break;
case 'png':
if (isset($resized)) {
imagepng($resized,$resizedFile,100);
}
imagepng($thumb,$thumbFile,100);
break;
case 'gif':
if (isset($resized)) {
imagegif($resized,$resizedFile,100);
}
imagegif($thumb,$thumbFile,100);
break;
default:
imagejpeg($thumb,$thumbFile,100);
}
}
else {
$resp['uploaded'] = 0;
$resp['error'] = ['message' => 'Either not an image or check the max upload size limit.'];
print json_encode($resp);
exit;
}


if (move_uploaded_file($tmpFile, $targetFile)) {
$resp = [
'uploaded' => 1 ,
'filename' => $fileName,
'url' => str_replace('/home','',$thumbFile), // in this case the thumb file will appear in the CKEDITOR
];
}
else {
$resp['uploaded'] = 0;
$resp['error'] = ['message' => 'Something went wrong with the upload'];
}
// return response instead of html chunk? (for other plugins)
// print $resp;
print $resp['url'];
imagedestroy($thumb);
if (isset($resized)) {
imagedestroy($resized);
}
imagedestroy($source);
?>