<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateJobsTable extends Migration {

	public function up()
	{
		Schema::create('jobs', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name');
			$table->string('observation');
			$table->string('algorithm');
			$table->string('outPut');
			$table->string('submitCondor');
			$table->integer('idState')->unsigned();
			$table->integer('idInsertUser')->unsigned();
			$table->timestamps();
			$table->integer('iteracion')->default('0');
		});
	}

	public function down()
	{
		Schema::drop('jobs');
	}
}