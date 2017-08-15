<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTareasTable extends Migration {

	public function up()
	{
		Schema::create('Tareas', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('idProyecto')->unsigned();
			$table->string('nombre');
			$table->string('descripcion');
			$table->string('path');
			$table->string('pathResultLog');
			$table->timestamps();
			$table->integer('idUsuarioRegistro')->unsigned();
		});
	}

	public function down()
	{
		Schema::drop('Tareas');
	}
}