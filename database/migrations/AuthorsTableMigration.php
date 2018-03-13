<?php 

namespace database\migrations;

use vendor\core\base\Migration;

class AuthorsTableMigration extends Migration{

	public function up()
	{
		$this->int('id')->notnull('id')->increment('id')->primary('id');
		$this->varchar('name', 50)->notnull('name');
		$this->varchar('email', 30);
		$this->createTable('authors', $this->data);
	}
	
}