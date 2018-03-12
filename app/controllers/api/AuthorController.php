<?php 

namespace app\controllers\api;

use app\models\api\Author;

class AuthorController{
	
	public function indexAction(){
		$model = new Author();
		debug('indexAction');
	}
	
}