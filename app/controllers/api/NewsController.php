<?php 

namespace app\controllers\api;

use app\models\api\News;
use vendor\core\base\Controller;

class NewsController extends Controller{
	
	public function indexAction(){
		$model = new News();
		$news = $model->findAll();
		$news = $model->getCategories($news);
		$model->returnToJson($news);
	}
	
	public function detailAction(){
		$model = new News();
		$news = $model->findLike($this->data['id'], 'id', false, 'news');
		$news = $model->getCategories($news);
		$model->returnToJson($news);
	}
	
}