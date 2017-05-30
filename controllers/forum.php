<?php
/**
* 
*/
class Forum extends Controller {
	
	function __construct() {
		parent::__construct(__CLASS__);
		//$this->model = $this->loadModel();
	}
	public function index($name= '') {
		$this->view->title = 'Forum';
		$this->view->render('forum/index');
	}
}