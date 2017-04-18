<?php

$bg = new Imagick("images/vk_repost.jpg");
$draw = new ImagickDraw();

$draw->setFillColor('black');

$draw->setFont('Bookman-DemiItalic');
$draw->setFontSize( 30 );

$image->annotateImage($draw, 10, 45, 0, 'nya');

$image->setImageFormat('png');

header('Content-type: image/png');
echo $image;

?>