<?php
/*
*php_flag display_errors on
*php_value error_reporting 9999
*/

// Always provide a TRAILING SLASH (/) AFTER A PATH
define('URL', 'http://localhost/fxp/');
define('LIBS', 'libs/');

define('DB_TYPE', 'mysql');
define('DB_HOST', 'localhost');
define('DB_NAME', 'fxp');
define('DB_USER', 'root');
define('DB_PASS', '');

define('S_NAME', 'fxp');

// The sitewide hashkey, do not change this because its used for passwords!
// This is for other hash keys... Not sure yet
define('HASH_GENERAL_KEY', 'MixitUp200');

// This is for database passwords only
define('HASH_PASSWORD_KEY', 'catsFLYhigh2000miles');


/*
CREATE DATABASE IF NOT EXISTS fxp ;
CREATE TABLE IF NOT EXISTS fxp.user VALUES 
(
	id INT (11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
	email VARCHAR (255) NOT NULL UNIQUE,
	password VARCHAR (255) NOT NULL,
	created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
);*/