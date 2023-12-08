<?php

header("Content-Type: application/json; charset=UTF-8");

function cors() {//------------------------------------------------------------------------------
    
    if (isset($_SERVER['HTTP_ORIGIN'])) {
        header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
        header("Content-Type: application/json; charset=UTF-8");
        header('Access-Control-Allow-Credentials: true');
        header('Access-Control-Max-Age: 86400');    // cache for 1 day
    }
    
    // Access-Control headers are received during OPTIONS requests
    if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
        
        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
            // may also be using PUT, PATCH, HEAD etc
            header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
        
        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
            header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
    
        exit(0);
    }
}
cors();

include_once "./Config/Database.php";

//з'єднуємося з базою даних
$database = new Database();
$db = $database->getConnection();


$sql = "SELECT * FROM words WHERE added_date = '2023-12-07' AND user_id = 1";
$result = $database->conn->query($sql);

$i = 0;
$arr = [];
while($row = $result->fetch(PDO::FETCH_ASSOC)){
    $arr[$i] = $row;
    $arr[$i]['definition'] = json_decode($arr[$i]['definition']);
    $arr[$i]['examples'] = json_decode($arr[$i]['examples']);
    $i++;
}


echo json_encode(
    array(
        "list" => $arr,
    )
    );