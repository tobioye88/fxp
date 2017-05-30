<?php

/**
* 
*/
class Notify {
	public static function read($nid){
		$arr = ['read'=>1];
		$db->update('messages', $arr, 'id = '.$nid);
	}
	// DELETE MESSAGE
	public static function delete($NID){
		$db = new DAtabase();
		$db->delete('notifications', 'id = '.$NID);
	}
	public static function getNotifications($uid){
		$arr = ['id' => $uid];
		$db = new Database();
		$res = $db->select("SELECT * FROM notifications WHERE user_id = :id AND `read` LIKE '0' ORDER BY `created_at` DESC", $arr);
		$res['num'] = $db->num_rows;
		if($res['num'] > 0){
			return $res;
		}
		return false;
	}
	public static function create($uid, array $not){
		$not['user_id'] = $uid;
		$type = $not['type'];
		$subject = $not['subject'];
		$message = $not['message'];
		if(!empty($type) && !empty($subject) && !empty($message)){
			$db = new Database();
			$res = $db->insert('notifications', $not);
			return $res ? true : false;
		}
		return false;
	}
	public static function createTable(){
		$sql = "CREATE TABLE IF NOT EXISTS notifications (
				`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY, 
				`user_id` INT NOT NULL,
				`subject` VARCHAR (255) NOT NULL,
				`message` TEXT NOT NULL, 
				`type` ENUM ('1', '2', '3', '4', '5'), 
				`read` ENUM ('0','1') NOT NULL DEFAULT '0',
				`created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
			    )";
		$db = new Database();
		$db->select($sql);
	}
}