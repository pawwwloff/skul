<?php 

namespace database\migrations;

use vendor\core\base\Migration;

class CategoriesTableMigration extends Migration{

	public function up()
	{
		$this->int('id')->notnull('id')->increment('id')->primary('id');
		$this->text('name', 50)->notnull('name');
		$this->int('parent');
		$this->createTable('categories', $this->data);
	}
	
}