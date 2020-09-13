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
			$message_data = array("type" => $_SESSION["message_type"], "message" => $_SESSION["message"], "warn" => false);
			if(isset($_SESSION["warn_action"])) {
				$message_data["warn"] = true;
				$message_data["action"] = $_SESSION["warn_action"];
			}
			$this->render('messages/alert_static', $message_data);
		}
		
        $this->render($viewName, $data);
        $this->render("layout/footer");
    }
}