<?php 

namespace app\controllers\api;

use app\models\api\Category;
use app\models\api\News;
use vendor\core\base\Controller;

class CategoryController extends Controller{
	
	public function indexAction(){
		$model = new Category();
		$cat = $model->findAll(array('by'=>'parent', 'sort'=>'asc'));
		$model->returnToJson($cat);
	}
	
	public function newsAction(){
		$model = new News();
		$news = $model->getNewsByCategory($this->data['id']);
		$news = $model->getCategories($news);
		$model->returnToJson($news);
	}
	
}