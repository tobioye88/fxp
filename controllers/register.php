<?php
/**
* 
*/
use Violin\Violin;
class Register extends Controller {
	
	function __construct() {
		parent::__construct(__CLASS__);
		if(Auth::check()) header('location: '.URL.'dashboard');
	}
	public function index($name= '') {
		$this->view->title = 'Register';
		$this->view->render('register/index');
	}
	public function signup(){
		// require "libs/violin.php";
		$v = new Violin;
		$v->addRuleMessage('name', 'The {field} field expects "Name", found "{value}" instead.');

		$v->addRule('name', function($value, $input, $args) {
			if(preg_match('/[a-z -]/i', $value))
				return true;
		    return $value === false;
		});
		$data = $_POST;

		$rules = [
		    'first_name' => 'required|alpha|min(3)|max(20)',
		    'last_name' => 'required|alpha|min(3)|max(20)',
		    'phone'  => 'required|number',
		    'bank_account_name' => 'required|name',
		    'bank_name' => 'required|name',
		    'type'=>'required',
		    'bank_account_number'=> 'required|number',
		    'email'  => 'required|email',
		    'password'=> 'required|min(6)',
		    'repassword'=> 'required|matches(password)'
		];

		$v->validate($data, $rules);
		if ($v->passes()) {
		    // Passed
		    $data = [
		    'email'  => $_POST['email'],
		    'password'=> $_POST['password']
		    ];
		    $detail = [
		    'first_name' => $_POST['first_name'],
		    'last_name' => $_POST['last_name'],
		    'phone'  => $_POST['phone'],
		    'type'  => $_POST['type']
		    ];
		    $bank = [
		    'name' => $_POST['bank_name'],
		    'account_name' => $_POST['bank_account_name'],
		    'account_number'=> $_POST['bank_account_number']
		    ];
		    User::create($data, $detail, $bank);
		    Auth::login($_POST['email'], $_POST['password']);
		    header('location: ../dashboard');
		} else {
			header('location: ../register');
		}
		
	}
}