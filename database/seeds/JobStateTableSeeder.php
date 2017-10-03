<?php

use Illuminate\Database\Seeder;
use App\Models\JobState;

class JobStateTableSeeder extends Seeder {

	public function run()
	{
		//DB::table('jobStates')->delete();

		// data init
		JobState::create(array(
				'name' => 'pending',
				'class' => 'warning'
			));

		// data init
		JobState::create(array(
				'name' => 'running',
				'class' =>'info'
			));

		// data init
		JobState::create(array(
				'name' => 'error',
				'class' => 'danger'
			));

		// data init
		JobState::create(array(
				'name' => 'finished',
				'class' => 'success'
			));
	}
}