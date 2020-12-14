<?php

class Crud {
    public const ID = 'CRUD';
    public $query;

    private function __constructor() {
        $this->instance = $instance;
    }

    public static function createCrud() {
        $crud = new Crud();
        return $crud;
    }
}

?>