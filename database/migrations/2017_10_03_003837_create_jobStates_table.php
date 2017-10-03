<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateJobStatesTable extends Migration {

	public function up()
	{
		Schema::create('jobStates', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name');
			$table->string('class');
		});
	}

	public function down()
	{
		Schema::drop('jobStates');
	}
}