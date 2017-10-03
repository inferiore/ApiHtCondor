<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder {

	public function run()
	{
		Model::unguard();


		$this->call('RolTableSeeder');
		$this->command->info('Rol table seeded!');

		$this->call('UserTableSeeder');
		$this->command->info('User table seeded!');
		$this->call('ToolStateTableSeeder');
		$this->command->info('ToolState table seeded!');

		$this->call('JobStateTableSeeder');
		$this->command->info('JobState table seeded!');
	
		$this->call('ToolTableSeeder');
		$this->command->info('Tool table seeded!');


		$this->call('JobTableSeeder');
		$this->command->info('Job table seeded!');



	}
}