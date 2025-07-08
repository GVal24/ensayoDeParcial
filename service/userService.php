<?php
require_once "../config/database.php";


class userService{
    private static $pdo;


    ////////////  Conexion a DB   ///////////////
    public static function connect(){
        if (!self::$pdo) {
            self::$pdo = database::connection();
        }

    }

    ////////////  Creacion de usuario  ///////////////

    public function createUser($email, $password){
       
        self::connect();
        $sql= query("INSERT INTO users (email, password) VALUES (email = :email, password = :password);");
        $stmt= self::$pdo->prepare($sql);
        $stmt->execute([
            'email'=> $email,
            'password'=> $password
        ]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}