<?php

header("Content-Type: application/json; charset=UTF-8");
function cors() {//------------------------------------------------------------------------------
    
    // Allow from any origin
    if (isset($_SERVER['HTTP_ORIGIN'])) {
        // Decide if the origin in $_SERVER['HTTP_ORIGIN'] is one
        // you want to allow, and if so:
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


// Файлы, необходимые для подключения к базе данных
include_once "./Config/Database.php";
include_once "./Objects/Words.php";

// Получаем соединение с БД
$database = new Database();
$db = $database->getConnection();

// Создание объекта "User"
$word = new Word($db);

// Получаем данные
$data = json_decode(file_get_contents("php://input"));

        $user_id = $data->user_id;
        $id = $data->id;
        if ($word->save_progress($user_id, $id)) {

 http_response_code(200);
  
 echo json_encode(
     array(
         "message" => "Done"
     )
 );
        }
        else {

            http_response_code(401);

            echo json_encode(array("message" => "Fail"));
        }