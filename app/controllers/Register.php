<?php


class Register extends Controller {    
    public function __construct() {
        parent::__construct();
    }
    
    /**
     * Gathers data from sign-up form and creates
     * account
     */
    public function createAccount() {
        // Stores form errors
        $data = array("username_err" => "", "password_err" => "", "username_class" => "", "password_class" => "");
        
        // Process form data
        if($_POST) {
            // Validate form entries
            $val = new Validate();
            $data["username_err"] = $val->valid_username($_POST["username"]);
            if (empty($data["username_err"])) {
                $data["password_err"] = $val->valid_password($_POST["password"], $_POST["confirm_password"]);
                if(!empty($data["password_err"])) {
                    $data["password_class"] = "class = 'invalid'";
                }
            } else {
                $data["username_class"] = "class = 'invalid'";
            }
            
            // Create account
            if (empty($data["username_err"]) && empty($data["password_err"])) {
                $user = new Users($_POST["username"]);
                $user->new_user($_POST["password"]);
				$user->login();
				
				header("location: ".BASE_URL."decks/create/new");
            }
        }
        
        // Render sign-up form
        $this->view->render_as_page("createaccount", $data);
    }
    
    /**
     * Login functionality
     */
    public function login() {
        // Stores form errors
        $data = array("username_err" => "", "password_err" => "", "username_class" => "", "password_class" => "");
        
        // Loads cookie class for "Remember me" functionality
        $cookie = new Cookie();
        
        // Process form data
        if ($_POST) {
            // Validate form entries
            $val = new Validate();
            if (!($val->user_exists($_POST["username"]))) {
                $data["username_err"] = "There is no account with this username.";
                $data["username_class"] = "class = 'invalid'";
            } elseif(!($val->password_correct($_POST["username"], $_POST["password"]))) {
                $data["password_err"] = "The password is not correct.";
                $data["password_class"] = "class = 'invalid'";
            }
                    
            // Log user in
            if (empty($data["username_err"]) && empty($data["password_err"])) {
                $user = new Users($_POST["username"]);
                $user->login();
                                
                // Remember me
                if(isset($_POST["remember_me"])) {
                    $cookie->setCookie($_POST["username"]);
                }
				
				// Redirect to "My Decks"
				header("location: ".BASE_URL."decks/view");
            }
        }
        
        // If user has set "Remember me", log user in automatically
        if($cookie->remember()) {
            $user = new Users($_COOKIE["username"]);
            $user->login();
        }
        
        // Render login page
        $this->view->render_as_page("login", $data);
    }
    
    /**
     * Logout functionality
     */
    public function logout() {
        if(isset($_SESSION["username"])) {
            $user = new Users($_SESSION["username"]);
            $user->logout();
            header("location: ".BASE_URL."register/login");
        }
    }
}