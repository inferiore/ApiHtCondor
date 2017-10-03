<?php

use Illuminate\Database\Seeder;
use App\Models\Tool;

class ToolTableSeeder extends Seeder {

	public function run()
	{
		//DB::table('Tools')->delete();

		// data init
		Tool::create(array(
				'name' => 'python',
				'observation' => 'this is a python 2.6',
				'idState' => 1,
				'idInsertUser' => 1,
				'path' => 'dev/tools/python/python2.6'
			));

		// data init
		Tool::create(array(
				'name' => 'Java',
				'observation' => 'java 10',
				'idState' => 1,
				'idInsertUser' => 1,
				'path' => 'dev/tools/java/java'
			));
	}
}