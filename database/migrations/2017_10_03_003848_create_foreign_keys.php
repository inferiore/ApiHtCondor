<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\Model;

class CreateForeignKeys extends Migration {

	public function up()
	{
		Schema::table('tools', function(Blueprint $table) {
			$table->foreign('idState')->references('id')->on('toolStates')
						->onDelete('no action')
						->onUpdate('no action');
		});
		Schema::table('tools', function(Blueprint $table) {
			$table->foreign('idInsertUser')->references('id')->on('users')
						->onDelete('no action')
						->onUpdate('no action');
		});
		Schema::table('jobs', function(Blueprint $table) {
			$table->foreign('idState')->references('id')->on('jobStates')
						->onDelete('no action')
						->onUpdate('no action');
		});
		Schema::table('jobs', function(Blueprint $table) {
			$table->foreign('idInsertUser')->references('id')->on('users')
						->onDelete('no action')
						->onUpdate('no action');
		});
		Schema::table('users', function(Blueprint $table) {
			$table->foreign('idRol')->references('id')->on('roles')
						->onDelete('no action')
						->onUpdate('no action');
		});
		Schema::table('Archivos', function(Blueprint $table) {
			$table->foreign('idTarea')->references('id')->on('jobs')
						->onDelete('no action')
						->onUpdate('no action');
		});
		Schema::table('Archivos', function(Blueprint $table) {
			$table->foreign('idUsuarioRegistro')->references('id')->on('users')
						->onDelete('no action')
						->onUpdate('no action');
		});
		Schema::table('files', function(Blueprint $table) {
			$table->foreign('idJob')->references('id')->on('jobs')
						->onDelete('no action')
						->onUpdate('no action');
		});
	}

	public function down()
	{
		Schema::table('tools', function(Blueprint $table) {
			$table->dropForeign('tools_idState_foreign');
		});
		Schema::table('tools', function(Blueprint $table) {
			$table->dropForeign('tools_idInsertUser_foreign');
		});
		Schema::table('jobs', function(Blueprint $table) {
			$table->dropForeign('jobs_idState_foreign');
		});
		Schema::table('jobs', function(Blueprint $table) {
			$table->dropForeign('jobs_idInsertUser_foreign');
		});
		Schema::table('users', function(Blueprint $table) {
			$table->dropForeign('users_idRol_foreign');
		});
		Schema::table('Archivos', function(Blueprint $table) {
			$table->dropForeign('Archivos_idTarea_foreign');
		});
		Schema::table('Archivos', function(Blueprint $table) {
			$table->dropForeign('Archivos_idUsuarioRegistro_foreign');
		});
		Schema::table('files', function(Blueprint $table) {
			$table->dropForeign('files_idJob_foreign');
		});
	}
}