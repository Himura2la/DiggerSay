<?php
require 'db.php';

$res = $mysqli->query("SELECT ID FROM quotes_main WHERE Active=1");

echo "[";
$first = true;
foreach($res->fetch_all(MYSQLI_NUM) as $row){
    if ($first) $first = false;
    else         echo ",";
    echo $row[0];
}
echo "]"

?> 