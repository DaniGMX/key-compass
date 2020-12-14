<?php

class Query {
    public $query = [];

    private function __construct(string $crudOperation) {
        $this->query[] = $operation;
    }

    public static function insert(string $item) {
        
    }

    public static function select(string $item) {

    }

    public static function update(string $item) {

    }

    public static function remove(string $item) {

    }
}

class Statement {
    public $statement;

    public function __construct() {

    }
}

?>