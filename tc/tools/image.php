<?php
$im = imagecreate(200, 30);

$url=parse_url($_SERVER['SCRIPT_URI']);
$urlString = split('/',end($url));
$name = array_pop($urlString);
$delay=array_pop($urlString);
if (is_numeric($delay))
 sleep($delay);

if ($name == "image.php") {
echo "enter image.php/&lt;delay in seconds&gt;/&lt;image text&gt; or image.php/&lt;image text&gt;";
return;
}
$bg = imagecolorallocate($im, 255, 255, 255);
$textcolor = imagecolorallocate($im, 0, 0, 255);
// write the string at the top left
imagestring($im, 5, 0, 0, $name, $textcolor);

// output the image
header("Content-type: image/png");
imagepng($im);
?> 
