<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEstadosHerramientaTable extends Migration {

	public function up()
	{
		Schema::create('estadosHerramienta', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('nombre');
			$table->string('clase')->nullable();
		});
	}

	public function down()
	{
		Schema::drop('estadosHerramienta');
	}
}