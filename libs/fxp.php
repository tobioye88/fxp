<?php
/**
* 
*/
class Fxp {	
	function __construct(){
		$this->db = new Database();
	}
	public function put($uid){
		// echo '<pre>';
		// print_r($_POST);
		$data = [
		'u_id' => $uid,
		'currency' => $_POST['xcurrency'], 
		'amount' => $_POST['amount'], 
		'min' => $_POST['min'], 
		'max' => $_POST['max'], 
		'method'=>$_POST['method'],
		'terms'=>$_POST['terms']
		];
		// echo ($this->db->insert('pool', $data))? 'true': 'false';
		// print_r($this->db->error);
		return ($this->db->insert('pool', $data))? true: false;
	}
	public function get($id=false,$sql=false){
		if($id){
			$sql = "SELECT * FROM pool WHERE id = $id";
		}elseif($id == false && $sql == false){
			$sql = "SELECT * FROM pool";
		}
		return $this->db->select($sql);
	}
	public function getDollar(){
		$sql = "SELECT id, u_id, method, amount, min, max, (SELECT first_name FROM details WHERE details.u_id = pool.u_id) name FROM pool WHERE currency = 'dollar'";
		return $this->get(false,$sql);
	}
	public function getNaira(){
		$sql = "SELECT id, u_id, method, amount, min, max, (SELECT first_name FROM details WHERE details.u_id = pool.u_id) name FROM pool WHERE currency = 'naira'";
		return $this->get(false,$sql);
	}
}