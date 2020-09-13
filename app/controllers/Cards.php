<?php

/**
 * Cards class: controlls flashcard viewing and studying
 */
 
class Cards extends Controller {
	
	public $data = array();
	
	public function __construct() {
		parent::__construct();
		
		// Initialize data values
		$this->data = array("title" => "", "last_studied" => "", "deck_id" => "", "cards" => array());
	}
	
	/**
	 * View flashcard deck
	 * 
	 * @param string $deck_id
	 */
	public function view($deck_id) {		
		$this->fill_data($deck_id);
		$this->view->render_as_page('flashcards', $this->data, $this->data["title"]);
	}
	
	/**
	 * Study flashcard deck
	 * 
	 * @param string $deck_id
	 */
	public function study($deck_id) {
		// Set last_studied to today
		$d = new DecksModel();
		$d->update_last_studied($_SESSION["username"], $deck_id);
		
		// Render page
		$this->fill_data($deck_id);
		$this->view->render_as_page('study', $this->data, 'Studying: '.$this->data["title"]);
	}
	
	/**
	 * Helper function: fills in deck information
	 * given deck id
	 * 
	 * @param string $deck_id
	 */
	private function fill_data($deck_id) {
		// Fill in deck id
		$this->data["deck_id"] = $deck_id;
		
		// Fill in title and last studied date
		$d = new DecksModel();
		$deck_info = $d->get_deck_info($_SESSION["username"], $deck_id);
		$this->data["title"] = $deck_info["title"];
		$this->data["last_studied"] = $deck_info["last_studied"];
		
		// Fill in cards
		$c = new CardsModel();
		$this->data["cards"] = $c->get_cards($deck_id);
	}
}