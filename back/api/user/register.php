<?php 
require_once "./headers.php";
require_once "../../config/Database.php";
require_once "../../models/User.php";



$inputs = json_decode(file_get_contents("php://input"));

$database = new Database;
$db = $database->connect();

$user = new User($db);

if ($inputs){
    

    $connect = $user->register($inputs->name,$inputs->pseudo,$inputs->password,$inputs->number);

    if ($connect) {

        echo json_encode([
            "status" => true ,
            "message"=>"registered succesfully"
        ]);
    }
    else{
        echo json_encode(["message"=>"failed to register"]);
    }
}
























?>