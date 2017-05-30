<?php

/**
* 
*/
class Tables {
	
	function __construct() {
		$this->db = new Database();
	}
	public function users(){
		$sql = "CREATE TABLE `beta_coin`.`users` ( `id` INT NOT NULL AUTO_INCREMENT ,  `email` VARCHAR(255) NOT NULL ,  `password` VARCHAR(255) NOT NULL ,  `first_name` VARCHAR(255) NOT NULL ,  `last_name` VARCHAR(255) NOT NULL ,  `bank_name` VARCHAR(255) NOT NULL ,  `bank_account_number` INT NOT NULL ,  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,  `activated` ENUM('0', '1') NOT NULL DEFAULT '0' ,    PRIMARY KEY  (`id`),    UNIQUE  (`email`),    UNIQUE  (`bank_account_number`)) ENGINE = InnoDB;";
		$this->db->select($sql);
	}
	public function provide(){
		$sql = "CREATE TABLE `beta_coin`.`provide` ( `id` INT NOT NULL AUTO_INCREMENT ,  `providers_id` INT NOT NULL ,  `receivers_id` INT NOT NULL ,  `amount_provided` FLOAT NOT NULL ,  `amount_aprciated` FLOAT NOT NULL ,  `img_confirmation` VARCHAR(255) NOT NULL ,  `receivers_confirmation` ENUM('0', '1') NOT NULL DEFAULT '0' ,  `rate` INT NOT NULL ,  `created_at` TIMESTAMP NOT NULL ,  `confirmed_at` TIMESTAMP NOT NULL ,    PRIMARY KEY  (`id`)) ENGINE = InnoDB;";
		$this->db->select($sql);
	}
	public function helpList(){
		$sql = "CREATE TABLE `beta_coin`.`help_list` ( `id` INT NOT NULL AUTO_INCREMENT ,  `u_id` INT NOT NULL ,  `amount` FLOAT NOT NULL ,  `merged` ENUM('0', '1') NOT NULL DEFAULT '0' ,  `created_at` TIMESTAMP NOT NULL ,    PRIMARY KEY  (`id`)) ENGINE = InnoDB;";
		$this->db->select($sql);
	}
}