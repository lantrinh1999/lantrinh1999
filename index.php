<?php 
require './LHelper.php';
$helper = new LHelper;

$filenames = glob('*.jpg');
if(count($filenames) > 10) {
  for ($i = 0; $i < count($filenames) - 1; $i++) {
	  unlink($filenames[$i]);
  }
}
if(empty($_GET['u'])){
	echo "Mời nhập link: example.com/index.php?u=img.com/adfg.webp";
	die();
}
$link = trim(strip_tags($_GET['u']));
if (empty($link)) {
  return false;
}
var_dump($link);
die();
$im = imagecreatefromwebp($link);
if($im) {
	$file_name = basename($link);
	$result = imagejpeg($im, trim(trim($file_name, '.webp')).'.jpg', 80);
}

echo !empty($result) ? 1 : 0;
die();
 ?>
