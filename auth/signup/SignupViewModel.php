<?php

class SignUpViewModel {
    private $database;
    private $crud;
    
    public function __construct(KeyCompassDB $database, Crud $crud) {
        $this->database = $database;
        $this->crud = $crud;
    }

    public function onFormSent(string $username, string $email, string $password) {
        //TODO: take this code to CRUD operator

        // Create new user and login with it
        $sql_query = "INSERT INTO users (id, username, email, password) VALUES (:id, :username, :email, :password)";
        $query = $this->database->connection->prepare($sql_query);
        $query_result = '';

        // generate an id and a hashed password
        $id = $this->database->newUniqueId();
        $salt = substr($id, -KeyCompassDB::SALT_LEN);
        $hashedPassword = $this->database->hashPassword($password, $salt);

        // bind parameters
        $query->bindParam(':id', $id);
        $query->bindParam(':username', $username);
        $query->bindParam(':email', $email);
        $query->bindParam(':password', $hashedPassword);

        // try and execute this query
        if ($query->execute()) {
            $query_result = "SUCCESS: user $username created";
        }
        else {
            $query_result = "ERROR: user $username could not be created";
        }
    }

    public function createUser() {
        
    }

}

?>