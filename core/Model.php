<?php

/**
 * Base model class
 */

class Model {
    protected $db;
    
    public function __construct() {
        $this->db = DB::getInstance();
    }
}