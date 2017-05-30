<?php

class Index extends Controller {

	function __construct() {
		parent::__construct(__CLASS__);
	}
	public function index($name= '') {
		$this->view->title = S_NAME;
		$this->view->render('index/index');
	}

}