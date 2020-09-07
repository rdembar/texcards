<?php

class View {
    public function render($viewName, $data = array()) {
        if (file_exists(ROOT.'/app/views/'.$viewName.'.php')) {
            include ROOT.'/app/views/'.$viewName.'.php';
        } else {
            echo 'Page not found.';
        }
    }
    
    public function render_as_page($viewName, $data = array()) {
        $this->render("layout/header");
        $this->render($viewName, $data);
        $this->render("layout/footer");
    }
}