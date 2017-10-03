<?php

use Illuminate\Database\Seeder;
use App\Models\ToolState;

class ToolStateTableSeeder extends Seeder {

	public function run()
	{
		//DB::table('toolStates')->delete();

		// data init
		ToolState::create(array(
				'name' => 'Pending',
				'class' => 'warning'
			));

		// data init
		ToolState::create(array(
				'name' => 'Installed',
				'class' => 'success'
			));

		// data init
		ToolState::create(array(
				'name' => 'Uninstalled',
				'class' => 'danger'
			));
	}
}