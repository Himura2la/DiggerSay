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
		<ul>
<?php
require 'db.php';
		$stmt = $mysqli->prepare("SELECT * FROM quotes_main WHERE Active=0");        
        $stmt->execute();
        $res = $stmt->get_result();
        while ($row = $res->fetch_assoc()) {
			echo '			<li>'.$row['ID'].': '.$row['Text'].'</li>\n'; 
		}
?>
		</ul>
	</body>
</html>
