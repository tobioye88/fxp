<?php
include('libs/Error.php');
use BetaCoin\Error as Err;
class App {
	protected $controller = 'index';
	protected $method = 'index';
	protected $params = [];
	
	function __construct(){
		$url = $this->parseUrl();

		if(file_exists('controllers/' . $url[0] . '.php')){
			$this->controller = $url[0];
			unset($url[0]);
		}else if (isset($url[0]) && !file_exists('controllers/' . $url[0] . '.php')){
			$this->controller = 'error';
			Err::setGroup('pageNotFound', 'Page Not Found', 'Oops!!! The page you requested is no more available or has been changed... :(');
		}
		
		require 'controllers/' . $this->controller . '.php';
		$this->controller = new $this->controller;
		if(isset($url[1])){
			if(method_exists($this->controller, $url[1])){
				$this->method = $url[1];
				unset($url[1]);
			}
		}
		
		$this->params = $url ? array_values($url): [];
		call_user_func_array([$this->controller, $this->method], $this->params);
		
	}
	
	public function parseUrl(){
		if(isset($_GET['url'])){
			return $url = explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
		}
	}
}