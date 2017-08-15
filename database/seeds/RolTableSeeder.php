<?php

use Illuminate\Database\Seeder;
use App\Models\Rol;

class RolTableSeeder extends Seeder {

	public function run()
	{
		//DB::table('Roles')->delete();

		// Datos Necesarios
		Rol::create(array(
				'descripcion' => 'Rol para Admin',
				'nombre' => 'Admin',
				'estado' => 1
			));

		// Datos Necesarios
		Rol::create(array(
				'descripcion' => 'Para Usuarios comunes',
				'nombre' => 'User',
				'estado' => 1
			));
	}
}