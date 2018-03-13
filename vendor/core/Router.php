<?php 

namespace vendor\core;
class Router{
	
	protected static $routes = array();
	protected static $route = array();
	
	public static function add($reg, $route = array()){
		
		$reg = str_replace('{', '(?P<', $reg);
		$reg = str_replace('}', '>[a-z-0-9]+)', $reg);
		if(isset($route['group'])){
			$route['url'] = $reg;
			$reg = $route['group']."/".$reg;
		}
		self::$routes["^$reg$"] = $route;
	}
	
	public static function match(){
		$uri = explode('?', $_SERVER['REQUEST_URI']);  
		$url = ltrim(rtrim($uri[0],'/'),"/");
		foreach (self::$routes as $patt => $route){
			if(preg_match("#$patt#i", $url, $matches)){
				
				foreach ($matches as $k => $v){
					if(is_string($k))
						$route[$k] = $v;
				}
				if(isset($route['url']) && !isset($route['controller'])){
					$data = explode('/', $route['url']);
					$route['controller'] = $data[0]?:'';
					if(!isset($route['action']) && isset($data[1])){
						$pos = strripos($data[1], '(?P');
						if ($pos !== false){
							$data[1] = '';
						}
						$route['action'] = $data[1]?:'index';
					}
				}
				if(!isset($route['action']))
					$route['action'] = 'index';
				self::$route = $route;
				
				return true;
			}
		}
		return false;
	}
	
	public static function getRoutes(){
		return self::$routes;
	}
	
	public static function dispatch(){
		self::add('^$', array('controller'=>'Main', 'action'=>'index'));
		self::add('^(?P<controller>[a-z-]+)/?(?P<action>[a-z-]+)?$');
		if(self::match()){
			$controller = self::$route['controller'].'Controller';
			unset(self::$route['controller']);
			$controller = self::controllerCase($controller);
			$controllerPath = isset(self::$route['group'])? '\\app\\controllers\\'.self::$route['group']."\\" : '\\app\\controllers\\';
			$controller = $controllerPath.$controller;
			if(class_exists($controller)){
				$obj = new $controller;
				$action = self::$route['action'].'Action';
				unset(self::$route['action']);
				$action = self::actionCase($action);
				$obj->data = self::$route;
				if(method_exists($obj, $action)){
						$obj->$action();
				}else{
					http_response_code(404);
					echo 'Method not exist';
				}
			}else{
				http_response_code(404);
				echo 'Controller not exist';
			}
		}else{
			http_response_code(404);
			echo '404';
		}
	}
	
	protected static function controllerCase($name) {
		$name = str_replace('-', ' ', $name);
		$name = ucwords($name);
		$name = str_replace(' ', '', $name);
		return $name;
	}
	protected static function actionCase($name) {
		return lcfirst(self::controllerCase($name));
	}
}