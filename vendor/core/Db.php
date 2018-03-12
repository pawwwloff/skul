<?php 

namespace  vendor\core;

class Db {
	
	protected $pdo;
	protected static $instance;
	
	private function __construct(){
		$db = require $_SERVER['DOCUMENT_ROOT'].'/../config/config_db.php';
		$dsn = "mysql:host={$db['Host']};dbname={$db['Name']};charset={$db['Charset']}";
		$this->pdo = new \PDO($dsn, $db['Login'], $db['Password']);
	}
	
	public static function instance(){
		if(self::$instance === null){
			self::$instance = new self;
		}
		return self::$instance;
	}
	
	public function execute($sql) {
		$statement = $this->pdo->prepare($sql);
		return $statement->execute();
	}
	
	public function query($sql) {
		$statement = $this->pdo->prepare($sql);
		$res = $statement->execute();
		if($res !== false){
			return $statement->fetchAll();
		}
		return array();
	}
	
	public function pdoSet($source=array(), &$values) {
		$set = '';
		$values = array();
		foreach ($source as $key=>$field) {
			$set.="`".str_replace("`","``",$key)."`". "=:$key, ";
			$values[$key] = $field;
		}
		return substr($set, 0, -2);
	}
	
}
