<?php
class Manager {
    public function dbConnect() {
        try{
            $db = new PDO('mysql:host=localhost;dbname=projet4;charset=utf8', 'root', '');
        }catch(PDOException $exception){
            echo "Connection error: " . $exception->getMessage();
        }
        return $db;
    }
}