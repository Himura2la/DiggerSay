<!DOCTYPE html>
<html lang="ru">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=0.7, maximum-scale=0.7">
		
		<link href="https://fonts.googleapis.com/css?family=Ubuntu+Condensed&amp;subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="css/green.min.css" />
		<link rel="stylesheet" href="css/jquery.mobile.icons.min.css" />
		<link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile.structure-1.4.5.min.css" />
		<link rel="stylesheet" href="css/style.css" />
	
		<script src="https://code.jquery.com/jquery-2.2.3.min.js" type="text/javascript"></script>
		<script src="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>

        <title>Добавить цитату</title>
	</head>
	<body>
<div data-role="page" style="max-width: 500px; margin: 0 auto; position: relative; padding-top: 30px; padding-bottom: 20px;">
  <div data-role="content">

<?php
require 'db.php';

if ((isset($_POST['text']) && !empty($_POST['text']))){
    $text = $_POST['text'];
    
	if(isset($_POST['author'])){
		$author = $_POST['author'];
        $stmt = $mysqli->prepare("INSERT INTO quotes_main (Author, text, Active) VALUES (?, ?, '0')");        
        $stmt->bind_param("ss", $author, $text);
	} else {
        $stmt = $mysqli->prepare("INSERT INTO quotes_main (text, Active) VALUES (?, '0')");        
        $stmt->bind_param("s", $text);
    }
	$stmt->execute();
	$stmt->close();
?>

    <h1 class="quote-text">Цитата отправлена на модерацию. Вдруг, диггер такого не говорил?</h1>
    <p><a href="/">Выйти</a></p>
    <p><a href="/add.php">Еще одну</a></p>

<?php } else { ?>	

	<h1 class="quote-text">Добавить цитату</h1>

    <form method="post" action="add.php" id="addqoute-form">
		<label for="fname" class="ui-hidden-accessible">Имя</label>
		<input type="text" name="author" id="author" placeholder="Имя... (не обязательно)">
		<label for="textarea" class="ui-hidden-accessible">Цитата:</label>
		<textarea name="text" id="text" rows="5" placeholder="Текст..."></textarea>
		<input type="submit" value="...сказал диггер">
    </form>
    
<?php }; ?>
  </div>
</div>
</body>
</html>
