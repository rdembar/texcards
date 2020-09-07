<?php

class CardsModel extends Model {
	
	public function __construct() {
		parent::__construct();
	}
	
	/**
	 * Gets cards in term => answer array
	 * given deck id
	 * 
	 * @param string $deck_id
	 * @return array
	 */
	public function get_cards($deck_id) {
		$cards = $this->db->get_rows($deck_id);
		
		if (strval(array_keys($cards)[0]) == "id") {
			$cards = array(0 => $cards);
		}
		
		$arr = array();
		
		foreach($cards as $card) {
			$arr[$card["term"]] = $card["answer"];
		}
		
		return $arr;
	}
}