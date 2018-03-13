<?php 

namespace app\controllers\api;

use app\models\api\Author;
use app\models\api\News;
use vendor\core\base\Controller;

class AuthorController extends Controller{
	
	public function indexAction(){
		$model = new Author();
		$authors = $model->findAll();
		$model->returnToJson($authors);
	}
	
	public function newsAction(){
		$model = new News();
		$news = $model->findLike($this->data['id'], 'author');
		$news = $model->getCategories($news);
		$model->returnToJson($news);
	}
	
}