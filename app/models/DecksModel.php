<?php

class DecksModel extends Model {
    
    public function __construct() {
        parent::__construct();
    }
    
	/**
	 * Retrieves user decks given username
	 * Each entry in return array represents a user deck
	 *
	 * @param string $username
	 * @return array 
	 */
    public function get_user_decks($username) {	
		$decks = $this->db->get_rows($username."_decks");
		return strval(array_keys($decks)[0]) == "id" ? array(0 => $decks) : $decks;
    }
	
	/**
	 * Gets information for deck given username, deck id
	 *
	 * @param string $username
	 * @param string $deck_id
	 * @return array
	 */
	 public function get_deck_info($username, $deck_id) {
		 return $this->db->get_rows($username."_decks", array("deck_id" => $deck_id));
	 }
    
    /**
     * Add new deck to database for given user
     *
     * @param string $username
     * @param string $title
     * @param cards array (term => answer)
     */
    public function new_deck($username, $title, $cards) {
        $id = $this->create_deck_id();
        
        // Add to user decks table
        $this->db->insert($username."_decks", array("deck_id" => $id, "title" => $title, "num_cards" => count($cards)));
        
        // Create new table for deck and populate
        $this->db->query("CREATE TABLE ".$id." (id INT NOT NULL PRIMARY KEY AUTO_INCREMENT, term TEXT, answer TEXT);");
        foreach ($cards as $k => $v) {
            $this->db->insert($id, array("term" => str_replace('\\', '\\\\', $k), "answer" => str_replace('\\', '\\\\', $v)));
        }
    }
	
	/**
	 * Edits user deck
	 *
	 * @param string $username
	 * @param string $deck_id
	 * @param string $title
	 * @param array $cards
	 */
	public function edit_deck($username, $deck_id, $title, $cards) {
		// Change title, num_cards in user_decks table
		$id = $this->db->get_rows($username."_decks", array("deck_id" => $deck_id))["id"];
		$this->db->update($username."_decks", array("title" => $title, "num_cards" => count($cards)), $id);
		
		// Change cards in deck table
		$this->db->query("DELETE FROM ".$deck_id.";");
		foreach ($cards as $k => $v) {
			$this->db->insert($deck_id, array("term" => str_replace('\\', '\\\\', $k), "answer" => str_replace('\\', '\\\\', $v)));
		}
	}
	
	public function delete_deck($username, $deck_id) {
		// Delete deck table
		$this->db->query("DROP TABLE ".$deck_id);
		
		// Delete deck from user table
		$id = $this->db->get_rows($username."_decks", array("deck_id" => $deck_id))["id"];
		$this->db->delete($username."_decks", $id);
	}
    
	public function update_last_studied($username, $deck_id) {
		$this->db->query("UPDATE ".$username."_decks set last_studied = CURRENT_TIMESTAMP WHERE deck_id = '".$deck_id."';");
	}
	
    /**
     * Create deck id - returns unique (to user)
     * string of 8 numbers/letters
     *
     * @return string
     */
    private function create_deck_id() {
        $chars =  'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        $str = '';
        $max = strlen($chars)-1;
        for ($i = 0; $i < 8; $i++) {
            $str .= $chars[random_int(0, $max)];
        }
        return $str;
    }
}