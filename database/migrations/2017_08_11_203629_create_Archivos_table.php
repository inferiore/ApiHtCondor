<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateArchivosTable extends Migration {

	public function up()
	{
		Schema::create('Archivos', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('idTarea')->unsigned();
			$table->string('path');
			$table->timestamps();
			$table->integer('idUsuarioRegistro')->unsigned();
		});
	}

	public function down()
	{
		Schema::drop('Archivos');
	}
}