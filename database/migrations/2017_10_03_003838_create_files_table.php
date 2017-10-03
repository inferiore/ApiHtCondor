<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFilesTable extends Migration {

	public function up()
	{
		Schema::create('files', function(Blueprint $table) {
			$table->increments('id');
			$table->string('realname');
			$table->string('fullPath');
			$table->integer('idJob')->unsigned();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('files');
	}
}