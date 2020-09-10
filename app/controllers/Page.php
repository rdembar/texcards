<?php
/**
 * Page class: renders static pages
 */

class Page extends Controller {
	
    public function __construct() {
        parent::__construct();
    }
    
	/**
	 * Renders specified page_name
	 *
	 * @param string $page_name
	 */
	public function view($page_name) {
		$this->view->render_as_page($page_name, array(), ucwords($page_name));
	}
	
	/**
	 * Renders homepage
	 */
	public function home() {
		$this->view->render_as_page("home", array(), "TexCards");
	}
	
	/**
	 * Renders error message
	 */
	public function error() {
		$this->view->render_as_page('messages/error', array(), "Error");
	}
	
	/**
	 * Renders restricted message
	 */
	public function restricted() {
		$this->view->render_as_page('messages/restricted', array(), "Restricted");
	}
}