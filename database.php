<?php
class Database{
private $host = "localhost";
private $username = "root";
private $password = "Yes";
private $db_name = "shop";
public $conn;
//$conn = mysqli_connect($host, $username, $password, $db_name);
public function getConnection(){
   
    $this->conn = null;

    try{
        $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
    }catch(PDOException $exception){
        echo "Connection error: " . $exception->getMessage();
    }

    return $this->conn;
}
}
?>