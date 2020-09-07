<?php

/**
 * Cookie class
 */
class Cookie extends Model {
    private $_expiry; // Stores expiry date
    
    public function __construct() {
        parent::__construct();
        $this->_expiry = time() + (30*24*60*60); // Set to expire in 1 month
    }
    
    /*
     * Check if a user has "remember me" enabled
     */
    public function remember() {
        if (isset($_COOKIE["username"]) && isset($_COOKIE["auth"])) {
            $hash_auth = $this->db->get_rows("users", array("username" => $_COOKIE["username"]))["remember_me"];
            if(password_verify($_COOKIE["auth"], $hash_auth)) {
                return true;
            }
        }
        return false;
    }
    
    /*
     * Generates a random string of numbers and letters
     * of length 16
     *
     * @return string
     */
    public function getAuthToken() {
        $chars =  'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        $str = '';
        $max = strlen($chars)-1;
        for ($i = 0; $i < 16; $i++) {
            $str .= $chars[random_int(0, $max)];
        }
        return $str;
    }
    
    /*
     * Adds cookie to users table
     *
     * @param string $username
     */
    public function setCookie($username) {
        if(!isset($_COOKIE["username"])) {
            // Set username and auth token
            setcookie("username", $username, $this->_expiry);
            $auth = $this->getAuthToken();
            setcookie("auth", $auth, $this->_expiry);
            
            // Store hashed auth token in users database
            $hash = password_hash($auth, PASSWORD_DEFAULT);
            $user_id = $this->db->get_rows("users", array("username" => $username))["id"];
            $this->db->update("users", array("remember_me" => $hash), $user_id);
        }
    }
    
    /**
     * Deletes cookies
     */
    public function destroy() {
        setcookie("username", "", time()-3600);
        setcookie("auth", "", time()-3600);
    }
}