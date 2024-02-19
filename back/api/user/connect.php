<?php 
require_once "./headers.php";
require_once "../../config/Database.php";
require_once "../../models/User.php";


$inputs = json_decode(file_get_contents("php://input"));

$database = new Database;
$db = $database->connect();

$user = new User($db);

if ($inputs){
    

    $connect = $user->connect($inputs->pseudo,$inputs->password);

    if ($connect) {
        $getMessages = $user->getMessages();

        echo json_encode([
            "status" => true ,
            "connected" => true,
            "token"=> $user->token,
            "id"=> $user->id, 
            "message"=>"authenticated succesfully"
        ]);
    }
    else{
        echo json_encode(["message"=>"email ou mot de passe incorrect"]);
    }
}
// echo json_encode($response);














?>