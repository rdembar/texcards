<?php
/**
 * Decks class: creates and views
 * user decks
 */
 
class Decks extends Controller {
	public $data;
    
    public function __construct() {
        parent::__construct();
		
		// Initialize data
		$this->data = array("err" => "");
		$this->data["new_account"] = false;
		
		// Store form cards
		if($_POST) {
			$this->data["cards"] = $this->get_cards_from_form();
		}
    }
    
	/**
	 * View user decks
	 */
    public function view() {
		// Store user decks
		$d = new DecksModel();
        $data["decks"] = $d->get_user_decks($_SESSION["username"]);
        
		// Render page
		$this->view->render_as_page('decks/view', $data);
    }
    
	/**
	 * Create a deck
	 */
    public function create($new = false) { 
		// Show message if new account
		if ($new) {
			$this->data["new_account"] = true;
		}
	
        // Process form data
        if($_POST) {
			// Validate data
			$this->valid_title($_POST["title"]);
			$this->deck_empty();
			
			// If no errors, submit form data
            if(empty($this->data["err"])) {
                // Get cards
                $cards = $this->get_cards_from_form();
                
                // Create new deck
                $d = new DecksModel();
                $d->new_deck($_SESSION["username"], $_POST["title"], $cards);
            } 
        }
        
        // Render create page
        $this->view->render_as_page('decks/create', $this->data);
    }
	
	public function edit($deck_id) {		
		// Retrieve deck title
		$d = new DecksModel();
		$this->data["title"] = $d->get_deck_info($_SESSION["username"], $deck_id)["title"];
		
		// Retrieve cards
		if(!isset($this->data["cards"])) {
			$c = new CardsModel();
			$this->data["cards"] = $c->get_cards($deck_id);
		}
		
		if($_POST) {
			// If title was changed, validate title
			if ($_POST["title"] != $this->data["title"]) {
				$this->valid_title($_POST["title"]);
			}
			$this->deck_empty();
			
			// If no errors, submit form data
			if (empty($data["err"])) {
				$cards = $this->get_cards_from_form();
				
				$d = new DecksModel();
				$d->edit_deck($_SESSION["username"], $deck_id, $_POST["title"], $cards);
			}
		}
		
		$this->view->render_as_page('decks/create', $this->data);
	}
	
	/** 
	 * Helper function: stores cards from submitted form as
	 * term => answer array
	 *
	 * @return array
	 */
	private function get_cards_from_form() {
		$cards = array();
        $iter = 1;
        while(isset($_POST["q".$iter]) && isset($_POST["a".$iter])) {
            $cards[$_POST["q".$iter]] = $_POST["a".$iter];
            $iter += 1;
        }
		return $cards;
	}
	
	/** 
	 * Helper function: validates title and stores error
	 * 
	 * @param string $title
	 * @return bool
	 */
	 private function valid_title($title) {
		 $val = new Validate();
		 if ($val->valid_deck_title($title) != "") {
			 $this->data["err"] = $val->valid_deck_title($title);
			 return false;
		 }
		 return true;
	 }
	 
	 /**
	  * Helper function: checks if deck is empty
	  *
	  * @return bool
	  */
	  private function deck_empty() {
		if(!isset($_POST["q1"]) || empty($_POST["q1"]) || !isset($_POST["a1"]) || empty($_POST["a1"])) {
            $this->data["err"] = "Deck should have at least one card";
			return true;
        }
		return false;
	  }
}