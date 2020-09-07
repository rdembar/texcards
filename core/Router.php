<?php
 
 class Router {
    public function route($url) {
        /** gather information from url */
        $controller =  (isset($url[0]) && !empty($url[0])) ? $url[0] : DEFAULT_CONTROLLER;
        $method = (isset($url[1]) && !empty($url[1])) ? $url[1] : 'index';
        $params = (isset($url[2]) && !empty($url[2])) ? array_slice($url,2) : [];
        
        if (method_exists($controller, $method)) {
            $dispatch = new $controller();
            call_user_func_array(array($dispatch, $method), $params);   
        } else {
            die('The requested method could not be found.');
        }
    }
 }