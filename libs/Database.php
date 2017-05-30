<?php

class Database extends PDO{
	public $lastId = 0;
	public $num_rows = 0;
	public $error = false;
	public function __construct(){
		//parent::__construct(DB_HOST, DB_USER, DB_PASS, DB_NAME);
		parent::__construct(DB_TYPE.':host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASS);
	}
	
	/**
	 * select
	 * @param string $sql An SQL string
	 * @param array $array Paramters to bind
	 * @param constant $fetchMode A PDO Fetch mode
	 * @return mixed
	 */
	public function select($sql, $array = array(), $fetchMode = PDO::FETCH_ASSOC)
	{
		$this->num_rows = 0;
		if($sth = $this->prepare($sql)){
			foreach ($array as $key => $value) {
				$sth->bindValue(":$key", $value);
			}
			if(!$sth->execute())
				return false;
		$this->num_rows = $sth->rowCount();
		}else{
			return false;
		}
		if($fetchMode == PDO::FETCH_ASSOC)
			return $sth->fetchALL($fetchMode);
		if($fetchMode == PDO::FETCH_OBJ)
			return $sth->fetch($fetchMode);
	}
	
	/**
	 * insert
	 * @param string $table A name of table to insert into
	 * @param string $data An associative array
	 */
	public function insert($table, $data)
	{
		//ksort($data);
		
		$fieldNames = implode('`, `', array_keys($data));
		$fieldValues = ':' . implode(', :', array_keys($data));
		
		if($sth = $this->prepare("INSERT INTO $table (`$fieldNames`) VALUES ($fieldValues)")){		
			foreach ($data as $key => $value) {
				$sth->bindValue(":$key", $value);
			}
			
			if($sth->execute()){
				$this->lastId = $this->lastInsertId();
				return true;
			}
			else{
				$this->error = $sth->errorInfo();
				return false;
			}
		}else
			return false;
	}
	
	/**
	 * update
	 * @param string $table A name of table to insert into
	 * @param string $data An associative array
	 * @param string $where the WHERE query part
	 */
	public function update($table, $data, $where)
	{
		ksort($data);
		
		$fieldDetails = NULL;
		foreach($data as $key=> $value) {
			$fieldDetails .= "`$key`=:$key,";
		}
		$fieldDetails = rtrim($fieldDetails, ',');
		
		if($sth = $this->prepare("UPDATE $table SET $fieldDetails WHERE $where")){		
			foreach ($data as $key => $value) {
				$sth->bindValue(":$key", $value);
			}
			if($sth->execute())
				return true;
			else
				return false;
		}else
			return false;
	}
	
	/**
	 * delete
	 * 
	 * @param string $table
	 * @param string $where
	 * @return integer Affected Rows
	 */
	public function delete($table, $where)
	{
		return $this->exec("DELETE FROM $table WHERE $where ");
	}
}
