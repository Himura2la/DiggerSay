<!DOCTYPE html>
<html lang="ru">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=0.7, maximum-scale=0.7">
		<link href="https://fonts.googleapis.com/css?family=Ubuntu+Condensed&amp;subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="css/green.min.css" />
		<link rel="stylesheet" href="css/jquery.mobile.icons.min.css" />
		<link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile.structure-1.4.5.min.css" />
		<link media="screen" href="css/style.css" type="text/css" rel="stylesheet" />
		<link rel="shortcut icon" type="image/vnd.microsoft.icon" href="/favicon.ico" />
        <script type="text/javascript" src="https://code.jquery.com/jquery-2.2.3.min.js"></script>
        <script src="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
        <title>Цитаты на модерации</title>
	</head>
	<body>
		<div data-role="page" style="max-width: 500px; margin: 0 auto; position: relative; padding-top: 10px; padding-bottom: 10px;">
			<div data-role="content">
				<h1 class="quote-text">Цитаты на модерации</h1>
				<ul data-role="listview" data-inset="true">
<?php
require 'db.php';
		$stmt = $mysqli->prepare("SELECT * FROM quotes_main WHERE Active=0");        
        $stmt->execute();
        $res = $stmt->get_result();
        while ($row = $res->fetch_assoc()) {
			echo '					<li>'."\n".'						<a href="#">';
			echo "							{$row['ID']}: {$row['Text']}\n"; 
			echo '						</a>'."\n".'						<a href="#delete" data-rel="dialog" data-transition="pop" data-icon="delete"></a>'."\n";
			echo "					</li>\n";
		}
?>
				</ul>
			</div>
		</div>
		<div data-role="page" id="delete">
			<div data-role="content">
				<h3>Удалить цитату?</h3>
					<a href="#" data-role="button" data-rel="back" data-icon="check" data-inline="true" data-mini="true">Удалить</a>
					<a href="#" data-role="button" data-rel="back" data-inline="true" data-mini="true">Отмена</a>
			</div>
		</div> 

	</body>
</html>
