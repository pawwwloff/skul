<?php

namespace app\models\api;

use vendor\core\base\Model;

class Category extends Model{
	 
	public $table = 'categories';
	
	public function getChild($id, &$ids){
		$cats = $this->findLike($id, 'parent', false, 'categories');
		$ids[] = $id;
		foreach ($cats as &$cat){
			$cat['child'] = $this->getChild($cat['id'], $ids);
			//$cat['child'] = $this->findLike($cat['id'], 'parent', false, 'categories');
		}
		return $cats;
	}
	
}