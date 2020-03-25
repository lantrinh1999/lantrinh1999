<?php
require './LHelper.php';
$helper = new LHelper;

$filenames = glob('*.jpg');
if(count($filenames) > 10) {
  for ($i = 0; $i < count($filenames) - 1; $i++) {
	  unlink($filenames[$i]);
  }
}
$link = trim(strip_tags($_GET['u']));
if (empty($link)) {
  return false;
}
$im = imagecreatefromwebp($link);
$file_name = basename($link);
$a = imagejpeg($im, 'trim(trim($file_name, '.webp')).'.jpg', 80);
echo !empty($a) ? true : false;
die();




?>
