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
                            date_created DATE DEFAULT CURRENT_TIMESTAMP,
							last_studied DATE DEFAULT CURRENT_TIMESTAMP,
							num_cards INT 
                        );");
    }
	
    /**
	 * Changes username
	 *
	 * @param string $new_username
	 */
	public function change_username($new_username) {
		$id = $this->get_user_info()["id"];
		$username = $this->get_user_info()["username"];
		
		// Change username in users table
		$this->db->update("users", array("username" => $new_username), $id);
		
		// Change username in decks table
		$this->db->query("ALTER TABLE ".$username."_decks RENAME TO ".$new_username."_decks;");
		
		// Change session username
		$_SESSION["username"] = $new_username;
	}
	
	/**
	 * Changes password
	 * 
	 * @param string $new_password
	 */
	public function change_password($new_password) {
		// Hash password
		$password = password_hash($new_password, PASSWORD_DEFAULT);
		
		// Change password in users table
		$id = $this->get_user_info()["id"];
		$this->db->update("users", array("password" => $password), $id);
	}
	
    /**
     * Deletes user account
     */
    public function destroy() {
        
    }
}