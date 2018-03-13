<?php 

namespace vendor\core\base;

use vendor\core\Db;

abstract class Model{
	
	protected $pdo;
	protected $table;
	
	public function __construct(){
		$this->pdo = Db::instance();
	}
	
	public function query($sql){
		return $this->pdo->execute($sql);
	}
	
	public function findAll($order = null){
		if(isset($_GET['name'])){
			return $this->findLike($_GET['name'], 'name');
		}else{
			$sql = "SELECT * FROM {$this->table}";
			if($order){
				$sql .= " ORDER BY {$order['by']} {$order['sort']}";
			}
			return $this->pdo->query($sql);
		}
	}
	
	public function findLike($str, $field, $per = true, $table = ''){
		$table = $table ?: $this->table;
		$sql = "SELECT * FROM $table WHERE $field LIKE ?";
		if($per)
			return $this->pdo->query($sql, ["%$str%"]);
		else
			return $this->pdo->query($sql, [$str]);
	}
	
	public function findIn($values, $field, $table = ''){
		$table = $table ?: $this->table;
		$sql = "SELECT * FROM $table WHERE $field IN (";
		for ($i=0;$i<count($values);$i++){
			$sql .= "?,";
		}
		$sql = substr($sql, 0, -1);
		$sql .= ")";
		return $this->pdo->query($sql, $values);
	}
	
	public function rndm($field = 'id'){
		$sql = "SELECT $field FROM {$this->table} ORDER BY RAND() LIMIT 1";
		$data = $this->pdo->query($sql);
		if($data)
			return $data[0][$field];
		else
			return null;
	}
	
    public function returnToJson($arr){
    	//debug($arr);
    	echo json_encode($arr);
    }
    

}