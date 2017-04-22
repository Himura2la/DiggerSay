<?php

/*  http://stackoverflow.com/questions/5746537/
    Make sure to set the font on the ImagickDraw Object first!
    @param image the Imagick Image Object
    @param draw the ImagickDraw Object
    @param text the text you want to wrap
    @param maxWidth the maximum width in pixels for your wrapped "virtual" text box
    @return an array of lines and line heights
*/

$lines_fsize = array(
    1 => 60,
    2 => 50
);

$lines_shift = array(
    1 => 105,
    2 => 90 
);

if (!empty($_GET['f']))
    $fsize = $_GET['f'];
else
    $fsize = $lines_fsize[1];


function wordWrapAnnotation($image, $draw, $text, $maxWidth) {   
    $text = trim($text);
    $words = preg_split('%\s%', $text, -1, PREG_SPLIT_NO_EMPTY);
    $lines = array();
    $i = 0;
    $lineHeight = 0;
    while (count($words) > 0) {   
        $metrics = $image->queryFontMetrics($draw, implode(' ', array_slice($words, 0, ++$i)));
        $lineHeight = max($metrics['textHeight'], $lineHeight);
        
        // check if we have found the word that exceeds the line width
        if ($metrics['textWidth'] > $maxWidth or count($words) < $i)  {   
            // handle case where a single word is longer than the allowed line width 
            // (just add this as a word on its own line?)
            if ($i == 1)
                $i++;
            $lines[] = implode(' ', array_slice($words, 0, --$i));
            $words = array_slice($words, $i);
            $i = 0;
        }   
    }   
    return array($lines, $lineHeight-1);
}


$image = new Imagick("images/vk_repost.jpg");
$width = $image->getImageWidth();
$height = $image->getImageHeight();
$draw = new ImagickDraw();

$draw->setFillColor('#29834f');
$draw->setTextAlignment(Imagick::ALIGN_CENTER);

$draw->setFont('font/Ubuntu-C.ttf');
$draw->setFontSize($fsize);

$draw->setTextUnderColor('#b8d331');

if (!empty($_GET['q'])) {
    $id = $_GET['q'];
    
    require 'db.php';
    $stmt = $mysqli->prepare("SELECT Text FROM quotes_main WHERE ID=?");
    $stmt->bind_param("d", $id);
    $stmt->execute();
    $res = $stmt->get_result();
    $text = $res->fetch_assoc()['Text'];
} else {
    $text = $_GET['t'];
}
$text = str_replace('Р', 'P', $text);

list($lines, $lineHeight) = wordWrapAnnotation($image, $draw, $text, $width-20);

$static_shift = round(1.16586 - 0.191563 * $lineHeight);

if (count($lines) > 5) {
    $last_line = $lines[4];
    $words = preg_split('%\s%', $last_line, -1, PREG_SPLIT_NO_EMPTY);
    $last_line = "";
    for($i = 0; $i < count($words) - 1; $i++)
        $last_line .= $words[$i] . " ";
    $last_line .= "...";
    $lines[4] = $last_line;
    array_splice($lines, 5, count($lines)-5)
}

if (!empty($_GET['s']))
    $shift = $_GET['s'];
else {
    $shift = round(($height - $lineHeight * count($lines))/ 2);
}

for($i = 0; $i < count($lines); $i++)
    $image->annotateImage($draw, $width/2, $shift + $static_shift + $lineHeight + $i*$lineHeight, 0, " " . $lines[$i] . " ");

$image->setImageFormat('png');

header('Content-type: image/png'); echo $image;

//echo '<img src="data:image/png;base64,'.base64_encode($image->getImageBlob()).'" alt="" />';

?>
