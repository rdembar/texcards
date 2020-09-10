<?php

class View {
    public function render($viewName, $data = array()) {
        if (file_exists(ROOT.'/app/views/'.$viewName.'.php')) {
            include ROOT.'/app/views/'.$viewName.'.php';
        } else {
            Router::redirect('page/error');
        }
    }
    
    public function render_as_page($viewName, $data = array(), $title = "TexCards") {
        $this->render("layout/header", array("title" => $title));
		$this->render("layout/menu");
		
		// Display message if there is one
		if(isset($_SESSION["message"])) {
			$this->render("messages/alert", array("type" => $_SESSION["message_type"], "message" => $_SESSION["message"]));
			unset($_SESSION["message_type"], $_SESSION["message"]);
		}
		
        $this->render($viewName, $data);
        $this->render("layout/footer");
    }
}