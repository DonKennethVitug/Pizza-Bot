<?php

header ("Content-type: image/jpeg");

$string = "This is phpGang.com";

$font = 230;

$width = imagefontwidth($font) * strlen($string) ;

$height = imagefontheight($font) ;

$im = imagecreatefromjpeg("gang.jpeg");

$x = imagesx($im) - $width ;

$y = imagesy($im) - $height;

$backgroundColor = imagecolorallocate ($im, 255, 255, 255);

$textColor = imagecolorallocate ($im, 0, 0,0);

imagestring ($im, $font, $x, $y, $string, $textColor);

imagejpeg($im);

?>