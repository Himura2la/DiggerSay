<?php

$bg = new Imagick("images/vk_repost.jpg");
$draw = new ImagickDraw();

$draw->setFillColor('#267f4c');

$draw->setFont('font/Ubuntu-C.ttf');
$draw->setFontSize( 30 );

$image->annotateImage($draw, 10, 45, 0, 'nya');

$image->setImageFormat('png');

header('Content-type: image/png');
echo $image;

?>