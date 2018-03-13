<?php 

namespace app\controllers;

use app\models\Main;

class MainController{
	private $params = array(
			//'cache' => $_SERVER['DOCUMENT_ROOT'].'/../cache',
	);
	private $twig;
	public function __construct(){
		$loader = new \Twig_Loader_Filesystem($_SERVER['DOCUMENT_ROOT'].'/../app/views');
		$this->twig = new \Twig_Environment($loader, $this->params);
	}
	
	public function indexAction(){
		echo $this->twig->render('index.html', array('title'=>'Главная страница'));
		/*$model = new Main();
		$authors = $model->findAll();
		$model->returnToJson($authors);*/
	}
	
}