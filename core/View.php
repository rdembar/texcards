<?php

class View {
    public function render($viewName, $data = array()) {
        if (file_exists(ROOT.'/app/views/'.$viewName.'.php')) {
            include ROOT.'/app/views/'.$viewName.'.php';
        } else {
            echo 'Page not found.';
        }
    }
    
    public function render_as_page($viewName, $data = array(), $title = "TexCards") {
        $this->render("layout/header", array("title" => $title));
        $this->render($viewName, $data);
        $this->render("layout/footer");
    }
	
	public function alert($type, $header = "", $message = "") {
		$this->render("alerts/alert", array("type" => $type, "header" => $header, "message" => $message));
	}
}