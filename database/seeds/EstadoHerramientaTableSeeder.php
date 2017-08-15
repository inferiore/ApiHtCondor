<?php

use Illuminate\Database\Seeder;
use App\Models\EstadoHerramienta;

class EstadoHerramientaTableSeeder extends Seeder {

	public function run()
	{
		//DB::table('estadosHerramienta')->delete();

		// Datos Necesarios
		EstadoHerramienta::create(array(
				'nombre' => 'Pendiente',
				'clase' => 'warning'
			));

		// Datos Necesarios
		EstadoHerramienta::create(array(
				'nombre' => 'Instalada',
				'clase' => 'success'
			));

		// Datos Necesarios
		EstadoHerramienta::create(array(
				'nombre' => 'DesInstalada',
				'clase' => 'error'
			));
	}
}
