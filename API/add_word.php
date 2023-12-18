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


// Files to connect to DB
include_once "./Config/Database.php";
include_once "./Objects/Words.php";

// Get connection to DB
$database = new Database();
$db = $database->getConnection();

// creare object 'Word'
$new_word = new Word($db);

$current_day = 0;

$words_in_the_day = $new_word->get_number_of_words_for_the_day($current_day);

// print_r($words_in_the_day);

while(true) {
    $words_in_the_day = $new_word->get_number_of_words_for_the_day($current_day);
    if($words_in_the_day >= 5) {
        $current_day++;
    } else {
        break;
    }
}


// Get data through RESTFULL Api
$data = json_decode(file_get_contents("php://input"));

        // set values
        $new_word->word = $data->word;
        $new_word->type = $data->type;
        $new_word->definition = json_encode($data->definition);
        $new_word->examples = json_encode($data->examples);
        $new_word->user_id = $data->user_id;
        if ($new_word->add($current_day)) {

 http_response_code(200);
  
 // JSON-respond
 echo json_encode(
     array(
         "message" => "Done",
     )
 );

        }

        // msg if cannot to add word
        else {

            // respond code
            http_response_code(401);

            // sjow error msg
            echo json_encode(array("message" => "Fail"));
        }