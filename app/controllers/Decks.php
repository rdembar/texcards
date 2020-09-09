<?php

/**
 * Decks class: controlls user decks
 */
 
class Decks extends Controller {
	public $data;
    
    public function __construct() {
        parent::__construct();
		
		// Initialize data values
		$this->data = array("err" => "", "new_account" => false, "deleted" => false);
		
		// Store form cards
		if($_POST) {
			$this->data["cards"] = $this->get_cards_from_form();
		}
    }
    
	/**
	 * View user decks
	 *
	 * @param $deleted is set to string "deleted"
	 * when user been redirected from deleting a deck
	 */
    public function view($deleted = false) {
		if(!isset($_SESSION["username"])) {
			header("location: ".BASE_URL."register/login");
		}

		// Show alert if deck has been deleted
		if($deleted == "deleted") { 
			$this->data["deleted"] = true;
		}
		
		// Store user decks
		$d = new DecksModel();
        $this->data["decks"] = $d->get_user_decks($_SESSION["username"]);
        
		// Render page
		$this->view->render_as_page('decks/view', $this->data, 'My Decks');
    }
    
	/**
	 * Create a deck
	 *
	 * @param $new is set to string "new" 
	 * when user has been redirected from creating an account
	 */
    public function create($new = false) { 
		$this->view->render('layout/header', array("title" => "Create a Deck"));
		
		// "Create account" pop-up if not logged in
		if(!isset($_SESSION["username"])) {
			$this->view->render('createaccount', array("pop-up" => true));
		}
	
		// Show alert if new account has been created
		if ($new == "new") {
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
                $id = $d->new_deck($_SESSION["username"], $_POST["title"], $cards);
				
				// Redirect 
				$this->redirect();
            } 
        }
        
        // Render page
        $this->view->render('decks/create', $this->data);
		$this->view->render('layout/footer');
    }
	
	/**
	 * Edit a deck 
	 * 
	 * @param string $deck_id
	 */
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
			
			// Check if deck is empty
			$this->deck_empty();
			
			// If no errors, submit form data
			if (empty($this->data["err"])) {
				$cards = $this->get_cards_from_form();
				
				$d = new DecksModel();
				$d->edit_deck($_SESSION["username"], $deck_id, $_POST["title"], $cards);
				
				// Redirect 
				$this->redirect();
			}
		}
		
		$this->view->render_as_page('decks/create', $this->data, 'Edit '.$this->data["title"]);
	}
	
	/**
	 * Delete a deck
	 *
	 * @param string $deck_id
	 */
	public function delete($deck_id) {
		$d = new DecksModel();
		$d->delete_deck($_SESSION["username"], $deck_id);
		
		// Redirect
		header("location: ".BASE_URL."decks/view/deleted");
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
		foreach($cards as $k => $v) {
			if(empty($k) || empty($v)) {
				unset($cards[$k]);
			}
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
	  * Helper function: checks if deck is empty and stores error message
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
	  
	  /**
	   * Helper function: redirects after deck has been created/edited
	   */
	  private function redirect() {
		if(isset($_POST["save"])) {
			header("location: ".BASE_URL."decks/view");
		} else {
			header("location: ".BASE_URL."cards/study/".$id);
		}
	  }
}