<?php

/**
 * Register class: controlls user authentication
 */
 
class Register extends Controller {  

	public $data;
  
    public function __construct() {
        parent::__construct();
		
		$this->data = array("username_err" => "", "password_err" => "", "logged_out" => false);
    }
    
    /**
     * Gathers data from sign-up form and creates
     * account
     */
    public function createaccount() {
        // Process form data
        if($_POST) {
            // Validate form entries
            $val = new Validate();
            $this->data["username_err"] = $val->valid_username($_POST["username"]);
            if (empty($this->data["username_err"])) {
                $this->data["password_err"] = $val->valid_password($_POST["password"], $_POST["confirm_password"]);
            }
            
            // Create account
            if (empty($this->data["username_err"]) && empty($this->data["password_err"])) {
                $user = new Users($_POST["username"]);
                $user->new_user($_POST["password"]);
				$user->login();
				
				$this->set_alert("success", "You have created an account!");
				Router::redirect('decks/create');
            }
        }
        
        // Render sign-up form
        $this->view->render_as_page("user/createaccount", $this->data, 'Create Account');
    }
    
    /**
     * Login functionality
     */
    public function login() {	
        // Loads cookie class for "Remember me" functionality
        $cookie = new Cookie();
        
        // Process form data
        if ($_POST) {			
            // Validate form entries
            $val = new Validate();
            if (!($val->user_exists($_POST["username"]))) {
                $this->data["username_err"] = "There is no account with this username.";
            } elseif(!($val->password_correct($_POST["username"], $_POST["password"]))) {
                $this->data["password_err"] = "The password is not correct.";
            }
                    
            // Log user in
            if (empty($this->data["username_err"]) && empty($this->data["password_err"])) {
                $user = new Users($_POST["username"]);
                $user->login();
                                 
                // Remember me
                if(isset($_POST["remember_me"])) {
                    $cookie->setCookie($_POST["username"]);
                }
				
				// Redirect to "My Decks"
				Router::redirect('decks/view');
            }
        }
        
        // If user has set "Remember me", log user in automatically
        if($cookie->remember()) {
            $user = new Users($_COOKIE["username"]);
            $user->login();
        }
        
        // Render login page
        $this->view->render_as_page("user/login", $this->data, 'Login');
    }
    
    /**
     * Logout functionality
     */
    public function logout() {
        if(isset($_SESSION["username"])) {
            $user = new Users($_SESSION["username"]);
            $user->logout();
			if(isset($_COOKIE["username"])) {
				$c = new Cookie();
				$c->destroy();
			}
			
			$this->set_alert("success", "You have been logged out successfully.");
			header("location: ".BASE_URL."register/login");
        } else {
			header("location: ".BASE_URL."register/login");
		}
    }
}