<!DOCTYPE html>
<html lang="ru">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=0.7, maximum-scale=0.7">
		<link media="screen" href="css/style.css" type="text/css" rel="stylesheet" />
		<link href='https://fonts.googleapis.com/css?family=Ubuntu+Condensed&subset=latin,cyrillic-ext' rel='stylesheet' type='text/css'>
		<link rel="shortcut icon" type="image/vnd.microsoft.icon" href="/favicon.ico" />
		
        <script type="text/javascript" src="https://code.jquery.com/jquery-2.2.3.min.js"></script>
        <script type="text/javascript" src="http://vk.com/js/api/share.js?90" charset="windows-1251"></script>
		<script type="text/javascript" src="jqueryrotate.2.1.js"></script>
		<script type="text/javascript" src="functions.js"></script>
        
		<!-- Разметка должна быть в разметке, а скрипты в отдельных .js файлах!!! -->
<?php
    $quote = "";
	$author = "";
    $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    
    if (isset($_GET['id'])){
        $id = $_GET['id'];
        $out = file_get_contents("http://$_SERVER[HTTP_HOST]/quote.php?full&id=" . $id);
		$out = json_decode($out, true);
		$quote = $out['Text'];
		$author = $out['Author'];
    } else {
        $out = file_get_contents("http://$_SERVER[HTTP_HOST]/randomquote.php?full");
        $out = json_decode($out, true);
        $id = $out['Id'];
        $quote = $out['Text'];
		$author = $out['Author'];
        echo "\t\t<script type=\"text/javascript\">\n";
        echo "\t\t    $(function() {rewrite_url(". $id .");});\n";
        echo "\t\t</script>\n";
    }
        
        echo "\t\t<meta property=\"og:url\" content=\"http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]\" />\n";
        echo "\t\t<meta property=\"og:title\" content=\"". $quote ."\" />\n";
        echo "\t\t<meta property=\"og:image\" content=\"http://$_SERVER[HTTP_HOST]/images/vk_repost.jpg\" />\n";
        echo "\t\t<meta property=\"og:description\" content=\"Скажет диггер\" />\n";
?>
    

        <script type="text/javascript" src="main.js"></script> <!-- порядок важен! -->
        
        <title>Скажет диггер</title>
	</head>
	<body><div id="noscrollbar">
		<a id="next-quote" href="#">
            <div>
                <div class="quote-div"> 
                    <h1 class="quote-text"><?php echo $quote ?></h1>
					<p class="author-text"><?php if (!empty($author)){echo '&copy;&nbsp;',$author;}?> </p>
                </div> 
                <div class="centralpicture">
					<img src="images/nav-arrow-center.png" class="nav-arrow">
				</div> 
                <h1 class="dig-say dig-say-text">Скажет диггер</h1>
            </div>
        </a>
        
		<div class="div-center">
			<div class="social"> 
				<a id="share_vk" href="#"><div class="soc1"></div></a>
				<a id="share_fb" href="#"><div class="soc2"></div></a>
				<a id="share_tw" href="#"><div class="soc3"></div></a>
				<a id="share_gp" href="#"><div class="soc4"></div></a>
				<a id="share_ok" href="#"><div class="soc5"></div></a>
			</div> 
		</div>
		<div class="clear"></div>
		<div class="div-center">
			<a href="/add.php">
                <div class="addquotediv">
                    <div class="add-left-right">
                        <h2 class="addquotetext">добавить </h2>
                    </div>
                    <div class="add-left-right">
                        <img alt="+" src="images/bm_1460708097.jpeg" />
                    </div>
                    <div class="add-left-right">
                        <h2 class="addquotetext"> цитату</h2>
                    </div>
                </div>
            </a>
		</div>
	</div></body>
</html>
