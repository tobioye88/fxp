<?php
use BetaCoin\Error as Err;
class Error extends Controller {
	function __construct() {
		parent::__construct(__CLASS__);
		$this->view->meta = '<meta name="description" content="">';
		$this->view->title = 'Error';
	}
	public function index(){
		$this->view->head = $this->getHead('pageNotFound');
		$this->view->body = $this->getbody('pageNotFound');
		$this->view->render('error/index');
	}
	public function getHead($errorname){
		$error = Err::getGroup($errorname);
		return $error['head'];
	}
	public function getbody($errorname){
		$error = Err::getGroup($errorname);
		return $error['body'];
	}
}