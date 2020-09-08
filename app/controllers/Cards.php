<?php

class Cards extends Controller {
	public function __construct() {
		parent::__construct();
	}
	
	public function view($deck_id) {
		$data = array("title" => "", "last_studied" => "", "deck_id" => "", "cards" => array());
		
		$data["deck_id"] = $deck_id;
		
		$d = new DecksModel();
		$deck_info = $d->get_deck_info($_SESSION["username"], $deck_id);
		$data["title"] = $deck_info["title"];
		$data["last_studied"] = $deck_info["last_studied"];
		
		$c = new CardsModel();
		$data["cards"] = $c->get_cards($deck_id);
		
		$this->view->render_as_page('flashcards', $data);
	}
	
	public function study($deck_id) {
		// Set last_studied to today
		$d = new DecksModel();
		$d->update_last_studied($_SESSION["username"], $deck_id);
		
		$data = array("cards" => array());
		
		$data["deck_id"] = $deck_id;
		
		// Get title
		$d = new DecksModel();
		$data["title"] = $d->get_deck_info($_SESSION["username"], $deck_id)["title"];
		
		// Get cards
		$c = new CardsModel();
		$data["cards"] = $c->get_cards($deck_id);
		
		$this->view->render_as_page('study', $data);
	}
	
}