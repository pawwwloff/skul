<?php 

namespace app\controllers;

use app\models\Seeds;

class SeedsController{
	
	public function indexAction(){
		$seeds = new Seeds;
		$seeds->startSeeds();
	}
}