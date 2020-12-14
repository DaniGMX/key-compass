<?php

class Injector {
    private static $instance = null;
    public static $dependenciesModule = [];
    public static $viewmodelModule = [];

    private function __construct() {
        Injector::$dependenciesModule = $this->initializeAppModules();
        Injector::$viewmodelModule = $this->initializeViewModelModules();
    }

    public static function getDependency(string $dependency) {
        if (Injector::$instance == null) Injector::$instance = new Injector();
        return array_key_exists($dependency, Injector::$dependenciesModule) ? Injector::$dependenciesModule[$dependency] : null;
    }

    public static function getViewModel(string $viewmodel) {
        if (Injector::$instance == null) Injector::$instance = new Injector();
        return array_key_exists($viewmodel, Injector::$viewmodelModule) ? Injector::$viewmodelModule[$viewmodel] : null;
    }

    private function initializeAppModules() {
        $modules = [
            Crud::ID => Crud::createCrud(),
            KeyCompassDB::DB_NAME => KeyCompassDB::connect(KeyCompassDB::PASSWORD),
        ];
        return $modules;
    }

    private function initializeViewModelModules() {
        $viewmodels = [
            SignUp::VIEW_ID => new SignUpViewModel(
                Injector::$dependenciesModule[KeyCompassDB::DB_NAME],
                Injector::$dependenciesModule[Crud::ID]
            ),
        ];
        return $viewmodels;
    }
}

?>