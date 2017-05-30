<?php

require('config.php');


function __autoload($class){
	require 'libs/'.$class.'.php';
}
Session::init(); 
$betaCoin = new App();

