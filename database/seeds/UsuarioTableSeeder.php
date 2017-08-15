<?php

use Illuminate\Database\Seeder;
use App\Models\Usuario;

class UsuarioTableSeeder extends Seeder {

	public function run()
	{
		//DB::table('Usuarios')->delete();

		// Usuario Test
		Usuario::create(array(
				'nombre' => 'Eder',
				'apellido' => 'Barrios',
				'sApellido' => 'Camago',
				'idRol' => 1,
				'codigo' => 'T00030535',
				'password' => 'test',
				'email' => 'ederb1.1c@gmail.com',
				'remember_token' => 'abc123'
			));
	}
}
