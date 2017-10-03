<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateToolStatesTable extends Migration {

	public function up()
	{
		Schema::create('toolStates', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name');
			$table->string('class')->nullable();
		});
	}

	public function down()
	{
		Schema::drop('toolStates');
	}
}