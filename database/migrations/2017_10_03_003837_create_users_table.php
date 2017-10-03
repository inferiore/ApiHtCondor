<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersTable extends Migration {

	public function up()
	{
		Schema::create('users', function(Blueprint $table) {
			$table->increments('id');
			$table->string('fullName');
			$table->integer('idRol')->unsigned();
			$table->string('code');
			$table->string('password');
			$table->string('email');
			$table->timestamps();
			$table->string('api_token')->nullable();
		});
	}

	public function down()
	{
		Schema::drop('users');
	}
}