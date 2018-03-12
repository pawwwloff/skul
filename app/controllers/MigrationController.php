<?php 

namespace app\controllers;

use app\models\Migration;

class MigrationController{
	
	public function indexAction(){
		$migrations = new Migration;
		$migrations->startMigration();
	}
	
	public function dropAction(){
		$migrations = new Migration;
		$migrations->stopMigration();
	}
	
}