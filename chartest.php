<?php
require 'db.php';
if (!$mysqli->set_charset("utf8")) { 
printf("Error loading character set utf8: %s\n", $mysqli->error); 
}
echo "Проверка кириллицы<br>";
if (isset($_GET['id'])){
    $id = $_GET['id'];
    
    if (isset($_GET["full"])) {
        $stmt = $mysqli->prepare("SELECT * FROM quotes_main WHERE ID=?");        
        $stmt->bind_param("d", $id);
        $stmt->execute();
        $res = $stmt->get_result();
        $row = $res->fetch_assoc();
        echo json_encode($row, JSON_UNESCAPED_UNICODE);
    } else {
        $stmt = $mysqli->prepare("SELECT Text FROM quotes_main WHERE ID=?");
        $stmt->bind_param("d", $id);
        $stmt->execute();
        $res = $stmt->get_result();
        echo $res->fetch_assoc()['Text'];
    }
}
else {
    echo "Specify GET 'id'";
}

