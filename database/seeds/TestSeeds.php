<?php 

namespace database\seeds;

use vendor\core\base\Seeder;
use Faker;
use app\models\api;

class TestSeeds extends Seeder{

	public function run()
	{
		$aut = new api\Author();
		$cat = new api\Category();
		$news = new api\News();
		$faker = Faker\Factory::create();
		$it = 0;
		for ($i=0; $i < 8; $i++) {
			$data = array(
				'name' => $faker->name,
				'email' => $faker->email
			);
			if($this->into('authors', $data)){
				$it++;
			}
		}
		$return['data'][] = "В таблице authors создано $i записей!";
				
		$it = 0;
		for ($i=0; $i < 10; $i++) {
			$data = array(
				'name' => $faker->word,
				'parent' => $cat->rndm()
			);
			if($this->into('categories', $data)){
				$it++;
			}
		}
		
		$return['data'][] = "В таблице categories создано $i записей!";
		
		$it = 0;
		for ($i=0; $i < 20; $i++) {
			$data = array(
					'name' => $faker->sentence,
					'text' => $faker->text(50),
					'author' => $aut->rndm()
			);
			if($id = $this->into('news', $data, true)){
				$data = array(
						'news' => $id,
						'category' => $cat->rndm()
				);
				if($this->into('news_cat', $data)){
					$data = array(
						'news' => $id,
						'category' => $cat->rndm()
					);
					$this->into('news_cat', $data);
				}
				$it++;
			}
		}
		$return['data'][] = "В таблице news создано $i записей!";
		
		echo json_encode($return);
	}
}