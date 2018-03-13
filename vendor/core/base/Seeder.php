<?php 

namespace vendor\core\base;

use vendor\core\Db;

abstract class Seeder{
	
	protected $pdo;
	
	public function __construct(){
		$this->pdo = Db::instance();
	}
	
	public function into($table, $data, $ret = false){
		$str = $this->pdo->pdoSet($data, $values);
		$sql = "INSERT INTO $table SET $str";
		return $this->pdo->execute($sql, $values, $ret);
	}
}