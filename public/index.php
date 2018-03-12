<?php 
use vendor\core\Router;
include_once $_SERVER['DOCUMENT_ROOT'].'/../vendor/core/Autoloader.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/../vendor/autoload.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/../vendor/libs/functions.php';
Router::add('/', array('group'=>'api'));
Router::add('author', array('group'=>'api'));
Router::add('faker', array('group'=>'faker'));
Router::dispatch();
?>