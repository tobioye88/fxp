<?php

/**
* Basic Visitor Counter
* This counts all visitors and retrunees
*/
//CHECK TO SEE IF COOKIE OR SESSION EXISTS
	//CHECK TO SEE IF COOKIE OR SESSION DATE IS TODAY
	//IF TODAY, INCREMENT REVISIT FIELD
	//ELSE INCREMENT VISIT PER DAY
//ELSE NEW VISITOR INCREMENT VISITOR PER DAY
class Stat extends Database {
	public $table = 'stat';
	public $today = '';
	public $todaysdate = ''; 

	function __construct(){
		Session::init();
		parent::__construct();

		$this->today = strtotime("now");
		$this->todaysdate = date("Y-m-d ", $this->today);

		if($this->getCookie() || $this->getSession()){
			if($this->isCookieToday() || $this->isSessionToday()){
				if(!$this->isSessionToday()){
					$this->countRevisit();
				}
			}else{
				$this->countVisit();
			}
		}else{
			$this->countVisit();
		}
	}


	private function todayExits(){
		//GET TODAYS DATE AND CHECK THE DATABASE IF THE DAY IS SET
		$sql = "SELECT COUNT(id) as num FROM stats WHERE visitdate = '$this->todaysdate' LIMIT 1";
		$res = $this->select($sql);
		// if(!$res[0]['num'] > 0){
		// 	$this->addNewRow();
		// }
		return ($res[0]['num'] > 0)? true : false;
	}
	private function countRevisit(){
		if($this->todayExits()){
			//$sql = "UPDATE stats SET returnvisit = returnvisit+1";
			// $where = "visitdate = '". $this->todaysdate . "'";
			// $arr = ['returnvisit' => '`returnvisit` + 1'];
			// $this->update('stats', $arr, $where);
			$sql = "UPDATE stats SET returnvisit = returnvisit + 1 WHERE visitdate = '$this->todaysdate' ";
			$query = $this->prepare($sql);
			$query->execute();
			$this->setCookie();
			$this->setSession();
		}
	}
	public function countVisit(){
		if($this->todayExits()){
			//increment
			$this->increment();
			$this->setCookie();
			$this->setSession();
		}else{
			//add new row
			$this->addNewRow();
			$this->setCookie();
			$this->setSession();
		}
	}
	private function addNewRow(){
		//IF TODAY EXISTS
		$week = date("w", $this->today);
		$dayofweek = $this->dayofweek($week);
		$arr = ['visitdate'=> $this->todaysdate, 'visitday'=>$dayofweek, 'newvisit' => 1];
		$res = $this->insert('stats', $arr);
		return true;
	}
	private function increment(){
		$sql = "UPDATE stats SET newvisit = newvisit+1 WHERE visitdate = '$this->todaysdate' ";
		$query = $this->prepare($sql);
		$query->execute();
	}
	private function setSession(){
		return (Session::set('stat', $this->todaysdate, 'stat'))? true : false;
	}
	private function setCookie(){
		@setcookie("stat", $this->todaysdate, strtotime( '+30 days' ), "/", "", "", TRUE);
	}
	private function getCookie(){
		return (isset($_COOKIE['stat']))? true : false;
	}
	private function getSession(){
		return (Session::get('stat', 'stat'))? true : false;
	}
	private function isCookieToday(){
		if(isset($_COOKIE['stat']) && $_COOKIE['stat'] != $this->todaysdate){
			return false;
		}
		return true;
	}
	private function isSessionToday(){
		if(Session::get('stat', 'stat')!= $this->todaysdate){
			return false;
		}
		return true;
	}
	private function checkSession(){
		if(! Session::get('stat', 'stat')){
			return false;
		}
		return true;
	}
	private function dayofweek($i){
	//CONVERTS THE DAY OF THE WEEK IN DIGIT TO WORDS
		$days = ['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'];
		return $days[$i];
	}
}