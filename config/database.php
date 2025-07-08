<?php

class database{

    public static function connection() : PDO{
            $db = 'mysql:dbname=videogame_db;host=localhost';
            $usuario = 'root';
            $contraseña = '';
            return new PDO($db, $usuario, $contraseña);
    }
}