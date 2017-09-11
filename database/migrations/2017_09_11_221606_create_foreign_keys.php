<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\Model;

class CreateForeignKeys extends Migration {

	public function up()
	{
		Schema::table('Herramientas', function(Blueprint $table) {
			$table->foreign('idEstado')->references('id')->on('estadosHerramienta')
						->onDelete('no action')
						->onUpdate('no action');
		});
		Schema::table('Herramientas', function(Blueprint $table) {
			$table->foreign('idUsuarioRegistro')->references('id')->on('Usuarios')
						->onDelete('no action')
						->onUpdate('no action');
		});
		Schema::table('Tareas', function(Blueprint $table) {
			$table->foreign('idUsuarioRegistro')->references('id')->on('Usuarios')
						->onDelete('no action')
						->onUpdate('no action');
		});
		Schema::table('Usuarios', function(Blueprint $table) {
			$table->foreign('idRol')->references('id')->on('Roles')
						->onDelete('no action')
						->onUpdate('no action');
		});
		Schema::table('Archivos', function(Blueprint $table) {
			$table->foreign('idTarea')->references('id')->on('Tareas')
						->onDelete('no action')
						->onUpdate('no action');
		});
		Schema::table('Archivos', function(Blueprint $table) {
			$table->foreign('idUsuarioRegistro')->references('id')->on('Usuarios')
						->onDelete('no action')
						->onUpdate('no action');
		});
	}

	public function down()
	{
		Schema::table('Herramientas', function(Blueprint $table) {
			$table->dropForeign('Herramientas_idEstado_foreign');
		});
		Schema::table('Herramientas', function(Blueprint $table) {
			$table->dropForeign('Herramientas_idUsuarioRegistro_foreign');
		});
		Schema::table('Tareas', function(Blueprint $table) {
			$table->dropForeign('Tareas_idUsuarioRegistro_foreign');
		});
		Schema::table('Usuarios', function(Blueprint $table) {
			$table->dropForeign('Usuarios_idRol_foreign');
		});
		Schema::table('Archivos', function(Blueprint $table) {
			$table->dropForeign('Archivos_idTarea_foreign');
		});
		Schema::table('Archivos', function(Blueprint $table) {
			$table->dropForeign('Archivos_idUsuarioRegistro_foreign');
		});
	}
}