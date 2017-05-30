<?php
/**
* 
*/
class Contact extends Controller {
	
	function __construct() {
		parent::__construct(__CLASS__);
	}
	public function index($name= '') {
		$this->view->title = 'Contact';
		$this->view->render('contact/index');
	}
}