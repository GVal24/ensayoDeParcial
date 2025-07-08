<?php

require_once '../config/database.php';

class gameService {
    private static $pdo;
    

      private static function connect() {
        if (!self::$pdo) {
            self::$pdo = database::connection();
        }
    }

    public static function getData() {
        try {
            self::connect();
            $sth = self::$pdo->query('SELECT * FROM videogames;');
            return $sth->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            throw new ErrorException($e->getMessage());
        }
    }

    
    public static function getById($id){
        self::connect();
        $stmt = self::$pdo->prepare("SELECT * FROM videogames WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function getAllTypes() {
        try {
            self::connect();
            $sth = self::$pdo->query('SELECT * FROM types;');
            return $sth->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            throw new ErrorException($e->getMessage());
        }
    }

    public static function createData($datos) {
        self::connect();
        $sql = "INSERT INTO videogames (title, release_year, developer, type_id) VALUES (?, ?, ?, ?)";
        $stmt = self::$pdo->prepare($sql);
        $stmt->execute([$datos["title"], $datos["release_year"], $datos["developer"], $datos["type_id"]]);
    }

    public static function updateData($id, $title, $release_year, $developer, $type_id) {
    self::connect();
    $sql = "UPDATE videogames 
            SET title = :title, release_year = :release_year, developer = :developer, type_id = :type_id 
            WHERE id = :id";
    $stmt = self::$pdo->prepare($sql);
    $stmt->execute([
        'id' => $id,
        'title' => $title,
        'release_year' => $release_year,
        'developer' => $developer,
        'type_id' => $type_id
    ]);
}

public static function replaceData($id, $title, $release_year, $developer, $type_id) {
    self::connect();
    $sql = "REPLACE INTO videogames (id, title, release_year, developer, type_id) 
            VALUES (:id, :title, :release_year, :developer, :type_id)";
    $stmt = self::$pdo->prepare($sql);
    $stmt->execute([
        'id' => $id,
        'title' => $title,
        'release_year' => $release_year,
        'developer' => $developer,
        'type_id' => $type_id
    ]);
}

    public static function deleteData($id){
        self::connect();
        $sql = "DELETE FROM videogames WHERE id= :id";
        $stmt = self::$pdo->prepare($sql);
        $stmt->execute(['id'=>$id]);
    }





}
