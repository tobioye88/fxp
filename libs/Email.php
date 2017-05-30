<?php

class Email {
	protected $to = '';
	protected $from = AR_EMAIL;
	protected $headers = '';
	protected $subject = '';
	protected $message = '';
	
	public function __construct($to, $subject, $message = ''){
		$this->to = $to;
		$this->subject = $subject;
		$this->message = $message;
		$this->setHeader();
	}
	protected function setHeader(){
		$headers = "From: " . AR_EMAIL . "\n";
		$headers .= "MIME-Version: 1.0\n";
		$headers .= "Content-type: text/html; charset=iso-8859-1\n";
		$this->headers = $headers;	
	}
	public function activationMessage($uid, $f, $e, $p){
		$this->message = '<!DOCTYPE html><html><head><meta charset="UTF-8"><title>mybetaplace.com</title></head><body style="margin:0px; font-family:Tahoma, Geneva, sans-serif;"><div style="padding: 10px; background-color: rgba(110,206,53,1.00); font-size: 24px; color: #FFFFFF;border-bottom: 2px solid rgba(250,187,61,1.00);"><a href="http://www.mybetaplace.com"><img src="'.URL.'public/imgs/logo.png" width="36" height="30" alt="mybetaplace.com" style="border:none; float:left;"></a>mybetaplace.com Account Activation</div><div style="padding:24px; font-size:17px;">Hello '.$f.',<br /><br />Click the link below to activate your account when ready:<br /><br /><a href="'.URL.'/activation/index/id='.$uid.'/e='.$e.'/p='.$p.'"><span style="font-size: 26px; color: rgba(110,206,53,1.00);">Click here to activate your account now</span></a><br /><br /><br /><br />Login after successful activation using your:<br />* E-mail Address: <b>'.$e.'</b></div></body></html>';
	}
	public function sendEmail(){
		if($this->to == ''|| $this->subject == ''|| $this->message == '')
			return false;
		else{
			mail($this->to, $this->subject, $this->message, $this->headers);
			return true;
		}
	}
	
}