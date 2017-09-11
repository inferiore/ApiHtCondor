<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRolesTable extends Migration {

	public function up()
	{
		Schema::create('Roles', function(Blueprint $table) {
			$table->increments('id');
			$table->string('descripcion');
			$table->string('nombre');
			$table->string('estado');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('Roles');
	}
}