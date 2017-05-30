<?php
/**
* 
*/
class Message {
	
	function __construct(){
		# code...
	}
	// CREATE MESSAGE
	public static function create(array $mess){
		$uid = $mess['user_id'];
		$pid = $mess['property_id'];
		$name = $mess['name'];
		$email = $mess['email'];
		$phone = $mess['phone'];
		$mess['subject'] = 'Property Message';
		$message = $mess['message'];
		if(!empty($uid) && !empty($pid) && !empty($message)){
			$db = new Database();
			$res = $db->insert('messages', $mess);
			return $res ? true : false;
		}
		return false;
	}
	// DELETE MESSAGE
	public static function delete($mid){
		$db = new DAtabase();
		$db->delete('messages', 'id = '.$mid);
	}
	// UPDATE MESSAGE
	public static function read($mid){
		$arr = ['read'=>1];
		$db->update('messages', $arr, 'id = '.$mid);
	}
	// READ OLD MESSAGES
	public static function old($uid){
		$db = new Database();
		$res = $db->select('SELECT * FROM messages WHERE `read` LIKE 1 AND user_id = '.$uid);
		return $res;
	}
	// MAKE TABLE
	public static function createTable(){
		$sql = "DROP TABLE IF EXISTS messages;"."CREATE TABLE IF NOT EXISTS messages (
				`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY, 
				`user_id` INT NOT NULL,
				`property_id` INT NOT NULL,
				`name` VARCHAR (255) NOT NULL,
				`email` VARCHAR (255) NOT NULL,
				`phone` VARCHAR (255) NOT NULL,
				`subject` VARCHAR (255) NOT NULL,
				`message` TEXT NOT NULL, 
				`read` ENUM ('0','1') NOT NULL DEFAULT '0',
				`created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
			    )";
		$db = new Database();
		$db->select($sql);
	}
}