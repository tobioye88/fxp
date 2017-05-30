<?php
/**
* 
*/
class Help extends Controller {
	
	function __construct() {
		parent::__construct(__CLASS__);
		//$this->model = $this->loadModel();
	}
	public function index($name= '') {
		$this->view->title = 'Help';
		$this->view->render('help/index');
	}
}