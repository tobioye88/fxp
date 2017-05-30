<?php
/**
* 
*/
class Dashboard extends Controller {
	
	function __construct() {
		parent::__construct(__CLASS__);
		if(!Auth::check()) header('location: '.URL.'login');
		$this->f = new Fxp();
		$this->uid = Session::get('id');
	}
	public function index($name= '') {
		$this->view->title = 'Dashboard';
		$this->view->render('dashboard/index');
	}
	public function x4dollar(){
		$this->view->title = 'Dashboard - Exchange';
		$this->view->list = $this->f->getNaira();
		$this->view->render('dashboard/x4dollar');
	}
	public function X4Naira(){
		$this->view->title = 'Dashboard - Exchange';
		$this->view->list = $this->f->getDollar();
		$this->view->render('dashboard/X4Naira');
	}
	public function transfer(){
		$this->view->title = 'Dashboard - Transfer';
		// if($_POST['Exchange'] == 'Exchange'){
		// }
		$this->view->details = $_POST;
		$this->view->render('dashboard/transfer');
	}
	public function exchange($par){
		$this->view->title = 'Dashboard - Exchange';
		$sql = "SELECT 
		id, 
		min, 
		currency, 
		max, 
		method, 
		terms, 
		u_id, 
		(SELECT CONCAT(details.first_name, ' ',details.last_name) FROM details WHERE details.u_id = pool.u_id) names,
		(SELECT COUNT(id) FROM pool WHERE pool.u_id = pool.u_id) trade_number, 
		(SELECT COUNT(id) FROM pool WHERE pool.confirmed = 1 AND pool.u_id = pool.u_id) confirmed_trade_number 
		FROM pool 
		WHERE id = $par";
		$this->view->details = $this->f->get(0,$sql);
		$this->view->render('dashboard/exchange');
	}
	public function put(){
		if($this->f->put($this->uid)) true;//header('location: ../dashboard');
	}
	public function receive(){
		if($this->f->receive($this->uid)) header('location: ../dashboard');
	}
}