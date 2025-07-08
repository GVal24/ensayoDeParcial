<?php

require_once __DIR__ . "/../../config/database.php";

class typeServices {

    private $pdo;

    public static function connect() {
        self::$pdo = database::connection();
    }

    public function getAll() {
        $data = self::$pdo->query("SELECT * FROM types")->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }
}