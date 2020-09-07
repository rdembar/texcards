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
		$this->view->render_as_page($page_name);
	}
}