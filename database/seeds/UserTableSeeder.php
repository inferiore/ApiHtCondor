<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class UserTableSeeder extends Seeder {

	public function run()
	{
		//DB::table('Users')->delete();

		// Usuario Test
		User::create(array(
				'fullName' => 'Eder',
				'idRol' => 1,
				'code' => 'T00030535',
				'password' => 'test',
				'email' => 'ederb1.1c@gmail.com'
			));
	}
}