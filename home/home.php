<?php

class Home {
    private $viewmodel;

    public function __construct(HomeViewModel $viewmodel)
    {
        $this->viewmodel = $viewmodel;
    }
}

?>