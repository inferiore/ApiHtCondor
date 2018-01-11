<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateJobsTable extends Migration {

	public function up()
	{
		Schema::create('jobs', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name');
			$table->string('observation')->nullable();
			$table->string('algorithm');
			$table->string('outPut')->default('outPut.outPut');
			$table->string('submitCondor')->default('submitCondor.submit');
			$table->integer('idState')->default('1')->unsigned();
			$table->integer('idInsertUser')->unsigned();
			$table->timestamps();
			$table->integer('iteration')->default('1');
			$table->integer('idTool')->unsigned();
		});
	}

	public function down()
	{
		Schema::drop('jobs');
	}
}