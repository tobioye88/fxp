<?php

class Session
{
	
	public static function init()
	{
		session_start();
	}
	
	public static function set($key, $value, $main='gen')
	{
		$_SESSION[$main][$key] = $value;
	}
	
	public static function get($key, $main='gen')
	{
		if (isset($_SESSION[$main][$key]))
			return $_SESSION[$main][$key];
		else
			return false;
	}
	public static function unset_($key, $main='gen'){
		if (isset($_SESSION[$main][$key]))
			unset($_SESSION[$main][$key]);
	}
	public static function destroy($main='gen')
	{
		unset($_SESSION[$main]);
		//session_destroy();
	}
	
}
