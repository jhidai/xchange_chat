<?php 
class User {
    private $conn;
    public $token;
    public $id;



    public function __construct($db) {
        return $this->conn = $db;
    }

    public function connect($pseudo,$password) {

        $stmt = $this->conn->prepare("SELECT * FROM users WHERE pseudo = :pseudo AND password = :password");
        $stmt->bindParam(":pseudo", $pseudo);
        $stmt->bindParam(":password", $password);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $this->token = openssl_random_pseudo_bytes(16);
        $this->token = bin2hex($this->token);

        if ($result) {
            $this->id = $result[0]["id"];
            $auth = $this->conn->prepare("UPDATE users SET token = :token, status = TRUE WHERE id= :id");
            $auth->bindParam(":id", $this->id);
            $auth->bindParam(":token", $this->token);
            var_dump($this->token);
            $auth->execute();

            return true;
        }
        else{
            return false;
        }
    }
    public function register($name,$pseudo,$password,$number) {
        
        $stmt = $this->conn->prepare("INSERT INTO users(name,pseudo,password,number) VALUES (:name,:pseudo,:password,:number)");
        $stmt->bindParam(":name",$name);
        $stmt->bindParam(":pseudo",$pseudo);
        $stmt->bindParam(":password",$password);
        $stmt->bindParam(":number",$number);

        $result = $stmt->execute();

        if ($result) {
            return true;
        }
        else{
            return false;
        }


    }
    public function getMessages(){
        
    }

}































?>