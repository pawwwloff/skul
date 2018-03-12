<?php 

namespace vendor\core\base;

use vendor\core\Db;

abstract class Migration{
	
	protected $pdo;
	protected $data = array();
	
	public function __construct(){
		$this->pdo = Db::instance();
	}
	
	protected function increment($name){
		if(isset($this->data[$name]))
			$this->data[$name] .= " AUTO_INCREMENT";
		else
			$this->data[$name] = " AUTO_INCREMENT";
		return $this;
	}
	
	protected function primary($name){
		if(isset($this->data["PRIMARY KEY"]))
			$this->data["PRIMARY KEY"] .= "$name";
		else
			$this->data["PRIMARY KEY"] = "$name";
		return $this;
	}
	
	protected function notnull($name){
		if(isset($this->data[$name]))
			$this->data[$name] .= " NOT NULL";
		else
			$this->data[$name] = " NOT NULL";
		return $this;
	}
	
	protected function text($name, $strln='255'){
		if(isset($this->data[$name]))
			$this->data[$name] .= " varchar($strln)";
		else
			$this->data[$name] = " varchar($strln)";
		return $this;
	}
	
	protected function int($name){
		if(isset($this->data[$name]))
			$this->data[$name] .= " int";
		else
			$this->data[$name] = " int";
		return $this;
	}
	

	protected function createTable($table, $data){
		$str = $this->prepareData($data);
		$sql = "CREATE TABLE `$table` (".$str.");";
		var_dump($this->pdo->execute($sql));
	}
	
	protected function dropTable($table){
		$sql = "DROP TABLE IF EXISTS `$table`";
		$this->pdo->execute($sql);
	}
	
	private function prepareData($data){
		$str = '';
		foreach ($data as $key=>$val)
			if($key!="PRIMARY KEY")
				$str .= $key.$val.', ';
		if(isset($data["PRIMARY KEY"])){
			$str .= " PRIMARY KEY ({$data['PRIMARY KEY']})";
		}else{
			$str = substr($str, 0, -2);
		}
		return $str;
	}
}