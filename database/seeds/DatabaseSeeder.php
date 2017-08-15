<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder {

	public function run()
	{
		Model::unguard();

		$this->call('EstadoHerramientaTableSeeder');
		$this->command->info('EstadoHerramienta table seeded!');

		$this->call('RolTableSeeder');
		$this->command->info('Rol table seeded!');		

		$this->call('UsuarioTableSeeder');
		$this->command->info('Usuario table seeded!');

		
	}
}
