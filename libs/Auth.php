<?php
class Auth {
	public static function login($login, $password, $keep=false){
		//try and log users in else return false
		//CHECK LOGIN CREDENTIALS
		$db = new Database();
		$num = $id = $email ='';
		$sql = "SELECT * FROM users WHERE email = :email AND password = MD5(:password)";
		$par = ['email' => $login, 'password' => $password];
		$arr = $db->select($sql, $par);
		$num = $db->num_rows;
		if($arr){
			$id = $arr[0]['id'];
			$email = $arr[0]['email'];
		}
		if($num > 0){
			//LOG IN, SET SESSION, SET COOKIES IF THE CHECK BOX IS CHECKED
			//Session::init();
			Session::set('log', md5($password));
			Session::set('email', md5($email));
			Session::set('id', $id);

			if($keep){
				Cookie::set('log', md5($password));
				Cookie::set('email', md5($email));
				Cookie::set('id', $id);
			}
			return true;
		}else{
			return false;
		}
	}
	public static function isActivated(){
		$id = false;
		if(Cookie::get('id')){
			$id = Cookie::get('id');
		}elseif (Session::get('id')) {
			$id = Session::get('id');
		}
		if($id){
			$db = new Database();
			$sql = "SELECT id FROM users WHERE id = :id AND activated = '1'";
			$res = $db->select($sql, ['id'=>$id]);
			if(empty($res)){
				return false;
			}else
				return true;
		}
	}
	public static function check(){
		$db = new Database();
		//check if user is logged
		// check if session is set
		// check if cookie is set
		// return true
		if(Session::get('log') && Session::get('id') && Session::get('email')){
			// do something
			return true;
		}else if(Cookie::get('log') && Cookie::get('id') && Cookie::get('email')){
			// do domething
			$id = Cookie::get("id");
			$password = Cookie::get("log");
			$res = $db->select("SELECT id, password, MD5(email) AS e FROM users WHERE id = $id AND password = '$password'");
			if(!empty($res)){
				Session::set('id', $res[0]['id']);
				Session::set('log', $res[0]['lod']);
				Session::set('email', $res[0]['e']);
				return ture;
			} 
		}
		self::logout();
		return false;
	}
	public static function logout(){
		//log user out
		//Session::init();
		Session::destroy();
		Cookie::destroy("log");
		Cookie::destroy("id");
		return true;
	}
}