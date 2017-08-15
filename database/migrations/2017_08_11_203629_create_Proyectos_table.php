<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProyectosTable extends Migration {

	public function up()
	{
		Schema::create('Proyectos', function(Blueprint $table) {
			$table->increments('id');
			$table->string('descripcion')->nullable();
			$table->string('nombre');
			$table->timestamps();
			$table->integer('idUsuarioRegistro')->unsigned();
		});
	}

	public function down()
	{
		Schema::drop('Proyectos');
	}
}