<?php 

namespace app\models;

use vendor\core\base\Model;
//use database\migrations;

class Seeds extends Model{
	private static $dir = '/../database/seeds/';
	public function startSeeds() {
		if ($files = scandir($_SERVER['DOCUMENT_ROOT'].self::$dir)) {
		    foreach ($files as $file){
		    	if(is_file($_SERVER['DOCUMENT_ROOT'].self::$dir.$file)){
		    		$seedsName = "database\seeds\\".(basename($_SERVER['DOCUMENT_ROOT'].self::$dir.$file, '.php'));
		    		if(class_exists($seedsName)){
		    			$seeder = new $seedsName;
			    		if(method_exists($seeder, 'run')){
							$seeder->run();
						}
		    		}
		    	}
		    }
		}
	}	
}