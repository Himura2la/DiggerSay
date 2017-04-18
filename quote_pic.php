<?php

$image = new Imagick("images/vk_repost.jpg");
$draw = new ImagickDraw();

$draw->setFillColor('#267f4c');

$draw->setFont('font/Ubuntu-C.ttf');
$draw->setFontSize(45);

$image->annotateImage($draw, 10, 150, 0, $_GET["t"]);

$image->setImageFormat('png');

header('Content-type: image/png');
echo $image;

?>