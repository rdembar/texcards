<?php
define('ROOT', dirname(__FILE__));

/** load config settings */
require_once(ROOT.'/config/config.php');

/** autoload classes */
spl_autoload_register(function($className) {
    if (file_exists(ROOT.'/app/controllers/'.$className.'.php')) {
        include_once ROOT.'/app/controllers/'.$className.'.php';    
    } elseif (file_exists(ROOT.'/app/models/'.$className.'.php')) {
        include_once ROOT.'/app/models/'.$className.'.php';    
    } elseif (file_exists(ROOT.'/core/'.$className.'.php')) {
        include_once ROOT.'/core/'.$className.'.php';    
    }
});

/** initiate session */
session_start();

/** gather url info */
$url = [];
if(isset($_SERVER["PATH_INFO"])) {
    $url = explode('/', ltrim($_SERVER["PATH_INFO"],'/'));
}

/** route request */
Router::route($url);