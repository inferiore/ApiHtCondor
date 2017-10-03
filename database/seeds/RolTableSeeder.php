<?php

use Illuminate\Database\Seeder;
use App\Models\Rol;

class RolTableSeeder extends Seeder {

	public function run()
	{
		//DB::table('Roles')->delete();

		// Datos Necesarios
		Rol::create(array(
				'observation' => 'Rol para Admin',
				'name' => 'Admin',
				'idState' => 1
			));

		// Datos Necesarios
		Rol::create(array(
				'observation' => 'Para Usuarios comunes',
				'name' => 'User',
				'idState' => 1
			));
	}
}