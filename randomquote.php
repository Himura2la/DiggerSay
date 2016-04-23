<?php
require 'db.php';

if (isset($_GET["full"])) {
    $res = $mysqli->query("SELECT Id, Text FROM quotes_main WHERE Active=1 ORDER BY RAND() LIMIT 1");
    $row = $res->fetch_assoc();
    echo json_encode($row, JSON_UNESCAPED_UNICODE);
} else {
    $res = $mysqli->query("SELECT Text FROM quotes_main WHERE Active=1 ORDER BY RAND() LIMIT 1");
    echo $res->fetch_assoc()['Text'];
}

?> 