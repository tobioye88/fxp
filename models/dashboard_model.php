<?php

class Dashboard_Model extends Model {
	function __construct(){
		parent::__construct();
		
	}
	public function exchange($par){
		$this->view->title = 'Dashboard - Exchange';
		$sql = "SELECT id, min, currency, max, method, terms, u_id, (SELECT CONCAT(details.first_name, ' ',details.last_name) FROM details WHERE details.u_id = pool.u_id) names FROM pool WHERE id = $par";
		$this->view->details = $this->f->get(0,$sql);
		$this->view->render('dashboard/exchange');
	}
}