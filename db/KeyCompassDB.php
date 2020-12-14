<?php

include "Crud.php";

class KeyCompassDB {
    public const DB_NAME = 'key_compass_database';
    public const PASSWORD = '';
    public const SALT_LEN = 5;
    private static $_server = 'localhost';
    private static $_user_name = 'root';
    private static $_connection;

    public $server;
    public $user_name;
    public $connection;
    public $operator;

    private function __construct(string $server, string $user_name, $connection) {//, Crud $operator) {
        $this->server = $server;
        $this->user_name = $user_name;
        $this->connection = $connection;
    }

    public static function connect(string $password) {
        $db = null;
        try {
            $server = KeyCompassDB::$_server;
            $user_name = KeyCompassDB::$_user_name;
            $db_name = keyCompassDB::DB_NAME;
            $connection = new PDO(
                "mysql:host=$server;dbname=$db_name",
                $user_name,
                $password
            );
            $db = new KeyCompassDB($server, $user_name, $connection);
        } catch(PDOException $exc) {
            die('Connection failed: ' . $exc->getMessage());
        }

        return $db;
    }

    public function insert() {
        
    }

    public function newUniqueId() {
        return uniqid("", true);
    }

    public function hashPassword(string $password, string $salt) {
        $saltyPassword = $salt . $password . $salt;
        return md5($saltyPassword);
    }
}

?>