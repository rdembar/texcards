<?php

/**
 * Users class
 */
class Users extends Model {
    private $_user; // stores username or user id
    
    public function __construct($user = '') {
        parent::__construct();
        $this->_user = $user;
    }
    
    /**
     * Gets info from users table for given user
     *
     * @return array
     */
    public function get_user_info() {
        // If $_user = user id, search by id
        if (is_int($this->_user)) {
            return $this->db->get_rows("users", array("id" => $this->_user));
        }
        
        // If $_user = username, search by username
        return $this->db->get_rows("users", array("username" => $this->_user));
    }
    
    /**
     * Logs user in
     */
    public function login() {
        $username= $this->get_user_info()["username"];
        $_SESSION["username"] = $username;
    }
    
    /**
     * Logs user out
     */
    public function logout() {
        session_destroy();
    }
    
    /**
     * Adds new user to users table
     *
     * @param string $password
     */
    public function new_user($password) {
        $userinfo = array(
            "username" => $this->_user,
            "password" => password_hash($password, PASSWORD_DEFAULT)
        );
        $this->db->insert("users", $userinfo);
        
        // Create table for user to store decks
        $this->db->query("CREATE TABLE ".$this->_user."_decks (
                            id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
                            deck_id VARCHAR(8) NOT NULL,
                            title VARCHAR(50) NOT NULL,
                            date_created DATE DEFAULT CURRENT_TIMESTAMP
                        );");
    }
    
    /**
     * Deletes user account
     */
    public function destroy() {
        
    }
}