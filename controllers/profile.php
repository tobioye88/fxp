<?php
/**
* 
*/
class Profile extends Controller {
	
	function __construct() {
		parent::__construct(__CLASS__);
		if(!Auth::check()) header('location: login');
		$this->uid = Session::get('id');
	}
	public function index($uid=false) {
		$this->view->title = 'Profile';
		$this->view->profile = ($uid)? User::profile($uid): User::profile($this->uid);
		$this->view->render('dashboard/profile');
	}
}