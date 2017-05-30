<?php
class User {
	public $id = '';
	public $first_name = '';
	public $last_name = '';
	public $avatar = '';
	public $country = '';
	public $state = '';
	public $city = '';

	public $email = '';
	public $phone = '';
	public $level = '';
	public $type = '';
	public $address = '';

	public $activated = '';
	public $paid = '';
	public $verified = '';
	public $total_posts = '';

	public $db;

	function __construct($id){
		$this->db = new Database();
	}
	public static function profile($id, $json = false){
		$db = new Database();
		$res = $db->select("SELECT `users`.id, `users`.email, `details`.phone, `details`.first_name, `details`.last_name, `banks`.name as bank_name, `banks`.account_name, `banks`.account_number FROM users, details, banks
			WHERE `users`.id = $id AND `details`.id = $id AND `banks`.id = $id");
		if($json){
			return json_encode($res[0]);
		}
		return $res[0];
	}

	//UPDATE 
	public static function update(){
		$db = new Database();
		$uid = $_POST['id'];
		$arr = [];
		$avi = self::uploadAvatar($uid, $_FILES['avatar']);
		if($avi){
			$arr['avatar'] = $avi;
		}
		$user['phone'] = $_POST['phone'];
		$user['email'] = $_POST['email'];
		$user['type'] = $_POST['type'];
		$user['level'] = $_POST['level'];
		$arr['state'] = $_POST['state'];
		$arr['city'] = $_POST['city'];
		$arr['first_name'] = $_POST['first_name'];
		$arr['last_name'] = $_POST['last_name'];
		$arr['address'] = $_POST['address'];
		$db->update('user', $user, 'id = '.$uid);
		$db->update('details', $arr, 'user_id = '.$uid);
	}
	public static function uploadAvatar($uid, $image){//uid, $_FILES['avatar']
		$db = new Database();
		if(isset($image) && $image['name'] != ''){
			$path = 'public/uploads/user'.$uid .'/profile/';
			$wpath = 'public/imgs/logo_sm.png';
			$old_avi = $db->select("SELECT avatar FROM user_profile WHERE user_id = ".$uid);
			$old_avi = $old_avi[0]['avatar'];
			
			if(!file_exists($path)){
				mkdir($path);
			}
			if(file_exists($path.$old_avi) && $old_avi != 'img/user1.png'){
				unlink($path.$old_avi);
			}
			$avi = new Picture();
			$avi->upload($image, $path);
			$i_name = $avi->image_name;
			$avi->resize($avi->path, $path.$i_name, 250, 250, $avi->ext);
			$avi->watermark($path.$i_name, $wpath, $path.$i_name, $avi->ext, true);
			$avi->crop($path.$i_name, $path.$i_name, 250, 250, $avi->ext);
			$avatar['avatar'] = $avi->image_name;
			$db->update('details', $avatar, 'user_id = '.$uid);
			return $avatar['avatar'];
		}
	}
	public static function activateUser($id){
		$db = new Database();
		$res = $db->select('SELECT COUNT(id) as count FROM users WHERE id = '.$id);
		if($res[0]['count'] > 0){
			$arr = ['activated'=>1];
			$res = $db->update('user_account', $arr, 'user_id = '.$id);
		}else{
			$arr = ['activated'=>1, 'user_id'=>$id, 'paid'=>'unpaid'];
			$res = $db->insert('user_account', $arr);
		}
		return ($res)? true : false;
	}
	public static function deactivateUser($id){
		$db = new Database();
		$arr = ['activated'=>0];
		$res = $db->update('users', $arr, 'user_id = '.$id);
		return ($res)? true : false;
	}
	public static function changePassword($id, $data){
		$db = new Database();
		$res = $db->select('SELECT password FROM users WHERE id = '.$id);
		if(md5($data['oldPassword']) == $res[0]['password'] && ($data['nPassword'] == $data['rPassword'])){
			$arr['password'] = md5($data['rPassword']);
			$res = $db->update('users', $arr, 'id = '.$id);
		}else 
			return false;
		return true;
	}

	//delete
	public function deleteAccount(){
		//DELETE USER FORM TABLE
		$this->delete('users', 'id = '.$this->id);
		//RETURN TRUE
		return true;
	}
	//CREATE USER
	public static function create($data, $details, $bank){
		$db = new Database();
		$data['password'] = md5($data['password']);
		if($db->insert('users', $data)){
			$details['u_id'] = $bank['u_id'] = $db->lastId;
			$db->insert('details', $details);
			$db->insert('banks', $bank);
			return true;
		}else{
			return false;
		}
	}
}