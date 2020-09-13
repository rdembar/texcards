<?php
 
 class Router {
    public static function route($url) {
        // Gather information from url
        $controller =  (isset($url[0]) && !empty($url[0])) ? $url[0] : DEFAULT_CONTROLLER;
        $method = (isset($url[1]) && !empty($url[1])) ? $url[1] : 'index';
        $params = (isset($url[2]) && !empty($url[2])) ? array_slice($url,2) : [];
        	
		// Check acl
		$permission = self::has_access($controller, $method);
		
		if(!$permission) {
			$controller = ACCESS_RESTRICTED;
			$method = 'restricted';
		}
			
        if (method_exists($controller, $method)) {
            $dispatch = new $controller();
            call_user_func_array(array($dispatch, $method), $params);   
        } else {
            self::redirect('page/error');
        }
    }
	
	public static function redirect($link) {
		header("location: ".BASE_URL.$link);
	}
	
	public static function has_access($controller, $method = 'view') {
		$acl_file = file_get_contents(ROOT.'/app/lib/acl.json');
		$acl = json_decode($acl_file, true);
		
		$user_acl = ["Guest"];
		if(isset($_SESSION["username"])) {
			$user_acl = ["LoggedIn"];
		}
		
		$permission = false;
		
		foreach($user_acl as $access) {
			if(array_key_exists($controller, $acl[$access])) {
				if(in_array("*", $acl[$access][$controller]) || in_array($method, $acl[$access][$controller])) {
					$permission = true;
				}
			}
			
			if(count($acl[$access]["denied"]) != 0) {
				if(array_key_exists($controller, $acl[$access]["denied"])) {
					if(in_array($method, $acl[$access]["denied"][$controller])) {
						$permission = false;
					}
				}
			}
		}
		
		return $permission;
	}
	
	public static function get_menu($file) {
		$menu_file = file_get_contents(ROOT.'/app/lib/'.$file.'.json');
		$menu_acl = json_decode($menu_file, true);
		
		$menu = array();
		foreach($menu_acl as $k => $v) {
			$args = explode('/', $v);
			$controller = isset($args[0]) ? $args[0] : "";
			$method = isset($args[1]) ? $args[1] : "";
			if (self::has_access($controller, $method)) {
				$menu[$k] = $v;
			}
		}
		
		return $menu;
	}
 }