<?php 

namespace  vendor\core;

class Db {
	
	protected $pdo;
	protected static $instance;
	
	private function __construct(){
		$db = require $_SERVER['DOCUMENT_ROOT'].'/../config/config_db.php';
		$dsn = "mysql:host={$db['Host']};dbname={$db['Name']};charset={$db['Charset']}";
		$this->pdo = new \PDO($dsn, $db['Login'], $db['Password'], $db['opt']);
	}
	
	public static function instance(){
		if(self::$instance === null){
			self::$instance = new self;
		}
		return self::$instance;
	}
	
	public function execute($sql, $values=array(), $ret = false) {
		$statement = $this->pdo->prepare($sql);
		if($ret){
			$statement->execute($values);
			return $this->pdo->lastInsertId();
		}else{
			return $statement->execute($values);
		}
	}
	
	public function query($sql, $values=array()) {
		$statement = $this->pdo->prepare($sql);
		$res = $statement->execute($values);
		if($res !== false){
			return $statement->fetchAll();
		}
		return array();
	}
	
	public function pdoSet($source=array(), &$values = array()) {
		$set = '';
		foreach ($source as $key=>$field) {
			$set.="`".str_replace("`","``",$key)."`". "=:$key, ";
			$values[$key] = $field;
		}
		return substr($set, 0, -2);
	}
	
}
