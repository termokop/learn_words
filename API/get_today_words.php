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

$database->conn->query("SET time_zone = '-07:00");

$arr = [];
$i = 0;

$currentDate = date("Y-m-d");

$sql = "SELECT * FROM words WHERE DATE(first_rep_date) = '$currentDate' AND user_id = 1 AND is_first_done = 0;";
$result = $database->conn->query($sql);

while($row = $result->fetch(PDO::FETCH_ASSOC)){
    $arr[$i] = $row;
    $arr[$i]['definition'] = json_decode($arr[$i]['definition']);
    $arr[$i]['examples'] = json_decode($arr[$i]['examples']);
    $i++;
}

$sql = "SELECT * FROM words WHERE DATE(second_rep_date) = '$currentDate' AND user_id = 1 AND is_second_done = 0;";
$result = $database->conn->query($sql);

while($row = $result->fetch(PDO::FETCH_ASSOC)){
    $arr[$i] = $row;
    $arr[$i]['definition'] = json_decode($arr[$i]['definition']);
    $arr[$i]['examples'] = json_decode($arr[$i]['examples']);
    $i++;
}

$sql = "SELECT * FROM words WHERE DATE(third_rep_date) = '$currentDate' AND user_id = 1 AND is_third_done = 0;";
$result = $database->conn->query($sql);

while($row = $result->fetch(PDO::FETCH_ASSOC)){
    $arr[$i] = $row;
    $arr[$i]['definition'] = json_decode($arr[$i]['definition']);
    $arr[$i]['examples'] = json_decode($arr[$i]['examples']);
    $i++;
}

$sql = "SELECT * FROM words WHERE DATE(fourth_rep_date) = '$currentDate' AND user_id = 1 AND is_fourth_done = 0;";
$result = $database->conn->query($sql);

while($row = $result->fetch(PDO::FETCH_ASSOC)){
    $arr[$i] = $row;
    $arr[$i]['definition'] = json_decode($arr[$i]['definition']);
    $arr[$i]['examples'] = json_decode($arr[$i]['examples']);
    $i++;
}

$sql = "SELECT * FROM words WHERE DATE(fiveth_rep_date) = '$currentDate' AND user_id = 1 AND is_fiveth_done = 0;";
$result = $database->conn->query($sql);

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