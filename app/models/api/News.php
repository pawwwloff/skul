<?php

namespace app\models\api;

use vendor\core\base\Model;
use app\models\api\Category;

class News extends Model{
	 
	public $table = 'news';
	
	public function getNewsByCategory($id = null){
		if(isset($_GET['child']) && $_GET['child']=='yes'){
			$categories = new Category;
			$categories->getChild($id, $ids);
			$news = $this->findIn($ids, 'category', 'news_cat');
		}else{
			$news = $this->findLike($id, 'category', false, 'news_cat');
		}
		foreach ($news as $n){
			$newsId[] = $n['news'];
		}
		$news = $this->findIn($newsId, 'id', 'news');
		return $news;
	}
	
	public function getNewsByAuthor($id = null){
		$news = $this->findLike($id, 'author');
		return $news;
	}
	
	public function getCategories($news){
		foreach ($news as &$n){
			$catId = array();
			$cats = $this->findLike($n['id'], 'news', false, 'news_cat');
			foreach ($cats as $cat){
				$catId[] = $cat['category'];
			}
			$n['categories'] = $this->findIn($catId, 'id', 'categories');
		}
		return $news;
	}
	
}