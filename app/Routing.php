<?php 
use vendor\core\Router;

Router::add('author', array('group'=>'api'));
Router::add('author/{id}/news', array('group'=>'api', 'action'=>'news'));
Router::add('category/{id}/news', array('group'=>'api', 'action'=>'news'));
Router::add('news', array('group'=>'api'));
Router::add('news/{id}', array('group'=>'api', 'action'=>'detail'));
Router::add('category', array('group'=>'api'));
Router::dispatch();