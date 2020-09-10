<?php

class Account extends Controller {
	
	public $data;
	
	public function __construct() {
		parent::__construct();
		
		// If user not logged in, redirect
		if(!isset($_SESSION["username"])) {
			header("location: ".BASE_URL."register/login");
		}
		
		// Initialize data
		$this->data = array("username_err" => "", "password_err" => "", "new_password_err" => "", "delete_called" => false);
	}

	/**
	 * View account page
	 */
	public function view() {		
		// Process form data
		if($_POST) {
			if(isset($_POST["change_username"]) && $_POST["change_username"] == "yes") {
				$this->change_username();
			} else if (isset($_POST["change_password"]) && $_POST["change_password"] == "yes") {
				$this->change_password();
			} else if (isset($_POST["delete_account"]) && $_POST["delete_account"] == "yes") {
				$this->delete_account();
				$this->data["delete_called"] = true;
			}
		} 
		
		$this->view->render_as_page("user/account", $this->data, "Account");
	}
	
	/**
	 * Delete user account
	 */
	public function delete_account() {		
		if(isset($_POST["delete_called"]) && $_POST["delete_called"]) {
			$user = new Users($_SESSION["username"]);
			$user->destroy();
			$this->set_alert("success", "Your account has been deleted.");
			header('location: '.BASE_URL.'page/home');
		} else {
			$message = "Are you sure you want to delete your account? Once done, this action cannot be undone. \
						<br> <a onclick='$(`#delete_account`).submit();'>Yes, I'm sure.</a>";
			$this->set_alert("warning", $message, true);
		}
	}
	
	/**
	 * Helper function: called when username changed
	 */
	public function change_username() {
		// Check username changed
		if($_POST["username"] != $_SESSION["username"]) {
			// Validate new username
			$val = new Validate();
			$this->data["username_err"] = $val->valid_username($_POST["username"]);
			
			// Change username
			if(empty($this->data["username_err"])) {
				$user = new Users($_SESSION["username"]);
				$user->change_username($_POST["username"]);
			}
		}
	}
	
	
	/**
	 * Helper function: called when password changed 
	 */
	private function change_password() {
		// Confirm current password correct
		$val = new Validate();
		if(!($val->password_correct($_SESSION["username"], $_POST["password"]))) {
			$this->data["password_err"] = "The password is not correct.";
		}
		
		// Validate new password
		$this->data["new_password_err"] = $val->valid_password($_POST["new_password"], $_POST["confirm_new_password"]);
		
		// Change password
		if(empty($this->data["password_err"]) && empty($this->data["new_password_err"])) {
			$user = new Users($_SESSION["username"]);
			$user->change_password($_POST["new_password"]);
			$this->set_alert("success", "Your password has been changed successfully.");
		}
	}
}