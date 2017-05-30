<?php
namespace BetaCoin;
use \Session;
/**
* 
*/
class Error {
	public static function set($errorName, $errorMessage) {
		Session::set($errorName, $errorMessage, 'error');
		return true;
	}
	public static function get($errorName='all'){
		if($errorName == 'all'){
			// Session::get('', 'error')
			// echo count($_SESSION['error']);
			$errors = [];
			foreach ($_SESSION['error'] as $error => $errorMessage) {
				$errors[$error] = $errorMessage;
			}
			return $errors;
		}else{
			return Session::get($errorName, 'error');
		}
	}
	public static function setGroup($errorName, $errorHead, $errorMessage) {
		Session::set($errorName.'_body', $errorMessage, 'error');
		Session::set($errorName.'_head', $errorHead, 'error');
		return true;
	}
	public static function getGroup($errorname){
		$error = [];
		$error['head'] = Session::get($errorname.'_head', 'error');
		$error['body'] = Session::get($errorname.'_body', 'error');
		return $error;
	}
}