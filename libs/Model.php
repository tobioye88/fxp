<?php

class Model {

	function __construct(){
		//Session::init();
		// $this->view = new View();
	}
	public function checkEmail($email){

		$sql = "SELECT * FROM users WHERE email = '$email'";
		$res = $this->db->select($sql);
		$num = $this->db->num_rows;
		if($num > 0)
			return true;
		else
			return false;
	}
	public function checkPhone($phone){
		$sql = "SELECT id FROM users WHERE phone = '$phone'";
		$res = $this->db->select($sql);
		$num = $this->db->num_rows;
		if($num > 0)
			return true;
		else
			return false;
	}
	//testing
	public function test($input, $exit=0) {
		echo '<pre>';
		print_r($input);
		echo '</pre>';
		if($exit)
			exit();
	}
}