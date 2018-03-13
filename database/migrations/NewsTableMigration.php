<?php 

namespace database\migrations;

use vendor\core\base\Migration;

class NewsTableMigration extends Migration{

	public function up()
	{
		$this->int('id')->notnull('id')->increment('id')->primary('id');
		$this->varchar('name', 100)->notnull('name');
		$this->text('text')->notnull('text');
		$this->int('author')->foreignKey('author', 'authors', 'id');
		$this->createTable('news', $this->data);
		
		$this->data = array();
		$this->int('id')->notnull('id')->increment('id')->primary('id');
		$this->int('news')->notnull('news')->foreignKey('news', 'news', 'id');
		$this->int('category')->notnull('category')->foreignKey('category', 'categories', 'id');
		$this->createTable('news_cat', $this->data);
	}
	
	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		$this->dropTable('news_cat');
		$this->dropTable('news');
		$this->dropTable('categories');
		$this->dropTable('authors');
	}
	
}