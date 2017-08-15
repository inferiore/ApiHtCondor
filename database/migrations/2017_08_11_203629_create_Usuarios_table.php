<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsuariosTable extends Migration {

	public function up()
	{
		Schema::create('Usuarios', function(Blueprint $table) {
			$table->increments('id');
			$table->string('nombre');
			$table->string('apellido');
			$table->string('sApellido');
			$table->integer('idRol')->unsigned();
			$table->string('codigo');
			$table->string('password');
			$table->string('email');
			$table->timestamps();
			$table->string('remember_token');
		});
	}

	public function down()
	{
		Schema::drop('Usuarios');
	}
}