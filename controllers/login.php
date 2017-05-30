<?php
/**
* 
*/
class Login extends Controller {
	function __construct(){
		parent::__construct(__CLASS__);
		if(Auth::check()) header('location: '.URL.'dashboard');
	}
	public function index(){
		$this->view->meta = '<meta name="" content="">';
		$this->view->title = 'Login';
		$this->view->render('login/index');
	}
	public function login(){
		$email = lcfirst($_POST['email']);
		$password = $_POST['password'];
		// $checkbox = isset($_POST['keep'])? $_POST['keep']: '';
		if(Auth::login($email, $password)){
			header('location: ../dashboard');
		}else{
			header('location: ../login');
		}
	}
	public function logout(){
		Auth::logout();
		header('location: ../login');
	}
}