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
        <script type="text/javascript" src="main.js"></script>
		<script type="text/javascript" src="jqueryrotate.2.1.js"></script>
		<script type="text/javascript" src="rotate_arrow.js"></script>
        
        <!-- Разметка должна быть в разметке, а скрипты в отдельных .js файлах!!! -->
<?php


    $quote = "";
    $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    
    if (isset($_GET['id'])){
        $id = $_GET['id'];
        $quote = file_get_contents("http://$_SERVER[HTTP_HOST]/quote.php?id=" . $id);
    } else {
        $out = json_decode(file_get_contents("http://$_SERVER[HTTP_HOST]/randomquote.php?full"), true);
        $id = $out['Id'];
        $quote = $out['Text'];
        echo "<script type=\"text/javascript\">";
        echo "    $(function() {rewrite_url(<?php $id ?>);});";
        echo "</script>";
    }
        
        echo "\t\t<meta property=\"og:url\" content=\"http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]\" />\n";
        echo "\t\t<meta property=\"og:title\" content=\"". $quote ."\" />\n";
        echo "\t\t<meta property=\"og:image\" content=\"http://$_SERVER[HTTP_HOST]/images/vk_repost.jpg\" />\n";
        echo "\t\t<meta property=\"og:description\" content=\"Скажет диггер\" />\n";
    }
?>
    

        
        
        <title>Скажет диггер</title>
	</head>
	<body>
		<a id="next-quote" href="#">
            <div>
                <div class="quote-div"> 
                    <h1 class="quote-text"><?php echo $quote ?></h1>
                </div> 
                <div class="centralpicture">
					<img src="images/nav-arrow-center.png" id="nav-arrow">
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
		<!--div class="div-center">
			<a href="/monterskaya">
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
		</div-->
	</body>
</html>
