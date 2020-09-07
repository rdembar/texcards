<?php

/**
 * Validate class - validates form data
 */
class Validate extends Model {
    public function __construct() {
        parent::__construct();
    }
    
    /**
     * Given a username, checks if it is a valid username
     * Returns an error message if invalid or empty string if valid
     *
     * @param string $username
     * @return string
     */
    public function valid_username($username) {
        // Check username not empty
        if (empty($username)) {
            return "Please enter a username.";
        }
        
        // Check username formatting
        if (!preg_match('/^\w{2,20}$/',$username)) {
            return "Please enter a different username. Username must be under 20 characters and can contain only letter, numbers, and underscores.";
        }
        
        // Check username not taken
        if ($this->user_exists($username)) {
            return "An account with this username already exists. Please choose a different username.";
        }
        
        return "";
    }
    
    /**
     * Given a password and password confirmation, checks validity
     * Returns an error message if invalid or empty string if valid
     *
     * @param string $password
     * @param string $confirm_password
     * @return string
     */
    public function valid_password($password, $confirm_password) {
        // Check password not empty
        if(empty($password)) {
            return "Please enter a password.";
        }
        
        // Check passwords match
        if ($password != $confirm_password) {
            return "Passwords do not match";
        }
        
        return "";
    }
	
	/**
	 * Given a deck title, checks if it is a valid deck title
	 * Returns an error message if invalid or empty string if valid
	 * 
	 * @param string $title
	 * @return string
	 */
    public function valid_deck_title($title) {
		// Checks title not empty
        if(empty($title)) {
            return "Please enter a title";
        }
        
		// Checks title has under 20 characters
        if(strlen($title) > 20) {
            return "Title can have up to 20 characters.";
        }
        
		// Checks title unique
        $decks = $this->db->get_rows($_SESSION["username"]."_decks", array("title" => $title));
        if ($decks != []) {
            return "You already have a deck with that title. Please choose a unique title.";
        }
        
        return "";
    }
	
    /*
     * Given a user, checks if user exists in database
     *
     * @param string $username
     */
    public function user_exists($username) {
        if (empty($username)) {
            return false;
        }
        $info = $this->db->get_rows("users", array("username" => $username));
        return $info == [] ? false : true;
    }
    
    /*
     * Given a username and password, checks if password is
     * correct for that user
     *
     * @param string $username
     * @param string $password
     */
    public function password_correct($username, $password) {
        $hash_password = $this->db->get_rows("users", array("username" => $username))["password"];
        return password_verify($password, $hash_password);
    }
}