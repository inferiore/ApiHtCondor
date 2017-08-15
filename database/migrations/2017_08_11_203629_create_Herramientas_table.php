<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateHerramientasTable extends Migration {

	public function up()
	{
		Schema::create('Herramientas', function(Blueprint $table) {
			$table->increments('id');
			$table->string('nombre');
			$table->string('descripcion');
			$table->integer('idEstado')->unsigned();
			$table->timestamps();
			$table->integer('idUsuarioRegistro')->unsigned();
		});
	}

	public function down()
	{
		Schema::drop('Herramientas');
	}
}