<?php
/**
* 
*/
class About extends Controller {
	
	function __construct() {
		parent::__construct(__CLASS__);
		//$this->model = $this->loadModel();
	}
	public function index($name= '') {
		$this->view->title = 'About';
		$this->view->render('about/index');
	}
}