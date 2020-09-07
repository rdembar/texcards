<?php

/**
 * Base controller class
 */

class Controller extends Application {
    public $view;
    
    public function __construct() {
        parent::__construct();
        $this->view = new View();
    }
}