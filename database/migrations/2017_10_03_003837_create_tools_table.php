<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateToolsTable extends Migration {

	public function up()
	{
		Schema::create('tools', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name');
			$table->string('observation');
			$table->integer('idState')->unsigned();
			$table->timestamps();
			$table->integer('idInsertUser')->unsigned();
			$table->string('path');
		});
	}

	public function down()
	{
		Schema::drop('tools');
	}
}