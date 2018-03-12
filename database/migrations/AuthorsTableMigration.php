<?php 

namespace database\migrations;

use vendor\core\base\Migration;

class AuthorsTableMigration extends Migration{

	public function up()
	{
		$this->int('id')->notnull('id')->increment('id')->primary('id');
		$this->text('name', 50)->notnull('name');
		$this->text('email', 30);
		$this->createTable('authors', $this->data);
	}
	
	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		$this->dropTable('authors');
	}
	
}