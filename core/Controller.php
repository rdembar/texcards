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
	
	protected function set_alert($type, $message = "") {
		$_SESSION["message_type"] = $type;
		$_SESSION["message"] = $message;
	}
}